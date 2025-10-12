<?php

namespace App\Permissions;

use App\Permissions\LeadPermissions;
use App\Permissions\ProjectPermissions;
use App\Permissions\TaskPermissions;
use App\Repositories\ChecklistRepository;
use Illuminate\Support\Facades\Log;

class ChecklistPermissions {

    /**
     * The checklist repository instance.
     */
    protected $checklistrepo;

    /**
     * The project permissions instance.
     */
    protected $projectpermissons;

    /**
     * The project permissions instance.
     */
    protected $leadpermissons;

    /**
     * The task permissions instance.
     */
    protected $taskpermissons;

    /**
     * Inject dependecies
     */
    public function __construct(
        ChecklistRepository $checklistrepo,
        ProjectPermissions $projectpermissons,
        LeadPermissions $leadpermissons,
        TaskPermissions $taskpermissons
    ) {

        $this->checklistrepo = $checklistrepo;
        $this->projectpermissons = $projectpermissons;
        $this->taskpermissons = $taskpermissons;
        $this->leadpermissons = $leadpermissons;

    }

    /**
     * The array of checks that are available.
     * NOTE: when a new check is added, you must also add it to this array
     * @return array
     */
    public function permissionChecksArray() {
        $checks = [
            'view',
            'create',
            'edit-delete',
            'comment',
            'general-create',
            'general-edit',
            'general-delete',
        ];
        return $checks;
    }

    /**
     * This method checks a users permissions for a particular, specified Checklist ONLY.
     *
     * [EXAMPLE USAGE]
     *          if (!$this->checklistpermissons->check($checklist_id, 'delete')) {
     *                 abort(413)
     *          }
     *
     * @param string $action [required] intended action on the resource se list above
     * @param mixed $checklist object or id of the resource, or resource_id for view/create actions
     * @return bool true if user has permission
     */
    public function check($action = '', $checklist = '') {

        //VALIDATION
        if (!in_array($action, $this->permissionChecksArray())) {
            Log::error("the requested check is invalid", ['process' => '[permissions][checklist]', config('app.debug_ref'), 'function' => __function__, 'checklist' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'check' => $action ?? '']);
            return false;
        }

        //GET THE RESOURCE for edit-delete and comment actions
        if (in_array($action, ['edit-delete', 'comment'])) {
            if (is_numeric($checklist)) {
                if (!$checklist = \App\Models\Checklist::Where('checklist_id', $checklist)->first()) {
                    Log::error("the checklist could not be found", ['process' => '[permissions][checklist]', config('app.debug_ref'), 'function' => __function__, 'checklist' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    return false;
                }
            }

            //[IMPORTANT]: any passed checklist object must from checklistrepo->search() method, not the checklist model
            if (!($checklist instanceof \App\Models\Checklist || $checklist instanceof \Illuminate\Pagination\LengthAwarePaginator)) {
                Log::error("the checklist could not be found", ['process' => '[permissions][checklist]', config('app.debug_ref'), 'function' => __function__, 'checklist' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }
        }

        /**
         * [ADMIN]
         * Grant full permission for whatever request
         */
        if (auth()->user()->role_id == 1) {
            return true;
        }

        /**
         * [VIEW CHECKLISTS]
         */
        if ($action == 'view') {
            //for view action, $checklist is the resource_id
            $resource_id = $checklist;

            //team users
            if (auth()->user()->is_team) {
                if ($project_users = $this->projectpermissons->check('users', $resource_id)) {
                    //return true if current user is in the array of user id's for this project
                    return in_array(auth()->id(), $project_users);
                }
            }

            //client users
            if (auth()->user()->is_client) {
                if (config('settings.settings_projects_clientperm_checklists') != 'none') {
                    return true;
                }
            }
        }

        /**
         * [CREATE CHECKLISTS]
         */
        if ($action == 'create') {
            //for create action, $checklist is the resource_id
            $resource_id = $checklist;

            //team users
            if (auth()->user()->is_team) {
                if (config('settings.settings_projects_assignedperm_manage_checklists') == 'yes') {
                    if ($project_users = $this->projectpermissons->check('users', $resource_id)) {
                        //return true if current user is in the array of user id's for this project
                        return in_array(auth()->id(), $project_users);
                    }
                } else {
                    return $this->projectpermissons->check('super-user', $resource_id);
                }
            }

            //client users
            if (auth()->user()->is_client) {
                if (config('settings.settings_projects_clientperm_checklists') == 'manage') {
                    return true;
                }
            }
        }

        /**
         * [DELETE/EDIT CHECKLISTS]
         */
        if ($action == 'edit-delete') {
            //task checklists
            if ($checklist->checklistresource_type == 'task') {
                if ($this->taskpermissons->check('edit', $checklist->checklistresource_id)) {
                    return true;
                }
            }

            //lead checklists
            if ($checklist->checklistresource_type == 'lead') {
                if ($this->leadpermissons->check('edit', $checklist->checklistresource_id)) {
                    return true;
                }
            }

            //project checklists
            if ($checklist->checklistresource_type == 'project') {
                //team users
                if (auth()->user()->is_team) {
                    if ($project_users = $this->projectpermissons->check('users', $checklist->checklistresource_id)) {
                        return in_array(auth()->id(), $project_users);
                    } else {
                        return $this->projectpermissons->check('super-user', $checklist->checklistresource_id);
                    }
                }

                //client users
                if (auth()->user()->is_client) {
                    if (config('settings.settings_projects_clientperm_checklists') == 'manage') {
                        return true;
                    }
                }
            }
        }

        /**
         * [COMMENT IN CHECKLISTS]
         */
        if ($action == 'comment') {
            //task checklists
            if ($checklist->checklistresource_type == 'task') {
                if ($this->taskpermissons->check('participate', $checklist->checklistresource_id)) {
                    return true;
                }
            }

            //lead checklists
            if ($checklist->checklistresource_type == 'lead') {
                if ($this->leadpermissons->check('participate', $checklist->checklistresource_id)) {
                    return true;
                }
            }

            //project checklists
            if ($checklist->checklistresource_type == 'project') {
                //team users
                if (auth()->user()->is_team) {
                    if ($project_users = $this->projectpermissons->check('users', $checklist->checklistresource_id)) {
                        //return true if current user is in the array of user id's for this project
                        return in_array(auth()->id(), $project_users);
                    }
                }

                //client users
                if (auth()->user()->is_client) {
                    if (config('settings.settings_projects_clientperm_checklists') == 'participate') {
                        return true;
                    }
                }
            }
        }

        //failed
        Log::info("permissions denied on this checklist", ['process' => '[permissions][checklists]', config('app.debug_ref'), 'function' => __function__, 'checklist' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        return false;
    }

    /**
     * Permissions for none task/lead checklists (i.e. general checklists) that are linked to a resorce_type
     *
     * @param string $resource_type - required
     * @param int $resource_id - required
     * @return bool true if user has permission
     */
    public function gneral($resource_type = '', $resource_id = '') {

        //project checklists
        if ($resource_type == 'project') {
            return $this->projectpermissons->check('project-checklist', $resource_id);
        }

    }

}