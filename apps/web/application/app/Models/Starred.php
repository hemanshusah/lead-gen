<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'project' => 'App\Models\Project',
    'project-comments' => 'App\Models\Project',
    'note' => 'App\Models\Note',
    'client' => 'App\Models\Client',
    'task' => 'App\Models\Task',
]);

class Starred extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'starred';
    protected $primaryKey = 'starred_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['starred_id'];
    const CREATED_AT = 'starred_created';
    const UPDATED_AT = 'starred_updated';

    /**
     * relatioship business rules:
     *         - the Starred can belong to different resource types
     *         - uses morphTo for polymorphic relationship
     */
    public function starredresource() {
        return $this->morphTo('starredresource', 'starred_resource_type', 'starred_resource_id');
    }

    /**
     * relatioship business rules:
     *         - the Starred belongs to one User
     *         - the User can have many Starred entries
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'starred_userid', 'id');
    }

}