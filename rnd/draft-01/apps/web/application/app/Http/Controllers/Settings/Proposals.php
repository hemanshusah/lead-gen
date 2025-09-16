<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for proposals settings
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use App\Http\Responses\Settings\Proposals\IndexResponse;
use App\Http\Responses\Settings\Proposals\UpdateResponse;
use App\Repositories\SettingsRepository;
use App\Http\Requests\Settings\Proposals\ProposalAutomationValidation;
use App\Http\Responses\Settings\Proposals\AutomationResponse;
use DB;
use Illuminate\Http\Request;

class Proposals extends Controller {

    /**
     * The settings repository instance.
     */
    protected $settingsrepo;

    public function __construct(SettingsRepository $settingsrepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        //settings general
        $this->middleware('settingsMiddlewareIndex');

        $this->settingsrepo = $settingsrepo;

    }

    /**
     * Display general settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //crumbs, page data & stats
        $page = $this->pageSettings();

        $settings = \App\Models\Settings::find(1);

        $query = DB::select("SHOW TABLE STATUS LIKE 'proposals'");
        $next_id = $query[0]->Auto_increment;

        //reponse payload
        $payload = [
            'page' => $page,
            'settings' => $settings,
            'next_id' => $next_id,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update() {

        //update
        if (!$this->settingsrepo->updateProposalSettings()) {
            abort(409);
        }

        //are we updating next ID
        if (request()->filled('next_id')) {
            if (request('next_id') != request('next_id_current')) {
                DB::select("ALTER TABLE proposals AUTO_INCREMENT = " . request('next_id'));
            }
        }

        //reponse payload
        $payload = [];

        //generate a response
        return new UpdateResponse($payload);
    }

    
    /**
     * Display general settings
     *
     * @return \Illuminate\Http\Response
     */
    public function automation() {

        //crumbs, page data & stats
        $page = $this->pageSettings();

        $settings = \App\Models\Settings2::find(1);

        //assigned users
        $assigned_users = \App\Models\AutomationAssigned::Where('automationassigned_resource_type', 'proposal')
            ->Where('automationassigned_resource_id', 0)
            ->get();

        $assigned = [];
        foreach ($assigned_users as $user) {
            $assigned[] = $user->automationassigned_userid;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'settings' => $settings,
            'assigned' => $assigned,
        ];

        //show the view
        return new AutomationResponse($payload);
    }

    /**
     * Display general settings
     *
     * @return \Illuminate\Http\Response
     */
    public function automationUpdate(ProposalAutomationValidation $request) {

        $settings = \App\Models\Settings2::find(1);

        $settings->settings2_proposals_automation_default_status = request('settings2_proposals_automation_default_status');
        $settings->settings2_proposals_automation_create_project = (request('settings2_proposals_automation_create_project') == 'on') ? 'yes' : 'no';
        $settings->settings2_proposals_automation_project_status = request('settings2_proposals_automation_project_status');
        $settings->settings2_proposals_automation_project_email_client = (request('settings2_proposals_automation_project_email_client') == 'on') ? 'yes' : 'no';
        $settings->settings2_proposals_automation_create_invoice = (request('settings2_proposals_automation_create_invoice') == 'on') ? 'yes' : 'no';
        $settings->settings2_proposals_automation_invoice_email_client = (request('settings2_proposals_automation_invoice_email_client') == 'on') ? 'yes' : 'no';
        $settings->settings2_proposals_automation_invoice_due_date = request('settings2_proposals_automation_invoice_due_date');
        $settings->settings2_proposals_automation_create_tasks = (request('settings2_proposals_automation_create_tasks') == 'on') ? 'yes' : 'no';
        $settings->save();

        //additional settings
        if (request('settings2_proposals_automation_create_invoice') != 'on' || request('settings2_proposals_automation_default_status') == 'disabled') {
            $settings->settings2_proposals_automation_create_invoice = 'no';
            $settings->settings2_proposals_automation_invoice_email_client = 'no';
            $settings->settings2_proposals_automation_invoice_due_date = 0;
            $settings->save();
        }

        //additional settings
        if (request('settings2_proposals_automation_create_project') != 'on' || request('settings2_proposals_automation_default_status') == 'disabled') {
            $settings->settings2_proposals_automation_create_project = 'no';
            $settings->settings2_proposals_automation_project_email_client = 'no';
            $settings->settings2_proposals_automation_project_status = 'not_started';
            $settings->settings2_proposals_automation_create_tasks = 'no';
            $settings->save();
        }

        //assigned users (reset)
        \App\Models\AutomationAssigned::Where('automationassigned_resource_type', 'proposal')
            ->Where('automationassigned_resource_id', 0)
            ->delete();

        //assigned add (reset)
        if (request('settings2_proposals_automation_default_status') == 'enabled' && is_array(request('proposal_automation_assigned_users'))) {
            foreach (request('proposal_automation_assigned_users') as $user_id) {
                $assigned = new \App\Models\AutomationAssigned();
                $assigned->automationassigned_resource_type = 'proposal';
                $assigned->automationassigned_resource_id = 0;
                $assigned->automationassigned_userid = $user_id;
                $assigned->save();
            }
        }

        //success
        return response()->json(array(
            'notification' => [
                'type' => 'success',
                'value' => __('lang.request_has_been_completed'),
            ],
            'skip_dom_reset' => true,
        ));
    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        $page = [
            'crumbs' => [
                __('lang.settings'),
                __('lang.sales'),
                __('lang.proposals'),
            ],
            'crumbs_special_class' => 'main-pages-crumbs',
            'page' => 'settings',
            'meta_title' => __('lang.settings'),
            'heading' => __('lang.settings'),
        ];
        return $page;
    }

}
