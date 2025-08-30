<?php

/** -------------------------------------------------------------------------------------------------
 * SEND CALENDAR EVENT REMINDERS
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *  - Find all events, tasks, projects that are due for a reminder
 *  - Email add assigned members
 *
 * @package    Grow CRM
 * @author     NextLoop
 *---------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs;

class CalendarReminderCron {

    public function __invoke(

    ) {

        //[MT] - tenants only
        if (env('MT_TPYE')) {
            if (\Spatie\Multitenancy\Models\Tenant::current() == null) {
                return;
            }
        }

        //boot system settings
        middlewareBootSettings();

        //[MT] boot mail settings
        env('MT_TPYE') ? middlewareSaaSBootMail() : middlewareBootMail();

        //Send reminders for all event types
        $this->calendarEvents();
        $this->projectEvents();
        $this->taskEvents();

        //reset last cron run data
        \App\Models\Settings::where('settings_id', 1)
            ->update([
                'settings_cronjob_has_run' => 'yes',
                'settings_cronjob_last_run' => now(),
            ]);
    }

    /**------------------------------------------------------------------
     * TYPE - [EVENTS]
     *------------------------------------------------------------------*/
    public function calendarEvents() {

        //defaults
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $events = [];

        //get the events - based on 'start date'
        if (config('system.settings2_calendar_send_reminder_events') == 'start-date') {
            $events = \App\Models\CalendarEvent::Where('calendar_event_reminder', 'yes')
                ->where('calendar_event_reminder_sent', '!=', 'yes')
                ->where('calendar_event_start_date', '<', $today)
                ->take(5)->get();
        }

        //get the events - based on 'due date'
        if (config('system.settings2_calendar_send_reminder_events') == 'due-date') {
            $events = \App\Models\CalendarEvent::Where('calendar_event_reminder', 'yes')
                ->where('calendar_event_reminder_sent', '!=', 'yes')
                ->where('calendar_event_end_date', '<', $today)
                ->take(5)->get();
        }

        //process each task
        foreach ($events as $event) {

            //[sharing] - all team members
            if ($event->calendar_event_sharing == 'whole-team') {
                $assigned = config('system.team_members');
            }

            //[sharing] - assigned users
            if ($event->calendar_event_sharing == 'selected-users') {
                $assigned = $event->assigned;
            }

            //[sharing] - myself
            if ($event->calendar_event_sharing == 'myself') {
                $assigned = \App\Models\User::Where('id', $event->calendar_event_creatorid)->get();
            }

            //event data
            $data = [
                'event_type' => __('lang.event'),
                'event_title' => $event->calendar_event_title,
                'event_details' => $event->calendar_event_description ?? '---',
                'event_start_date' => runtimeDate($event->calendar_event_start_date),
                'event_end_date' => runtimeDate($event->calendar_event_end_date),
                'event_start_time' => ($event->calendar_event_all_day == 'yes') ? '---' : $event->calendar_event_start_time,
                'event_end_time' => ($event->calendar_event_all_day == 'yes') ? '---' : $event->calendar_event_end_time,
                'event_url' => url('/calendar'),
            ];

            //queue email
            foreach ($assigned as $user) {
                $mail = new \App\Mail\CalendarReminder($user, $data);
                $mail->build();
            }

            //update as reminder sent
            $event->calendar_event_reminder_sent = 'yes';
            $event->calendar_event_reminder_date_sent = now();
            $event->save();

        }

    }

    /**------------------------------------------------------------------
     * TYPE - [PROJECTS]
     *------------------------------------------------------------------*/
    public function projectEvents() {

        //defaults
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $projects = [];

        //get the events - based on 'start date'
        if (config('system.settings2_calendar_send_reminder_projects') == 'start-date') {
            $projects = \App\Models\Project::where('project_calendar_reminder', 'yes')
                ->where(function ($query) {
                    $query->where('project_calendar_reminder_sent', '!=', 'yes')
                        ->orWhereNull('project_calendar_reminder_sent');
                })
                ->where('project_date_due', '<', $today)
                ->take(5)
                ->get();
        }

        //get the events - based on 'due date'
        if (config('system.settings2_calendar_send_reminder_projects') == 'due-date') {
            $projects = \App\Models\Project::where('project_calendar_reminder', 'yes')
                ->where(function ($query) {
                    $query->where('project_calendar_reminder_sent', '!=', 'yes')
                        ->orWhereNull('project_calendar_reminder_sent');
                })
                ->where('project_date_due', '<', $today)
                ->take(5)
                ->get();
        }

        //process each task
        foreach ($projects as $project) {

            //[sharing] - all team members
            $assigned = $project->assigned;

            //event data
            $data = [
                'event_type' => __('lang.event'),
                'event_title' => $project->project_title,
                'event_details' => $project->project_description ?? '---',
                'event_start_date' => runtimeDate($project->project_date_start),
                'event_end_date' => runtimeDate($project->project_date_due),
                'event_start_time' => '---',
                'event_end_time' => '---',
                'event_url' => url('/projects/' . $project->project_id),
            ];

            //queue email
            foreach ($assigned as $user) {
                $mail = new \App\Mail\CalendarReminder($user, $data);
                $mail->build();
            }

            //update as reminder sent
            $project->project_calendar_reminder_sent = 'yes';
            $project->project_calendar_reminder_date_sent = now();
            $project->save();

        }

    }

    /**------------------------------------------------------------------
     * TYPE - [TASKS]
     *------------------------------------------------------------------*/
    public function taskEvents() {

        //defaults
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $tasks = [];

        //get the events - based on 'start date'
        if (config('system.settings2_calendar_send_reminder_tasks') == 'start-date') {
            $tasks = \App\Models\Task::Where('task_calendar_reminder', 'yes')
                ->where(function ($query) {
                    $query->where('task_calendar_reminder_sent', '!=', 'yes')
                        ->orWhereNull('task_calendar_reminder_sent');
                })
                ->where('task_date_start', '<', $today)
                ->take(5)->get();
        }

        //get the events - based on 'due date'
        if (config('system.settings2_calendar_send_reminder_tasks') == 'due-date') {
            $tasks = \App\Models\Task::Where('task_calendar_reminder', 'yes')
                ->where(function ($query) {
                    $query->where('task_calendar_reminder_sent', '!=', 'yes')
                        ->orWhereNull('task_calendar_reminder_sent');
                })
                ->where('task_date_due', '<', $today)
                ->take(5)->get();
        }

        //process each task
        foreach ($tasks as $task) {

            //[sharing] - all team members
            $assigned = $task->assigned;

            //event data
            $data = [
                'event_type' => __('lang.event'),
                'event_title' => $task->task_title,
                'event_details' => $task->task_description ?? '---',
                'event_start_date' => runtimeDate($task->task_date_start),
                'event_end_date' => runtimeDate($task->task_date_due),
                'event_start_time' => '---',
                'event_end_time' => '---',
                'event_url' => url('/tasks/' . $task->task_id),
            ];

            //queue email
            foreach ($assigned as $user) {
                $mail = new \App\Mail\CalendarReminder($user, $data);
                $mail->build();
            }

            //update as reminder sent
            $task->task_calendar_reminder_sent = 'yes';
            $task->task_calendar_reminder_date_sent = now();
            $task->save();

        }

    }
}