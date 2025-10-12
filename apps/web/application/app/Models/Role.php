<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;

class Role extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */
    protected $primaryKey = 'role_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['role_id'];
    const CREATED_AT = 'role_created';
    const UPDATED_AT = 'role_updated';

    /**
     * get all team level roles
     * @return string
     */
    public function getTeamRoles() {
        return strtolower($this->role->role_name);
    }

    /**
     * relatioship business rules:
     *         - the Project can have many Estimates
     *         - the Estimate belongs to one Project
     */
    public function users() {
        return $this->hasMany('App\Models\User', 'role_id', 'role_id');
    }

/**
 * Get the current user's permissions for any module that is stored in the 'modules' field in the 'roles' table.
 * Usage: auth()->user()->role->module->services (none/view/manage)
 * This has error handling so that non-existent modules will not throw an error but just return 'none'.
 * Example: auth()->user()->role->module->foobar (returns 'none')
 */
    protected function getModuleAttribute() {

        //return none for user not logged in
        if (!auth()->check()) {
            return 'none';
        }

        try {
            // Decode the JSON or return an empty array if null
            $modules = json_decode($this->attributes['modules'] ?? '[]', true);

            // Transform module permissions into a key-value array
            $permissions = [];
            foreach ($modules as $module) {
                $key = str_replace(' ', '_', strtolower($module['module_name']));
                $permissions[$key] = strtolower($module['module_permission']);
            }

            // Return an anonymous class with dynamic property handling
            return new class($permissions) {
                protected $permissions;

                public function __construct(array $permissions) {
                    $this->permissions = $permissions;
                }

                public function __get($key) {
                    // Return the permission if it exists, otherwise return 'none'
                    return $this->permissions[$key] ?? 'none';
                }
            };
        } catch (Exception $e) {
            // Return an empty anonymous class if there's any error
            return new class {
                public function __get($key) {
                    return 'none';
                }
            };
        }
    }
}
