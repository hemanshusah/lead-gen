<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'currencies';
    protected $primaryKey = 'currency_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['currency_id'];
    const CREATED_AT = 'currency_created';
    const UPDATED_AT = 'currency_updated';

}
