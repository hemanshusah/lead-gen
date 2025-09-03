<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */
    protected $primaryKey = 'project_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['project_id'];
    const CREATED_AT = 'project_created';
    const UPDATED_AT = 'project_updated';

    /**
     * relatioship business rules:
     *         - the Creator (user) can have many Projects
     *         - the Project belongs to one User (user)
     */
    public function creator() {
        return $this->belongsTo('App\Models\User', 'project_creatorid', 'id');
    }

    /**
     * relatioship business rules:
     *         - the Client can have many Projects
     *         - the Project belongs to one Client
     */
    public function client() {
        return $this->belongsTo('App\Models\Client', 'project_clientid', 'client_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Tasks
     *         - the Task belongs to one Project
     */
    public function tasks() {
        return $this->hasMany('App\Models\Task', 'task_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Invoices
     *         - the Invoice belongs to one Project
     */
    public function invoices() {
        return $this->hasMany('App\Models\Invoice', 'bill_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Estimates
     *         - the Estimate belongs to one Project
     */
    public function estimates() {
        return $this->hasMany('App\Models\Estimate', 'bill_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Notes
     *         - the Note belongs to one Project
     *         - other Note can belong to other tables (Leads, etc)
     */
    public function notes() {
        return $this->morphMany('App\Models\Note', 'noteresource');
    }

    /**
     * relatioship business rules:
     *         - the Category can have many Projects
     *         - the Project belongs to one Category
     */
    public function category() {
        return $this->belongsTo('App\Models\Category', 'project_categoryid', 'category_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Contracts
     *         - the Contract belongs to one Project
     */
    public function contracts() {
        return $this->hasMany('App\Models\Contract', 'doc_project_id', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Comments
     *         - the Comment belongs to one Project
     *         - other Comments can belong to other tables
     */
    public function comments() {
        return $this->morphMany('App\Models\Comment', 'commentresource');
    }

    /**
     * relatioship business rules:
     *         - the Client can have many Expenses
     *         - the Expense belongs to one Client
     */
    public function expenses() {
        return $this->hasMany('App\Models\Expense', 'expense_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Events
     *         - the Event belongs to one Project
     *         - other Event can belong to other tables (Leads, etc)
     */
    public function events() {
        return $this->morphMany('App\Models\Event', 'eventresource');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Files
     *         - the File belongs to one Project
     *         - other Files can belong to other tables (Client, etc)
     */
    public function files() {
        return $this->morphMany('App\Models\File', 'fileresource');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Payments
     *         - the Payment belongs to one Project
     */
    public function payments() {
        return $this->hasMany('App\Models\Payment', 'payment_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Tags
     *         - the Tags belongs to one Project
     *         - other tags can belong to other tables
     */
    public function tags() {
        return $this->morphMany('App\Models\Tag', 'tagresource');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Milestones
     *         - the Milestone belongs to one Project
     */
    public function milestones() {
        return $this->hasMany('App\Models\Milestone', 'milestone_projectid', 'project_id');
    }

    /**
     * The Users that are assigned to the Project.
     */
    public function assigned() {
        return $this->belongsToMany('App\Models\User', 'projects_assigned', 'projectsassigned_projectid', 'projectsassigned_userid');
    }

    /**
     * The Users that are managers for the Project.
     */
    public function managers() {
        return $this->belongsToMany('App\Models\User', 'projects_manager', 'projectsmanager_projectid', 'projectsmanager_userid');
    }

    /**
     * Get all users associated with this project
     * This includes assigned users, managers, and client users
     */
    public function users() {
        // Get assigned users
        $assigned = $this->assigned()->get();

        // Get project managers
        $managers = $this->managers()->get();

        // Get client users
        $clientUsers = collect();
        if ($this->client) {
            $clientUsers = $this->client->users()->get();
        }

        // Merge all collections and get unique users by id
        return $assigned->merge($managers)->merge($clientUsers)->unique('id');
    }

    /**
     * The assigned users table records
     */
    public function assignedrecords() {
        return $this->hasMany('App\Models\ProjectAssigned', 'projectsassigned_projectid', 'project_id');
    }

    /**
     * The project managers table records
     */
    public function managerrecords() {
        return $this->hasMany('App\Models\ProjectManager', 'projectsmanager_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Timers
     *         - the Timers belongs to one Project
     */
    public function timers() {
        return $this->hasMany('App\Models\Timer', 'timer_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Tickets
     *         - the Tickets belongs to one Project
     */
    public function tickets() {
        return $this->hasMany('App\Models\Ticket', 'ticket_projectid', 'project_id');
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Starred entries
     *         - the Starred belongs to one Project
     *         - uses morphMany for polymorphic relationship
     */
    public function starred() {
        return $this->morphMany('App\Models\Starred', 'starredresource', 'starred_resource_type', 'starred_resource_id');
    }

    /**
     * check if the project is starred by the current user
     * @return bool
     */
    public function getIsStarredAttribute() {
        if (!auth()->check()) {
            return false;
        }

        return \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'project')
            ->where('starred_resource_id', $this->project_id)
            ->exists();
    }

    
    /**
     * check if the project's comments are starred by the current user
     * @return bool
     */
    public function getIsCommentStarredAttribute() {
        if (!auth()->check()) {
            return false;
        }

        return \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'project-comments')
            ->where('starred_resource_id', $this->project_id)
            ->exists();
    }

    /**
     * get the latest activity for this project
     * @return object|null
     */
    public function getLatestActivityAttribute() {
        $latestEvent = \App\Models\Event::where('eventresource_type', 'project')
            ->where('eventresource_id', $this->project_id)
            ->with('creator')
            ->orderBy('event_created', 'desc')
            ->first();

        if (!$latestEvent) {
            return null;
        }

        return (object) [
            'date' => $latestEvent->event_created,
            'user' => $latestEvent->creator,
        ];
    }
}
