<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalenderEventSharing extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */
    protected $table = 'calendar_events_sharing';
    protected $primaryKey = 'calendarsharing_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['calendarsharing_id'];
    const CREATED_AT = 'calendarsharing_created';
    const UPDATED_AT = 'calendarsharing_updated';
}
