<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for templates
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\CalendarEvent;
use App\Models\Project;
use App\Models\Reminder;
use App\Models\Task;
use App\Permissions\ProjectPermissions;
use App\Permissions\TaskPermissions;
use App\Repositories\AttachmentRepository;
use App\Repositories\FileRepository;
use App\Repositories\TaskAssignedRepository;
use Illuminate\Support\Facades\Log;

class CalendarRepository {

    /**
     * The repository instance.
     */
    protected $project;
    protected $task;
    protected $reminder;
    protected $calendarevent;
    protected $projectpermissions;
    protected $taskpermissions;
    protected $projectassignedrepo;
    protected $attachmentrepo;
    protected $filerepo;
    protected $taskassignedrepo;

    /**
     * Inject dependecies
     */
    public function __construct(
        Project $project,
        Task $task,
        CalendarEvent $calendarevent,
        Reminder $reminder,
        ProjectPermissions $projectpermissions,
        TaskPermissions $taskpermissions,
        ProjectAssignedRepository $projectassignedrepo,
        AttachmentRepository $attachmentrepo,
        FileRepository $filerepo,
        TaskAssignedRepository $taskassignedrepo
    ) {
        $this->project = $project;
        $this->task = $task;
        $this->reminder = $reminder;
        $this->calendarevent = $calendarevent;
        $this->projectpermissions = $projectpermissions;
        $this->taskpermissions = $taskpermissions;
        $this->projectassignedrepo = $projectassignedrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->filerepo = $filerepo;
        $this->taskassignedrepo = $taskassignedrepo;
    }

    /**
     * get all the various types of events
     *
     * @return array events array
     */
    public function getEvents() {

        $events = [];

        //merge project events
        $events = $this->projectEvents($events);
        $events = $this->taskEvents($events);
        $events = $this->calendarEvents($events);

        Log::info("calendar entries have been processed", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'events' => $events]);

        //return all events
        return $events;

    }

    /**
     * get a single event
     *
     * @return array events array
     */
    public function getEvent($data = []) {

        Log::info("fetching a single calendar entry - started", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'data' => $data]);

        $event = [];

        //validation
        if (!isset($data['event_id']) || !isset($data['resource_type'])) {
            Log::error("fetching calendar entry failed - missing data", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //validate event type
        if (!in_array($data['resource_type'], ['project', 'task', 'calendarevent'])) {
            Log::error("fetching calendar entry failed - event type is invalid", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //get calendar entry
        if ($data['resource_type'] == 'calendarevent') {
            $event = $this->calendarEvents([], $data['event_id']);
            return $event;
        }

        //get project event
        if ($data['resource_type'] == 'project') {
            $event = $this->projectEvents([], $data['event_id']);
            return $event;
        }

        //get calendar entry
        if ($data['resource_type'] == 'task') {
            $event = $this->taskEvents([], $data['event_id']);
            return $event;
        }

        //return all events
        return $event;
    }

    /**
     * get project events
     * @param array $all_events existing events array
     * @return array merged events
     */
    public function projectEvents($all_events = [], $id = '') {

        Log::info("fetching calendar entries of type [project] - started", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'id' => $id]);

        //defaults
        $events = [];
        $event = [];
        $start = null;
        $end = null;
        $count = 0;

        //start
        $projects = $this->project->newQuery();
        $projects->selectRaw('*');

        //filter - only projects
        $projects->where('project_type', 'project');

        //specific event
        if ($id) {
            $projects->Where('project_uniqueid', $id);
        }

        //filter - assigned projects (if set or for all none admins)
        if (auth()->user()->pref_calendar_view == 'own' || !auth()->user()->is_admin) {
            //projects assigned to me and those that I manage
            $projects->where(function ($query) {
                $query->whereHas('assigned', function ($q) {
                    $q->whereIn('projectsassigned_userid', [auth()->id()]);
                });
                $query->orWhereHas('managers', function ($q) {
                    $q->whereIn('projectsmanager_userid', [auth()->id()]);
                });
            });
        }

        //get results
        $rows = $projects->get();

        //loop through all projects, create a new calendar array and merge it into the passed calendar array
        foreach ($rows as $project) {

            //set event dates based on users preferences
            switch (auth()->user()->pref_calendar_dates_projects) {
            case 'start':
                $start = $project->project_date_start;
                $end = $project->project_date_start;
                break;
            case 'due':
                $start = $project->project_date_due;
                $end = $project->project_date_due;
                break;
            case 'start_due':
                $start = $project->project_date_start;
                $end = $this->fixEndingDate($project->project_date_due);
                break;
            }

            //get sharing users - only do this when viewing a single event [to reduce server load]
            $users = [];
            if ($id) {
                foreach ($project->assigned()->get() as $user) {
                    $users[] = [
                        'id' => $user->id,
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'avatar_directory' => $user->avatar_directory,
                        'avatar_filename' => $user->avatar_filename,
                    ];
                }
            }

            $event = [
                'id' => $project->project_uniqueid,
                'title' => $project->project_title,
                'start' => $start,
                'end' => $end,
                'backgroundColor' => config('system.settings2_calendar_projects_colour'),
                'borderColor' => config('system.settings2_calendar_projects_colour'),
                'textColor' => '#ffffff',
                'className' => 'event-type-project',
                'extendedProps' => [
                    'start_date' => $project->project_date_start,
                    'end_date' => $project->project_date_due,
                    'start_time' => '',
                    'end_time' => '',
                    'all_day' => 'yes',
                    'all_day_editable' => 'no',
                    'resource_type' => 'project',
                    'resource_id' => $project->project_id,
                    'sharing' => 'selected-users',
                    'location' => $project->project_location,
                    'files' => [],
                    'users' => $users,
                    'reminder' => $project->project_calendar_reminder,
                    'reminder_duration' => $project->project_calendar_reminder_period,
                    'reminder_period' => $project->project_calendar_reminder_period,
                ],
            ];

            //get file attachments
            if ($id) {
                if ($files = \App\Models\File::Where('fileresource_type', 'project')
                    ->Where('fileresource_id', $project->project_id)
                    ->orderBy('file_filename', 'asc')->get()) {
                    foreach ($files as $file) {
                        $event['extendedProps']['files'][] = [
                            'file_type' => 'file',
                            'file_uniqueid' => $file->file_uniqueid,
                            'file_name' => $file->file_filename,
                            'file_url' => url('/storage/files/' . $file->file_directory . '/' . $file->file_filename),
                        ];
                    }
                }
            }

            //additional settings - only when viewing
            if ($id) {
                //created by
                $event['extendedProps']['creator'] = \App\Models\User::Where('id', $project->project_creatorid)->first();
                $event['extendedProps']['creator_id'] = $project->project_creatorid;
                //details
                $event['extendedProps']['details'] = $project->project_description;
                //permissions - view
                $event['extendedProps']['view_permission'] = $this->projectpermissions->check('view', $project->project_id);
                //permissions - edit
                $event['extendedProps']['edit_permission'] = $this->projectpermissions->check('edit', $project->project_id);
                //permissions - participate
                $event['extendedProps']['participate_permission'] = $this->projectpermissions->check('participate', $project->project_id);
                //permissions - assign
                $event['extendedProps']['assign_permission'] = $this->projectpermissions->check('super-user', $project->project_id);
                //permissions - assign
                $event['extendedProps']['delete_permission'] = $this->projectpermissions->check('delete', $project->project_id);

                //the object (this will make payload too big)
                //$event['extendedProps']['object'] = $project;

                $event['extendedProps']['project_id'] = $project->project_id;
                $event['extendedProps']['project_title'] = $project->project_title;
                $event['extendedProps']['project_status'] = $project->project_status;

            }

            $events[] = $event;

            $count++;
        }

        //specific event
        if ($id) {
            Log::info("fetching calendar entry of type [project] - finished - records found ($count)", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'event' => $event]);
            return $event;
        }

        //return merged array
        Log::info("fetching calendar entries of type [project] - finished - records found ($count)", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'events' => $events]);
        return array_merge($all_events, $events);

    }

    /**
     * get task events
     * @param array $all_events existing events array
     * @return array merged events
     */
    public function taskEvents($all_events = [], $id = '') {

        Log::info("fetching calendar entries of type [task] - started", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'id' => $id]);

        //defaults
        $events = [];
        $event = [];
        $start = null;
        $end = null;
        $count = 0;

        //start
        $tasks = $this->task->newQuery();
        $tasks->leftJoin('projects', 'projects.project_id', '=', 'tasks.task_projectid');
        $tasks->leftJoin('tasks_status', 'tasks_status.taskstatus_id', '=', 'tasks.task_status');
        $tasks->leftJoin('tasks_priority', 'tasks_priority.taskpriority_id', '=', 'tasks.task_priority');

        $tasks->selectRaw('*');

        //filter - only project tasks
        $tasks->where('task_projectid', '>', 0);

        //specific event
        if ($id) {
            $tasks->Where('task_uniqueid', $id);
        }

        //filter - assigned tasks (if set or for all none admins)
        if (auth()->user()->pref_calendar_view == 'own' || !auth()->user()->is_admin) {
            $tasks->whereHas('assigned', function ($query) {
                $query->whereIn('tasksassigned_userid', [auth()->id()]);
            });
        }

        //get results
        $rows = $tasks->get();

        //loop through all tasks, create a new calendar array and merge it into the passed calendar array
        foreach ($rows as $task) {

            //set event dates based on users preferences
            switch (auth()->user()->pref_calendar_dates_tasks) {
            case 'start':
                $start = $task->task_date_start;
                $end = $task->task_date_start;
                break;
            case 'due':
                $start = $task->task_date_due;
                $end = $task->task_date_due;
                break;
            case 'start_due':
                $start = $task->task_date_start;
                $end = $this->fixEndingDate($task->task_date_due);
                break;
            }

            //get sharing users - only do this when viewing a single event [to reduce server load]
            $users = [];
            if ($id) {
                foreach ($task->assigned()->get() as $user) {
                    $users[] = [
                        'id' => $user->id,
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'avatar_directory' => $user->avatar_directory,
                        'avatar_filename' => $user->avatar_filename,
                    ];
                }
            }

            $event = [
                'id' => $task->task_uniqueid,
                'title' => $task->task_title,
                'start' => $start,
                'end' => $end,
                'backgroundColor' => config('system.settings2_calendar_tasks_colour'),
                'borderColor' => config('system.settings2_calendar_tasks_colour'),
                'textColor' => '#ffffff',
                'className' => 'event-type-task',
                'extendedProps' => [
                    'start_date' => $task->task_date_start,
                    'end_date' => $task->task_date_due,
                    'start_time' => '',
                    'end_time' => '',
                    'all_day' => 'yes',
                    'all_day_editable' => 'no',
                    'resource_type' => 'task',
                    'resource_id' => $task->task_id,
                    'sharing' => 'selected-users',
                    'location' => $task->task_location,
                    'files' => [],
                    'users' => $users,
                    'reminder' => $task->task_calendar_reminder,
                    'reminder_duration' => $task->task_calendar_reminder_duration,
                    'reminder_period' => $task->task_calendar_reminder_period,
                ],
            ];

            //get file attachments
            if ($id) {
                if ($files = \App\Models\Attachment::Where('attachmentresource_type', 'task')
                    ->Where('attachmentresource_id', $task->task_id)
                    ->orderBy('attachment_filename', 'asc')->get()) {
                    foreach ($files as $file) {
                        $event['extendedProps']['files'][] = [
                            'file_type' => 'attachment',
                            'file_uniqueid' => $file->attachment_uniqiueid,
                            'file_name' => $file->attachment_filename,
                            'file_url' => url('/storage/files/' . $file->attachment_directory . '/' . $file->attachment_filename),
                        ];
                    }
                }
            }

            //additional settings - only when viewing
            if ($id) {
                //created by
                $event['extendedProps']['creator'] = \App\Models\User::Where('id', $task->task_creatorid)->first();
                $event['extendedProps']['creator_id'] = $task->task_creatorid;

                //details
                $event['extendedProps']['details'] = $task->task_description;
                //permissions - view
                $event['extendedProps']['view_permission'] = $this->taskpermissions->check('view', $task->task_id);
                //permissions - edit
                $event['extendedProps']['edit_permission'] = $this->taskpermissions->check('edit', $task->task_id);
                //permissions - participate
                $event['extendedProps']['participate_permission'] = $this->taskpermissions->check('participate', $task->task_id);
                //permissions - assign
                $event['extendedProps']['assign_permission'] = $this->taskpermissions->check('super-user', $task->task_id);
                //permissions - assign
                $event['extendedProps']['delete_permission'] = $this->taskpermissions->check('delete', $task->task_id);

                //the object (this will make payload too big)
                //$event['extendedProps']['object'] = $task;

                $event['extendedProps']['taskstatus_color'] = $task->taskstatus_color;
                $event['extendedProps']['taskstatus_title'] = $task->taskstatus_title;
                $event['extendedProps']['project_id'] = $task->project_id;
                $event['extendedProps']['project_title'] = $task->project_title;
                $event['extendedProps']['project_status'] = $task->project_status;
            }

            $events[] = $event;

            $count++;
        }

        //specific event
        if ($id) {
            Log::info("fetching calendar entry of type [task] - finished - records found ($count)", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'event' => $event]);
            return $event;
        }

        //return merged array
        Log::info("fetching calendar entries of type [task] - finished - records found ($count)", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'events' => $events]);
        return array_merge($all_events, $events);

    }

    /**
     * get calendar entries
     * @param array $all_events existing events array
     * @return array merged events
     */
    public function calendarEvents($all_events = [], $id = '') {

        Log::info("fetching calendar entries of type [event] - started", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'id' => $id]);

        //defaults
        $events = [];
        $event = [];
        $start = null;
        $end = null;
        $count = 0;

        //start
        $calendarevent = $this->calendarevent->newQuery();
        $calendarevent->selectRaw('*');

        //specific event
        if ($id) {
            $calendarevent->Where('calendar_event_uniqueid', $id);
        }

        $calendarevent->where(function ($query) {
            $query->whereHas('assigned', function ($query) {
                $query->whereIn('calendarsharing_userid', [auth()->id()]);
            })
                ->orWhere('calendar_event_creatorid', auth()->id())
                ->orWhere('calendar_event_sharing', 'whole-team');
        });

        //get results
        $rows = $calendarevent->get();

        //loop through all tasks, create a new calendar array and merge it into the passed calendar array
        foreach ($rows as $calendarevent) {

            //set all day or time event
            switch ($calendarevent->calendar_event_all_day) {
            case 'yes':
                $event_start = $calendarevent->calendar_event_start_date;
                $event_end = $calendarevent->calendar_event_end_date;
                $event_end_inclusive = $this->fixEndingDate($calendarevent->calendar_event_end_date);
                break;
            case 'no':
                $start_time = ($calendarevent->calendar_event_start_time) ? $calendarevent->calendar_event_start_time : '00:00:00';
                $end_time = ($calendarevent->calendar_event_end_time) ? $calendarevent->calendar_event_end_time : '00:00:00';
                $event_start = $calendarevent->calendar_event_start_date . 'T' . $start_time;
                $event_end = $calendarevent->calendar_event_end_date . 'T' . $end_time;
                $event_end_inclusive = $event_end;
                break;
            }

            //set event dates based on users preferences
            switch (auth()->user()->pref_calendar_dates_events) {
            case 'start':
                $start = $event_start;
                $end = $event_start;
                break;
            case 'due':
                $start = $event_end;
                $end = $event_end;
                break;
            case 'start_due':
                $start = $event_start;
                $end = $event_end_inclusive;
                break;
            }

            //get sharing users - only do this when viewing a single event [to reduce server load]
            $users = [];
            $user_is_creator = ($calendarevent->calendar_event_creatorid == auth()->id()) ? true : false;
            $user_is_assigned = false;
            if ($id) {
                foreach ($calendarevent->assigned()->get() as $user) {
                    $users[] = [
                        'id' => $user->id,
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'avatar_directory' => $user->avatar_directory,
                        'avatar_filename' => $user->avatar_filename,
                    ];
                    if ($user->id == auth()->id()) {
                        $user_is_assigned = true;
                    }
                }
            }

            //whole team sharing
            if ($calendarevent->calendar_event_sharing == 'whole-team') {
                if (auth()->user()->is_team) {
                    $user_is_assigned = true;
                }
            }

            $event = [
                'id' => $calendarevent->calendar_event_uniqueid,
                'title' => $calendarevent->calendar_event_title,
                'start' => $start,
                'end' => $end,
                'backgroundColor' => config('system.settings2_calendar_events_colour'),
                'borderColor' => config('system.settings2_calendar_events_colour'),
                'textColor' => '#ffffff',
                'className' => 'event-type-event',
                'extendedProps' => [
                    'start_date' => $calendarevent->calendar_event_start_date,
                    'end_date' => $calendarevent->calendar_event_end_date,
                    'start_time' => $calendarevent->calendar_event_start_time,
                    'end_time' => $calendarevent->calendar_event_end_time,
                    'all_day' => $calendarevent->calendar_event_all_day,
                    'all_day_editable' => 'yes',
                    'resource_type' => 'calendarevent',
                    'resource_id' => $calendarevent->calendar_event_id,
                    'sharing' => $calendarevent->calendar_event_sharing,
                    'location' => $calendarevent->calendar_event_location,
                    'files' => [],
                    'users' => $users,
                    'reminder' => $calendarevent->calendar_event_reminder,
                    'reminder_duration' => $calendarevent->calendar_event_reminder_duration,
                    'reminder_period' => $calendarevent->calendar_event_reminder_period,
                ],
            ];

            //get file attachments
            if ($id) {
                if ($files = \App\Models\Attachment::Where('attachmentresource_type', 'calendarevent')
                    ->Where('attachmentresource_id', $calendarevent->calendar_event_id)
                    ->orderBy('attachment_filename', 'asc')->get()) {
                    foreach ($files as $file) {
                        $event['extendedProps']['files'][] = [
                            'file_type' => 'attachment',
                            'file_uniqueid' => $file->attachment_uniqiueid,
                            'file_name' => $file->attachment_filename,
                            'file_url' => url('/storage/files/' . $file->attachment_directory . '/' . $file->attachment_filename),
                        ];
                    }
                }
            }

            //additional settings - only when viewing
            if ($id) {
                //created by
                $event['extendedProps']['creator'] = \App\Models\User::Where('id', $calendarevent->calendar_event_creatorid)->first();
                $event['extendedProps']['creator_id'] = $calendarevent->calendar_event_creatorid;
                //details
                $event['extendedProps']['details'] = $calendarevent->calendar_event_description;
                //permissions - view
                $event['extendedProps']['view_permission'] = ($user_is_creator || $user_is_assigned || auth()->user()->is_admin) ? true : false;
                //permissions - edit
                $event['extendedProps']['edit_permission'] = ($user_is_creator || auth()->user()->is_admin) ? true : false;
                //permissions - participate
                $event['extendedProps']['participate_permission'] = ($user_is_creator || $user_is_assigned || auth()->user()->is_admin) ? true : false;
                //permissions - assign
                $event['extendedProps']['assign_permission'] = ($user_is_creator || auth()->user()->is_admin) ? true : false;
                //permissions - assign
                $event['extendedProps']['delete_permission'] = ($user_is_creator || auth()->user()->is_admin) ? true : false;

                //the object (this will make payload too big)
                //$event['extendedProps']['object'] = $calendarevent;
            }

            $events[] = $event;

            $count++;
        }

        //specific event
        if ($id) {
            Log::info("fetching calendar entry of type [event] - finished - records found ($count)", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'event' => $event]);
            return $event;
        }

        //return merged array
        Log::info("fetching calendar entries of type [event] - finished - records found ($count)", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'events' => $events]);
        return array_merge($all_events, $events);

    }

    /**
     * update a calendar event
     * @param string $event_id existing events array
     * @return bool
     */
    public function updateEvent($data = []) {

        Log::info(" updating calender event type [event] - started", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'payload' => $data]);

        //validate
        if (!isset($data['event_id']) || !isset($data['resource_type'])) {
            Log::error(" updating calender failed - required data missing", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //fetch event
        if (!$event = \App\Models\CalendarEvent::Where('calendar_event_uniqueid', $data['event_id'])->first()) {
            Log::error(" updating calender failed - event with event_id (" . $data['event_id'] . ") could not be fetched", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //save changes
        $event->calendar_event_title = request('calendar_event_title');
        $event->calendar_event_location = request('calendar_event_location');
        $event->calendar_event_all_day = (request('calendar_event_all_day') == 'on') ? 'yes' : 'no';
        $event->calendar_event_reminder = (request('calendar_event_reminder') == 'on') ? 'yes' : 'no';
        $event->calendar_event_start_date = request('calendar_event_start_date') ?? null;
        $event->calendar_event_start_time = request('calendar_event_start_time') ?? null;
        $event->calendar_event_end_date = request('calendar_event_end_date') ?? null;
        $event->calendar_event_end_time = request('calendar_event_end_time') ?? null;
        $event->calendar_event_description = request('calendar_event_description');

        //reset reminder first
        $event->calendar_event_reminder = 'no';
        $event->calendar_event_reminder_date_sent = null;
        $event->calendar_event_reminder_duration = null;
        $event->calendar_event_reminder_period = null;

        if (request('share_with_team_members') == 'on') {
            $event->calendar_event_sharing = 'selected-users';
        } elseif (request('share_with_whole_team') == 'on') {
            $event->calendar_event_sharing = 'whole-team';
        } else {
            $event->calendar_event_sharing = 'myself';
        }
        $event->save();

        //update reminder - if applicable
        if (request('calendar_event_reminder') == 'on') {
            //[FUTURE] - get this from the modal form and not the system default
            $duration = config('system.settings2_calendar_reminder_duration');
            $period = config('system.settings2_calendar_reminder_period');
            //save
            $event->calendar_event_reminder = 'yes';
            $event->calendar_event_reminder_duration = $duration;
            $event->calendar_event_reminder_period = $period;
            $event->save();
        }

        //delete all current members
        \App\Models\CalenderEventSharing::Where('calendarsharing_eventid', $event->calendar_event_id)->delete();

        //add members
        if (request()->filled('sharing_team_members')) {
            foreach (request('sharing_team_members') as $user_id) {
                $sharing = new \App\Models\CalenderEventSharing();
                $sharing->calendarsharing_eventid = $event->calendar_event_id;
                $sharing->calendarsharing_userid = $user_id;
                $sharing->save();
            }
        }

        //save each attachment
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $attachment_data = [
                    'attachment_clientid' => null,
                    'attachment_creatorid' => auth()->id(),
                    'attachmentresource_type' => 'calendarevent',
                    'attachmentresource_id' => $event->calendar_event_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                ];
                //process and save to db
                $this->attachmentrepo->process($attachment_data);
            }
        }

        //get refreshed event
        $event = $this->getEvent($data);

        Log::info(" updating calender event type [event] with id (" . $data['event_id'] . ") - completed", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'event' => $event]);

        return $event;
    }

    /**
     * update the a project calender event
     * @param string $event_id existing events array
     * @return bool
     */
    public function updateProject($data = []) {

        Log::info(" updating calender event type [project] - started", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'payload' => $data]);

        //validate
        if (!isset($data['event_id']) || !isset($data['resource_type'])) {
            Log::error(" updating calender failed - required data missing", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //fetch event
        if (!$event = $this->getEvent($data)) {
            Log::error(" updating calender failed - event with event_id (" . $data['event_id'] . ") could not be fetched", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //fetch the project
        if (!$project = \App\Models\Project::Where('project_uniqueid', $data['event_id'])->first()) {
            Log::error(" updating calender failed - project with project_uniqueid (" . $data['event_id'] . ") could not be fetched", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //update project
        $project->project_title = request('calendar_event_title');
        $project->project_date_start = request('calendar_event_start_date');
        $project->project_date_due = request('calendar_event_end_date');
        $project->project_description = request('calendar_event_description');

        //reset reminder first
        $project->project_calendar_reminder = 'no';
        $project->project_calendar_reminder_date_sent = null;
        $project->project_calendar_reminder_duration = null;
        $project->project_calendar_reminder_period = null;

        //save
        $project->save();

        //update reminder - if applicable
        if (request('calendar_event_reminder') == 'on') {
            //[FUTURE] - get this from the modal form and not the system default
            $duration = config('system.settings2_calendar_reminder_duration');
            $period = config('system.settings2_calendar_reminder_period');
            //save
            $project->project_calendar_reminder = 'yes';
            $project->project_calendar_reminder_duration = $duration;
            $project->project_calendar_reminder_period = $period;
            $project->save();
        }

        //[save attachments] loop through and save each attachment
        if (request()->filled('attachments')) {

            //get the project default folder
            $default_folder = \App\Models\FileFolder::Where('filefolder_projectid', request('fileresource_id'))
                ->Where('filefolder_default', 'yes')->first();

            foreach (request('attachments') as $uniqueid => $file_name) {
                $file_data = [
                    'file_clientid' => $project->project_clientid,
                    'fileresource_type' => 'project',
                    'fileresource_id' => $project->project_id,
                    'file_directory' => $uniqueid,
                    'file_uniqueid' => $uniqueid,
                    'file_upload_unique_key' => str_unique(),
                    'file_folderid' => $default_folder->filefolder_id,
                    'file_filename' => $file_name,
                ];
                //process and save to db
                $this->filerepo->process($file_data);
            }
        }

        //get refreshed event
        $event = $this->getEvent($data);

        Log::info(" updating calender event type [project] with id (" . $data['event_id'] . ") - completed", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        return $event;

        return true;
    }

    /**
     * update a task calendar event
     * @param string $event_id existing events array
     * @return bool
     */
    public function updateTask($data = []) {

        Log::info(" updating calender event type [task] - started", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'payload' => $data]);

        //validate
        if (!isset($data['event_id']) || !isset($data['resource_type'])) {
            Log::error(" updating calender failed - required data missing", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //fetch event
        if (!$event = $this->getEvent($data)) {
            Log::error(" updating calender failed - event with event_id (" . $data['event_id'] . ") could not be fetched", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //fetch the task
        if (!$task = \App\Models\Task::Where('task_uniqueid', $data['event_id'])->first()) {
            Log::error(" updating calender failed - task with task_uniqueid (" . $data['event_id'] . ") could not be fetched", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //update task
        $task->task_title = request('calendar_event_title');
        $task->task_date_start = request('calendar_event_start_date');
        $task->task_date_due = request('calendar_event_end_date');
        $task->task_description = request('calendar_event_description');

        //reset reminder first
        $task->task_calendar_reminder = 'no';
        $task->task_calendar_reminder_date_sent = null;
        $task->task_calendar_reminder_duration = null;
        $task->task_calendar_reminder_period = null;

        //save
        $task->save();

        //update reminder - if applicable
        if (request('calendar_event_reminder') == 'on') {
            //[FUTURE] - get this from the modal form and not the system default
            $duration = config('system.settings2_calendar_reminder_duration');
            $period = config('system.settings2_calendar_reminder_period');
            //save
            $task->task_calendar_reminder = 'yes';
            $task->task_calendar_reminder_duration = $duration;
            $task->task_calendar_reminder_period = $period;
            $task->save();
        }

        //save each attachment
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $attachment_data = [
                    'attachment_clientid' => $task->task_clientid,
                    'attachment_creatorid' => auth()->id(),
                    'attachmentresource_type' => 'task',
                    'attachmentresource_id' => $task->task_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                ];
                //process and save to db
                $this->attachmentrepo->process($attachment_data);
            }
        }

        //get refreshed event
        $event = $this->getEvent($data);

        Log::info(" updating calender event type [task] with id (" . $data['event_id'] . ") - completed", ['process' => '[calender-get-events]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        return $event;

        return true;
    }

    /**
     * determine the date, start time and end time from the url passed when creating a new event (modal)
     * @return array
     */
    public function createEventGetDateTime() {

        //defaults
        $data = [
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => '00:00',
            'end_time' => '00:00',
            'all_day' => 'yes',
        ];

        if (!request()->filled('event_date')) {
            return $data;
        }

        // the input/request date has both [date] and [time] specified. as well as a duration (e.g. '2024-06-26T05:00:00 02:00' )
        if (strpos(request('event_date'), 'T') !== false && strpos(request('event_date'), ' ') !== false) {

            //get the start date_time and the duration
            list($date_time, $duration) = explode(' ', request('event_date'));

            //create a carbon date_time from the date_time string
            $start_date_time = \Carbon\Carbon::parse($date_time);

            //get just the date  (Y-m-d)
            $start_date = $start_date_time->toDateString();

            //get just the start time (23:00)
            $start_time = $start_date_time->format('H:i');

            //add 1 hour to get the end time for the event
            $end_date_time = $start_date_time->copy()->addMinutes(config('system.settings2_calendar_default_event_duration'));
            $end_time = $end_date_time->format('H:i');

            //save to an array
            $data = [
                'start_date' => $start_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'all_day' => 'no',
            ];
        } else {

            $data['start_date'] = request('event_date');

        }

        //return the date payload
        return $data;
    }

    /**
     * determine the date, start time and end time from the url passed when creating a new event (modal)
     * @return array
     */
    public function fixEndingDate($date = '') {

        //validate
        if ($date == '') {
            return null;
        }

        //try and add 1 day to the end date
        try {
            $carbon_date = \Carbon\Carbon::createFromFormat('Y-m-d', $date);

            // Check if the date matches the 'Y-m-d' format exactly
            if ($carbon_date->format('Y-m-d') === $date) {
                return $carbon_date->addDay()->format('Y-m-d');
            }
        } catch (InvalidFormatException $e) {
            return $date;
        }

        return null;
    }

}