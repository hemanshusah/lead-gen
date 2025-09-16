<?php

/** -------------------------------------------------------------------------------------------------------------------
 * @description
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *
 * @package    Grow CRM
 * @author     NextLoop
 *
 *------------------------------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs\Cleanup;
use App\Repositories\ProjectRepository;

class FooCron {

    protected $destroyrepo;

    public function __invoke(
        ProjectRepository $projectrepo
    ) {

        $this->destroyrepo = $destroyrepo;

        //[MT] - tenants only
        if (env('MT_TPYE')) {
            if (\Spatie\Multitenancy\Models\Tenant::current() == null) {
                return;
            }
        }

        //boot system settings
        middlewareBootSettings();

        //[MT] boot mail settings
        env('MT_TPYE') ? middlewareSaaSBootMail() : middlewareBootMail();

        //boot theme for things that need css
        middlewareBootTheme();

        //run the foo
        $this->fooFbar();
    }

    /**
     *
     * @details :
     *   - looks for project ......
     *
     *
     */
    public function fooFbar() {

    }

}