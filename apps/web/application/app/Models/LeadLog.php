<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadLog extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'lead_logs';
    protected $primaryKey = 'lead_log_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['lead_log_id'];
    const CREATED_AT = 'lead_log_created';
    const UPDATED_AT = 'lead_log_updated';

    /**
     * relatioship business rules:
     *         - the LeadLog belongs to one Lead
     */
    public function lead() {
        return $this->belongsTo('App\Models\Lead', 'lead_log_leadid', 'lead_id');
    }

    /**
     * relatioship business rules:
     *         - the LeadLog belongs to one User (creator)
     */
    public function creator() {
        return $this->belongsTo('App\Models\User', 'lead_log_creatorid', 'id');
    }

}