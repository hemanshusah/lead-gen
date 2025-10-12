<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */
    protected $primaryKey = 'task_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['task_id'];
    const CREATED_AT = 'task_created';
    const UPDATED_AT = 'task_updated';

    /**
     * relatioship business rules:
     *         - the Project can have many Task
     *         - the Task belongs to one Project
     */
    public function project() {
        return $this->belongsTo('App\Models\Project', 'task_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Creator (user) can have many Tasks
     *         - the Task belongs to one Creator (user)
     */
    public function creator() {
        return $this->belongsTo('App\Models\User', 'task_creatorid', 'id');
    }

    /**
     * relatioship business rules:
     *         - the Task can have many Comments
     *         - the Comment belongs to one Task
     *         - other Comments can belong to other tables
     */
    public function comments() {
        return $this->morphMany('App\Models\Comment', 'commentresource');
    }

    /**
     * relatioship business rules:
     *         - the Task can have many Comments
     *         - the Checklist belongs to one Task
     */
    public function checklists() {
        return $this->morphMany('App\Models\Checklist', 'checklistresource');
    }

    /**
     * relatioship business rules:
     *         - the Task can have many Attachments
     *         - the Attachment belongs to one Task
     *         - other Attachments can belong to other tables
     */
    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }

    /**
     * relatioship business rules:
     *         - the Task can have many Tags
     *         - the Tags belongs to one Task
     *         - other tags can belong to other tables
     */
    public function tags() {
        return $this->morphMany('App\Models\Tag', 'tagresource');
    }

    /**
     * relatioship business rules:
     *         - the Client can have many Tickets
     *         - the Ticket belongs to one Client
     */
    public function timers() {
        return $this->hasMany('App\Models\Timer', 'timer_taskid', 'task_id');
    }

    /**
     * The Users that are assigned to the Task.
     */
    public function assigned() {
        return $this->belongsToMany('App\Models\User', 'tasks_assigned', 'tasksassigned_taskid', 'tasksassigned_userid');
    }

    /**
     * relatioship business rules:
     *         - the Milestone can have many Tasks
     *         - the Task belongs to one Milestone
     */
    public function milestone() {
        return $this->belongsTo('App\Models\Milestone', 'task_milestoneid', 'milestone_id');
    }

    /**
     * The Users that are managers for the Project that this task belongs to
     */
    public function projectmanagers() {
        return $this->hasMany('App\Models\ProjectManager', 'projectsmanager_projectid', 'task_projectid');
    }

    /**
     * The assigned users table records
     */
    public function assignedrecords() {
        return $this->hasMany('App\Models\TaskAssigned', 'tasksassigned_taskid', 'task_id');
    }

    /**
     * relatioship business rules:
     *         - the Task can have many Events
     *         - the Event belongs to one Task
     *         - other Event can belong to other tables (Leads, etc)
     */
    public function events() {
        return $this->morphMany('App\Models\Event', 'eventresource');
    }

    /**
     * relatioship business rules:
     *         - the Task can have many reminders
     *         - the reminder belongs to one Task
     *         - other reminders can belong to other resources
     */
    public function reminders() {
        return $this->morphMany('App\Models\Reminder', 'reminderresource');
    }

    /**
     * relatioship business rules:
     *         - the Task Status can have many Tasks
     *         - the Task belongs to one Task Status
     */
    public function status() {
        return $this->belongsTo('App\Models\TaskStatus', 'task_status', 'taskstatus_id');
    }

    /**
     * Get total time logged for this task
     * @return int (seconds)
     */
    public function getTimeLoggedAttribute() {
        return $this->timers()
            ->where('timer_status', 'stopped')
            ->sum('timer_time');
    }

    /**
     * Get time already billed for this task
     * @return int (seconds)
     */
    public function getTimeBilledAttribute() {
        return $this->timers()
            ->where('timer_billing_status', 'invoiced')
            ->where('timer_status', 'stopped')
            ->sum('timer_time');
    }

    /**
     * Get unbilled time for this task
     * @return int (seconds)
     */
    public function getTimeUnbilledAttribute() {
        return $this->timers()
            ->where('timer_billing_status', 'not_invoiced')
            ->where('timer_status', 'stopped')
            ->sum('timer_time');
    }

    /**
     * Get comma separated list of unbilled timer IDs for this task
     * @return string
     */
    public function getTimeUnbilledTimersAttribute() {
        return $this->timers()
            ->where('timer_billing_status', 'not_invoiced')
            ->where('timer_status', 'stopped')
            ->pluck('timer_id')
            ->implode(',');
    }

    /**
     * Get the latest activity for this task
     * @usage $task->latest_activity
     * @return object with date and user properties
     */
    public function getLatestActivityAttribute() {
        //get the latest event for this task
        $event = \App\Models\Event::where('event_parent_type', 'task')
            ->where('event_parent_id', $this->task_id)
            ->with('creator')
            ->orderBy('event_created', 'desc')
            ->first();

        //return object with date and user
        if ($event) {
            return (object) [
                'date' => $event->event_created,
                'user' => $event->creator,
            ];
        }

        //return default object
        return (object) [
            'date' => '0000-00-00 00:00:00',
            'user' => null,
        ];
    }

    /**
     * relatioship business rules:
     *         - the Task can have many Starred entries
     *         - the Starred belongs to one Task
     *         - uses morphMany for polymorphic relationship
     */
    public function starred() {
        return $this->morphMany('App\Models\Starred', 'starredresource', 'starred_resource_type', 'starred_resource_id');
    }

    /**
     * check if the task is starred by the current user
     * @return bool
     */
    public function getIsStarredAttribute() {
        if (!auth()->check()) {
            return false;
        }

        return \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'task')
            ->where('starred_resource_id', $this->task_id)
            ->exists();
    }
}
