<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImapLog extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'imaplog';
    protected $primaryKey = 'imaplog_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['imaplog_id'];
    const CREATED_AT = 'imaplog_created';
    const UPDATED_AT = 'imaplog_updated';

}
