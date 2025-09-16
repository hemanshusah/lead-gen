<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'modules';
    protected $primaryKey = 'module_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['module_id'];
    const CREATED_AT = 'module_created';
    const UPDATED_AT = 'module_updated';

}
