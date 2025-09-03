<?php

namespace App\Cronjobs\Modules;

use App\Models\Module;
use App\Models\Role;
use App\Repositories\Modules\ModuleRolesRespository;

/**
 * Class SyncModulesCron
 *
 * This class handles the periodic synchronization of permissions for active modules across all roles.
 * The cron job fetches active modules and assigns appropriate permissions to each user role.
 */
class SyncModulesCron {
    /**
     * Invoke method that is called by the scheduler.
     * Triggers the module permission synchronization process.
     */
    public function __invoke(ModuleRolesRespository $modulerepo) {

        //[MT] - tenants only
        if (env('MT_TPYE')) {
            if (\Spatie\Multitenancy\Models\Tenant::current() == null) {
                return;
            }
        }

        //sync user role permissions
        $modulerepo->syncModulePermissions();
    }

}
