<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for template
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Calendar\StoreUpdate;
use App\Http\Responses\Calendar\CreateResponse;
use App\Http\Responses\Calendar\DeleteFileResponse;
use App\Http\Responses\Calendar\DestroyResponse;
use App\Http\Responses\Calendar\IndexResponse;
use App\Http\Responses\Calendar\ShowResponse;
use App\Http\Responses\Calendar\StoreResponse;
use App\Http\Responses\Calendar\UpdateResponse;
use App\Permissions\ProjectPermissions;
use App\Permissions\TaskPermissions;
use App\Repositories\AttachmentRepository;
use App\Repositories\CalendarRepository;
use App\Repositories\DestroyRepository;

class Calendar extends Controller {

    /**
     * The repository instance.
     */
    protected $calendarrepo;
    protected $attachmentrepo;

    public function __construct(
        CalendarRepository $calendarrepo,
        AttachmentRepository $attachmentrepo,
    ) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');
        $this->middleware('teamCheck');

        $this->calendarrepo = $calendarrepo;
        $this->attachmentrepo = $attachmentrepo;

    }

    /**
     * Display a listing of calendars
     * @return blade view | ajax view
     */
    public function index() {

        //check if module is enabled
        if (config('system.settings_modules_calendar') == 'disabled') {
            abort(404);
        }

        //geneal data used in javascript
        $data = [
            'today' => \Carbon\Carbon::now()->format('Y-m-d'),
        ];

        //update user preferences
        if (request('calendar_action') == 'user-preferences') {
            \App\Models\User::where('id', auth()->id())
                ->update([
                    'pref_calendar_dates_events' => request('pref_calendar_dates_events'),
                    'pref_calendar_dates_tasks' => request('pref_calendar_dates_tasks'),
                    'pref_calendar_dates_projects' => request('pref_calendar_dates_projects'),
                    'pref_calendar_view' => request('pref_calendar_view'),
                ]);

        }

        //list of events
        $events = $this->calendarrepo->getEvents();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('index'),
            'data' => $data,
            'events' => $events,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * show the form to create a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //users timezone
        $timezone = '';

        $date_time = $this->calendarrepo->createEventGetDateTime();

        //default event settings
        $event['extendedProps']['start_date'] = $date_time['start_date'];
        $event['extendedProps']['end_date'] = $event['extendedProps']['start_date'];
        $event['extendedProps']['start_time'] = $date_time['start_time'];
        $event['extendedProps']['end_time'] = $date_time['end_time'];
        $event['extendedProps']['all_day'] = $date_time['all_day'];

        $users = [];

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'event' => $event,
            'users' => $users,
        ];

        //response
        return new CreateResponse($payload);
    }

    /**
     * show the form to store a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdate $request) {

        //additional validation
        if (request('resource_type') == 'calendarevent' && request('share_with_team_members') == 'on' && !request()->filled('sharing_team_members')) {
            abort(409, __('lang.sharing_team_members') . ' - ' . __('lang.are_required'));
        }

        if (request('resource_type') == 'calendarevent' && request('share_with_team_members') == 'on' && request()->filled('sharing_team_members')) {
            if (!in_array(auth()->id(), request('sharing_team_members'))) {
                abort(409, __('lang.user_required_in_team_list'));
            }
        }

        //validate end time
        if (strtotime(request('calendar_event_end_date')) < strtotime(request('calendar_event_start_date'))) {
            abort(409, __('lang.end_date_cannot_be_before_start_date'));
        }

        //new record
        $new_event = new \App\Models\CalendarEvent();
        $new_event->calendar_event_creatorid = auth()->id();
        $new_event->calendar_event_uniqueid = str_unique();
        $new_event->calendar_event_title = request('calendar_event_title');
        $new_event->calendar_event_location = request('calendar_event_location');
        $new_event->calendar_event_all_day = (request('calendar_event_all_day') == 'on') ? 'yes' : 'no';
        $new_event->calendar_event_reminder = (request('calendar_event_reminder') == 'on') ? 'yes' : 'no';
        $new_event->calendar_event_start_date = request('calendar_event_start_date') ?? null;
        $new_event->calendar_event_start_time = request('calendar_event_start_time') ?? null;
        $new_event->calendar_event_end_date = request('calendar_event_end_date') ?? null;
        $new_event->calendar_event_end_time = request('calendar_event_end_time') ?? null;
        $new_event->calendar_event_description = request('calendar_event_description');
        if (request('share_with_team_members') == 'on') {
            $new_event->calendar_event_sharing = 'selected-users';
        } elseif (request('share_with_whole_team') == 'on') {
            $new_event->calendar_event_sharing = 'whole-team';
        } else {
            $new_event->calendar_event_sharing = 'myself';
        }
        $new_event->save();

        //update reminder
        if (request('calendar_event_reminder') == 'on') {
            //[FUTURE] - get this from the modal form and not the system default
            $duration = config('system.settings2_calendar_reminder_duration');
            $period = config('system.settings2_calendar_reminder_period');
            //save
            $new_event->calendar_event_reminder = 'yes';
            $new_event->calendar_event_reminder_duration = $duration;
            $new_event->calendar_event_reminder_period = $period;
            $new_event->save();
        }

        //sharing team members
        if (request()->filled('sharing_team_members')) {
            foreach (request('sharing_team_members') as $user_id) {
                $sharing = new \App\Models\CalenderEventSharing();
                $sharing->calendarsharing_eventid = $new_event->calendar_event_id;
                $sharing->calendarsharing_userid = $user_id;
                $sharing->save();
            }
        }

        //save each attachment
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => null,
                    'attachment_creatorid' => auth()->id(),
                    'attachmentresource_type' => 'calendarevent',
                    'attachmentresource_id' => $new_event->calendar_event_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        //geneal data used in javascript
        $data = [
            'today' => \Carbon\Carbon::now()->format('Y-m-d'),
        ];

        //list of events
        $event = $this->calendarrepo->calendarEvents([], $new_event->calendar_event_uniqueid);

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('index'),
            'data' => $data,
            'event' => $event,
        ];

        //show the view
        return new StoreResponse($payload);

    }

    /**
     * show the form to update a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdate $request, $id) {

        //get the event
        $data = [
            'event_id' => $id,
            'resource_type' => request('resource_type'),
        ];

        //validate
        if (!request()->filled('resource_type')) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //validate end date
        if (request('calendar_event_end_date') != '') {
            if (strtotime(request('calendar_event_end_date')) < strtotime(request('calendar_event_start_date'))) {
                abort(409, __('lang.end_date_cannot_be_before_start_date'));
            }
        }

        /*------------------------------------------------------
         * Update type - event
         * ----------------------------------------------------*/
        if (request('resource_type') == 'calendarevent') {

            //validate end time
            if (request('calendar_event_start_date') == request('calendar_event_end_date')) {
                if (request('calendar_event_end_time') < request('calendar_event_start_time')) {
                    abort(409, __('lang.end_time_cannot_be_before_start_time'));
                }
            }

            //additional validation
            if (request('resource_type') == 'calendarevent' && request('share_with_team_members') == 'on' && !request()->filled('sharing_team_members')) {
                abort(409, __('lang.sharing_team_members') . ' - ' . __('lang.are_required'));
            }

            if (request('resource_type') == 'calendarevent' && request('share_with_team_members') == 'on' && request()->filled('sharing_team_members')) {
                if (!in_array(auth()->id(), request('sharing_team_members'))) {
                    abort(409, __('lang.user_required_in_team_list'));
                }
            }

            if (!$event = $this->calendarrepo->updateEvent($data)) {
                abort(409, __('lang.error_request_could_not_be_completed'));
            }
        }

        /*------------------------------------------------------
         * Update type - project
         * ----------------------------------------------------*/
        if (request('resource_type') == 'project') {
            if (!$event = $this->calendarrepo->updateProject($data)) {
                abort(409, __('lang.error_request_could_not_be_completed'));
            }
        }

        /*------------------------------------------------------
         * Update type - task
         * ----------------------------------------------------*/
        if (request('resource_type') == 'task') {
            if (!$event = $this->calendarrepo->updateTask($data)) {
                abort(409, __('lang.error_request_could_not_be_completed'));
            }
        }

        //reponse payload
        $payload = [
            'event_id' => $id,
            'event' => $event,
        ];

        //show the view
        return new UpdateResponse($payload);

    }

    /**
     * show the form to update a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRepository $destroyrepo, $id) {

        //get the event
        $data = [
            'event_id' => $id,
            'resource_type' => request('resource_type'),
        ];

        //validate
        if (!request()->filled('resource_type')) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        /*------------------------------------------------------
         * delete type - event
         * ----------------------------------------------------*/
        if (request('resource_type') == 'calendarevent') {
            if ($event = \App\Models\CalendarEvent::Where('calendar_event_uniqueid', $id)->first()) {
                //delete assigned
                \App\Models\CalenderEventSharing::Where('calendarsharing_eventid', $event->calendar_event_id)->delete();
                //delete record
                \App\Models\CalendarEvent::Where('calendar_event_uniqueid', $id)->delete();
            }

        }

        /*------------------------------------------------------
         * delete type - project
         * ----------------------------------------------------*/
        if (request('resource_type') == 'project') {
            if ($project = \App\Models\Project::Where('project_uniqueid', $id)->first()) {
                $destroyrepo->destroyProject($project->project_id);
            }
        }

        /*------------------------------------------------------
         * delete type - task
         * ----------------------------------------------------*/
        if (request('resource_type') == 'task') {
            if ($task = \App\Models\Task::Where('task_uniqueid', $id)->first()) {
                $destroyrepo->destroyTask($task->task_id);
            }
        }

        //reponse payload
        $payload = [
            'event_id' => $id,
        ];

        //show the view
        return new DestroyResponse($payload);

    }

    /**
     * show the form to edit a resource
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        //get the event
        $data = [
            'event_id' => $id,
            'resource_type' => request('resource_type'),
            'resource_id' => request('resource_id'),
            'today' => \Carbon\Carbon::now()->format('Y-m-d'),
        ];

        //fetch event
        if (!$event = $this->calendarrepo->getEvent($data)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //validate
        if (empty($event)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //viewing permission
        if (!$event['extendedProps']['view_permission']) {
            abort(403);
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings(),
            'event' => $event,
            'sharing' => $event['extendedProps']['sharing'],
            'users' => $event['extendedProps']['users'],
        ];

        //response
        return new ShowResponse($payload);
    }

    /**
     * delete files from event, project or task
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFiles(ProjectPermissions $projectpermissions, TaskPermissions $taskpermissions, DestroyRepository $destroyrepo, $id) {

        //get the type
        if (!request()->filled('type')) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //validation
        if (!in_array(request('type'), ['file', 'attachment'])) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        /**--------------------------------------------------------------
         * Delete Project File
         * -------------------------------------------------------------*/
        if (request('type') == 'file') {
            if (!$file = \App\Models\File::Where('file_uniqueid', $id)->first()) {
                abort(404);
            }

            //check users permission on the project
            if (!$projectpermissions->check('edit', $file->fileresource_id)) {
                abort(403);
            }

            //delete the file
            $destroyrepo->destroyFile($file->file_id);
        }

        /**--------------------------------------------------------------
         * Delete attachment File
         * -------------------------------------------------------------*/
        if (request('type') == 'attachment') {
            if (!$attachment = \App\Models\Attachment::Where('attachment_uniqiueid', $id)->first()) {
                abort(404);
            }

            //task files
            if ($attachment->attachmentresource_type == 'task') {
                if (!$taskpermissions->check('edit', $attachment->attachmentresource_id)) {
                    abort(403);
                }
                $destroyrepo->destroyTaskAttachment($attachment->attachment_id);
            }

            //task files
            if ($attachment->attachmentresource_type == 'task') {
                if (!$taskpermissions->check('edit', $attachment->attachmentresource_id)) {
                    abort(403);
                }
                $destroyrepo->destroyTaskAttachment($attachment->attachment_id);
            }

            //event files
            if ($attachment->attachmentresource_type == 'calendarevent') {
                $destroyrepo->destroyAttachment($attachment->attachment_id);
            }

        }

        //reponse payload
        $payload = [
            'file_uniqueid' => $id,
        ];

        //response
        return new DeleteFileResponse($payload);
    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'page' => 'calendar',
        ];

        //return
        return $page;
    }
}