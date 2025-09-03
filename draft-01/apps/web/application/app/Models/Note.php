<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'project' => 'App\Models\Project',
    'client' => 'App\Models\Client',
    'user' => 'App\Models\User',
    'lead' => 'App\Models\Lead',
]);

class Note extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'notes';
    protected $primaryKey = 'note_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['note_id'];
    const CREATED_AT = 'note_created';
    const UPDATED_AT = 'note_updated';

    /**
     * relatioship business rules:
     *         - the Creator (user) can have many Notes
     *         - the Note belongs to one Creator (user)
     */
    public function creator() {
        return $this->belongsTo('App\Models\User', 'note_creatorid', 'id');
    }

    /**
     * relatioship business rules:
     *         - projects, clients, users etc can have many Notes
     *         - the Note can belong to just one of the above
     *         - notes table columns named as [noteresource_type noteresource_id]
     */
    public function noteresource() {
        return $this->morphTo();
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
     * relationship: project
     * when noteresource_type = project; get the project via noteresource_id
     */
    public function project() {
        return $this->belongsTo('App\Models\Project', 'noteresource_id', 'project_id');
    }

    /**
     * relationship: user
     * based on noteresource_type, get the related user
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'noteresource_id', 'id');
    }

    /**
     * relationship: client
     * based on noteresource_type, get the related client
     */
    public function client() {
        return $this->belongsTo('App\Models\Client', 'noteresource_id', 'client_id');
    }

    /**
     * check if the note is starred by the current user
     * @return bool
     */
    public function getIsStarredAttribute() {
        if (!auth()->check()) {
            return false;
        }

        return \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'note')
            ->where('starred_resource_id', $this->note_id)
            ->exists();
    }

}