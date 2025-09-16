<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'calendar_events';
    protected $primaryKey = 'calendar_event_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['calendar_event_id'];
    const CREATED_AT = 'calendar_event_created';
    const UPDATED_AT = 'calendar_event_updated';

    /**
     * The Users that are assigned to the Event.
     */
    public function assigned() {
        return $this->belongsToMany('App\Models\User', 'calendar_events_sharing', 'calendarsharing_eventid', 'calendarsharing_userid');
    }

}
