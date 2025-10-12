<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for webforms
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Responses\Webform\SaveResponse;
use App\Repositories\AttachmentRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\WebformRepository;
use Validator;

class Webform extends Controller {

    /**
     * The settings repository instance.
     */
    protected $webformrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $trackingrepo;

    public function __construct(
        WebformRepository $webformrepo,
        AttachmentRepository $attachmentrepo,
        EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo,
    ) {

        //parent
        parent::__construct();

        $this->webformrepo = $webformrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->trackingrepo = $trackingrepo;
    }

    /**
     * Display Webform in browser
     *
     * @return \Illuminate\Http\Response
     */
    public function showWeb($id) {

        //crumbs, page data & stats
        $page = $this->pageSettings();

        //get the form
        $webforms = $this->webformrepo->search($id);
        if (!$webform = $webforms->first()) {
            config(['visibility.webform' => 'error']);
        }

        //get field
        $fields = $this->formFields($webform);

        //show form
        config(['visibility.webform' => 'show']);
        config(['visibility.webform_view' => request()->segment(2)]);

        //form css
        $webform_style_css = '<style>' . $webform->webform_style_css . '</style>';
        config(['css.webform' => $webform_style_css]);

        //show the view
        return view('pages/webform/form', compact('fields', 'webform'));
    }

    /**
     * save submitted Webform
     *
     * @return \Illuminate\Http\Response
     */
    public function saveForm($id) {

        //get the form
        $webforms = $this->webformrepo->search($id);
        if (!$webform = $webforms->first()) {
            config(['visibility.webform' => 'error']);
        }

        //get field
        $fields = $this->formFieldsArray($webform);

        //validate required fields
        $errors = 0;
        $error_message = '';
        foreach ($fields as $field) {
            if ($field['required'] && request($field['name']) == '') {
                $error_message .= '<li>' . $field['label'] . '</li>';
                $errors++;
            }
        }
        if ($errors > 0) {
            return new SaveResponse(['type' => 'error-required-fields', 'error_message' => $error_message]);
        }

        //validate reCaptcha after all other validations - to avoid tokens expring
        if ($webform->webform_recaptcha == 'enabled' && config('system.settings2_captcha_status') == 'enabled') {
            $validator = Validator::make(request()->all(), [
                'g-recaptcha-response' => 'recaptcha',
            ]);

            //errors
            if ($validator->fails()) {
                abort(409, __('lang.recaptcha_validation_error'));
            }
        }

        //get the last row (order by position - desc)
        if ($last = \App\Models\Lead::orderBy('lead_position', 'desc')->first()) {
            $position = $last->lead_position + config('settings.db_position_increment');
        } else {
            //default position increment
            $position = config('settings.db_position_increment');
        }

        //create content for admin email (from submitted form fields)
        $form_content = '<table class="table-gray" cellpadding="5"><tbody>';
        foreach ($fields as $field) {
            //skip array items
            if (!is_array(request($field['name']))) {
                $form_content .= '<tr style="height: 39px;">
                    <td class="td-1" style="height: 39px; width: 194.504px;"><strong>' . $field['label'] . '</strong></td>
                    <td class="td-2" style="height: 39px; width: 489.496px;">' . request($field['name']) . '</td></tr>';
            }
        }
        $form_content .= '</tbody></table>';

        //create lead with default database fields
        $lead = new \App\Models\Lead();
        $lead->lead_firstname = request('lead_firstname');
        $lead->lead_lastname = request('lead_lastname');
        $lead->lead_position = $position;
        $lead->lead_email = request('lead_email');
        $lead->lead_phone = request('lead_phone');
        $lead->lead_job_position = request('lead_job_position');
        $lead->lead_company_name = request('lead_company_name');
        $lead->lead_website = request('lead_website');
        $lead->lead_street = request('lead_street');
        $lead->lead_city = request('lead_city');
        $lead->lead_state = request('lead_state');
        $lead->lead_zip = request('lead_zip');
        $lead->lead_country = request('lead_country');
        $lead->lead_title = ($webform->webform_lead_title != '') ? $webform->webform_lead_title : request('lead_firstname') . ' ' . request('lead_lastname');
        $lead->lead_creatorid = 0;
        $lead->lead_input_source = 'webform';
        $lead->lead_input_ip_address = request()->ip();
        $lead->lead_uniqueid = str_unique();
        $lead->lead_status = (is_numeric($webform->webform_lead_status)) ? $webform->webform_lead_status : 1;
        $lead->save();

        //save every other possible field
        for ($i = 1; $i <= 150; $i++) {
            $name = "lead_custom_field_$i";
            $lead->{$name} = request($name); //curly brackets for dynamic naming
        }

        //save
        $lead->save();

        //[save attachments] loop through and save each attachment
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_creatorid' => 0,
                    'attachment_clientid' => request('expense_clientid'),
                    'attachmentresource_type' => 'lead',
                    'attachmentresource_id' => $lead->lead_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        //increase for counter
        $webform->webform_submissions = $webform->webform_submissions + 1;
        $webform->save();

        //assign users
        $assigned_users = [];
        $preset_users = \App\Models\WebformAssigned::Where('webformassigned_formid', $id)->get();
        foreach ($preset_users as $preset_user) {
            $assigned = new \App\Models\LeadAssigned;
            $assigned->leadsassigned_leadid = $lead->lead_id;
            $assigned->leadsassigned_userid = $preset_user->webformassigned_userid;
            $assigned->save();
            $assigned_users[] = $preset_user->webformassigned_userid;
        }

        /** ----------------------------------------------
         * record assignment events and send emails
         * ----------------------------------------------*/
        foreach ($assigned_users as $assigned_user_id) {
            if ($assigned_user = \App\Models\User::Where('id', $assigned_user_id)->first()) {
                $data = [
                    'event_creatorid' => 0,
                    'event_item' => 'assigned',
                    'event_item_id' => '',
                    'event_item_lang' => 'event_assigned_user_to_a_lead',
                    'event_item_lang_alt' => 'event_assigned_user_to_a_lead_alt',
                    'event_item_content' => __('lang.assigned'),
                    'event_item_content2' => $assigned_user_id,
                    'event_item_content3' => $assigned_user->first_name,
                    'event_parent_type' => 'lead',
                    'event_parent_id' => $lead->lead_id,
                    'event_parent_title' => $lead->lead_title,
                    'event_show_item' => 'yes',
                    'event_show_in_timeline' => 'no',
                    'event_clientid' => '',
                    'eventresource_type' => 'lead',
                    'eventresource_id' => $lead->lead_id,
                    'event_notification_category' => 'notifications_new_assignement',
                ];
                //record event
                if ($event_id = $this->eventrepo->create($data)) {
                    //record notification (skip the user creating this event)
                    $emailusers = $this->trackingrepo->recordEvent($data, [$assigned_user_id], $event_id);
                }

                /** ----------------------------------------------
                 * send email [assignment]
                 * ----------------------------------------------*/
                if ($assigned_user->notifications_new_assignement == 'yes_email') {
                    $mail = new \App\Mail\LeadAssignment($assigned_user, $data, $lead);
                    $mail->build();
                }
            }
        }

        /** ----------------------------------------------
         * send email to admin users
         * ----------------------------------------------*/
        if ($webform->webform_notify_admin == 'yes') {
            $data = [
                'form_name' => $webform->webform_title,
                'submitted_by_name' => $lead->lead_firstname . ' ' . $lead->lead_lastname,
                'submitted_by_email' => $lead->lead_email ?? '---',
                'form_content' => $form_content,
            ];
            if ($users = \App\Models\User::Where('role_id', 1)->get()) {
                foreach ($users as $user) {
                    if ($user->email != '') {
                        $mail = new \App\Mail\LeadNewSubmission($user, $data, $lead);
                        $mail->build();
                    }
                }
            }

        }

        //payload
        $payload = [
            'type' => 'success',
            'webform' => $webform,
        ];

        //show the view
        return new SaveResponse($payload);

    }

    /**
     * return an array of the form fields
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formFieldsArray($webform) {

        //payload
        $obj = [];

        //valid fields
        $valid = [
            'text',
            'textarea',
            'date',
            'number',
            'select',
            'checkbox-group',
            'file',
        ];

        //get the json form payload
        $fields = json_decode(json_decode($webform->webform_builder_payload));

        //extrach the form field names and their required states
        foreach ($fields as $field) {
            if (in_array($field->type, $valid)) {
                $var = [
                    'name' => $field->name,
                    'required' => $field->required,
                    'label' => $field->label,
                ];
                //force first name and last name to be required
                if ($field->name == 'lead_firstname' || $field->name == 'lead_lastname') {
                    $var['required'] = true;
                }
                array_push($obj, $var);
            }
        }

        return $obj;
    }

    /**
     * create the html for all the form fields
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formFields($webform) {

        //payload
        $html = '';

        //get the json form data
        $fields = json_decode(json_decode($webform->webform_builder_payload));
        //dd($fields);

        foreach ($fields as $field) {

            $payload = [
                'label' => html_entity_decode($field->label),
                'name' => $field->name ?? '',
                'class' => $field->className ?? '',
                'required' => $field->required ?? '',
                'placeholder' => html_entity_decode($field->placeholder ?? ''),
                'tooltip' => html_entity_decode($field->description ?? ''),
            ];

            //create text field
            if ($field->type == 'text') {
                //force first name and last name to be required
                if ($field->name == 'lead_firstname' || $field->name == 'lead_lastname') {
                    $payload['required'] = true;
                }
                $html .= view('pages/webform/elements/text', compact('payload'))->render();
            }

            //create textarea field
            if ($field->type == 'textarea') {
                $html .= view('pages/webform/elements/textarea', compact('payload'))->render();
            }

            //create date field
            if ($field->type == 'date') {
                $html .= view('pages/webform/elements/date', compact('payload'))->render();
            }

            //create number field
            if ($field->type == 'number') {
                $html .= view('pages/webform/elements/number', compact('payload'))->render();
            }

            //create select field
            if ($field->type == 'select') {
                $options = '';
                //create dropdown
                foreach ($field->values as $value) {
                    $options .= '<option value="' . $value->value . '">' . $value->label . '</option>';
                }
                $payload['options'] = $options;
                $html .= view('pages/webform/elements/dropdown', compact('payload'))->render();
            }

            //create checkbox field
            if ($field->type == 'checkbox-group') {
                $html .= view('pages/webform/elements/checkbox', compact('payload'))->render();
            }

            //create file field
            if ($field->type == 'file') {
                $html .= view('pages/webform/elements/attachments', compact('payload'))->render();
            }

            //create header field
            if ($field->type == 'header') {
                $payload = [
                    'label' => html_entity_decode($field->label),
                ];
                $html .= view('pages/webform/elements/header', compact('payload'))->render();
            }

            //create paragraph field
            if ($field->type == 'paragraph') {
                $payload = [
                    'label' => html_entity_decode($field->label),
                ];
                $html .= view('pages/webform/elements/paragraph', compact('payload'))->render();
            }

        }

        return $html;

    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        $page = [
            'page' => 'webform',
            'meta_title' => __('lang.settings'),
        ];

        return $page;
    }

}
