<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */
    protected $primaryKey = 'timer_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['timer_id'];
    const CREATED_AT = 'timer_created';
    const UPDATED_AT = 'timer_updated';

    /**
     * relatioship business rules:
     *         - the Creator (user) can have many Timers
     *         - the Timer belongs to one Creator (user)
     */
    public function creator() {
        return $this->belongsTo('App\Models\User', 'timer_creatorid', 'id');
    }

    /**
     * relatioship business rules:
     *         - the Client can have many Ticket
     *         - the Ticket belongs to one Client
     */
    public function task() {
        return $this->belongsTo('App\Models\Task', 'timer_taskid', 'task_id');
    }

    /**
     * timer_recorded_by field links to user user table
     *         - first_name
     *         - last_name
     */
    public function getRecordedByAttribute() {

        // Find the user who recorded the timer
        $user = User::find($this->timer_recorded_by);

        // Return user's full name or a default value if user not found
        if ($user) {
            return $user->first_name . ' ' . $user->last_name;
        }

        return '---';
    }

}
