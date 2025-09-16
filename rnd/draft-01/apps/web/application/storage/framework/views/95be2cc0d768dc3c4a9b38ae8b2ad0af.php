<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul data-modular-id="reports_tabs_menu" class="nav nav-tabs profile-tab reports-top-nav list-pages-crumbs"
            role="tablist">

            
            <!--[MODULES] - dynamic menu-->
            <?php echo config('modules.menus.reports.parent1'); ?>


            <!--invoices-->
            <li class="nav-item dropdown <?php echo e($page['reports_tabs_productivty'] ?? ''); ?>">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_invoices" aria-expanded="false">
                    <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.invoices'))); ?></span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/invoices/overview')); ?>"
                        data-url="<?php echo e(url('/report/invoices/overview')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.overview'); ?></a>
                    <!--[monthly]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/invoices/month')); ?>"
                        data-url="<?php echo e(url('/report/invoices/month')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.monthly'); ?></a>
                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/invoices/client')); ?>"
                        data-url="<?php echo e(url('/report/invoices/client')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.client_invoices'); ?></a>
                    <!--[project-category]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/invoices/category')); ?>"
                        data-url="<?php echo e(url('/report/invoices/category')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.invoice_category'); ?></a>

                    <!--[MODULES] - dynamic menu-->
                    <?php echo config('modules.menus.reports.invoices'); ?>

                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            <?php echo config('modules.menus.reports.parent2'); ?>


            <!--estimates-->
            <li class="nav-item dropdown <?php echo e($page['reports_tabs_productivty'] ?? ''); ?>">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_estimates" aria-expanded="false">
                    <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.estimates'))); ?></span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/estimates/overview')); ?>"
                        data-url="<?php echo e(url('/report/estimates/overview')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.overview'); ?></a>
                    <!--[monthly]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/estimates/month')); ?>"
                        data-url="<?php echo e(url('/report/estimates/month')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.monthly'); ?></a>
                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/estimates/client')); ?>"
                        data-url="<?php echo e(url('/report/estimates/client')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.client_estimates'); ?></a>
                    <!--[project-category]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/estimates/category')); ?>"
                        data-url="<?php echo e(url('/report/estimates/category')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.estimate_category'); ?></a>
                    <!--[MODULES] - dynamic menu-->
                    <?php echo config('modules.menus.reports.estimates'); ?>

                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            <?php echo config('modules.menus.reports.parent3'); ?>


            <!--projects-->
            <li class="nav-item dropdown <?php echo e($page['reports_tabs_productivty'] ?? ''); ?>">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_projects" aria-expanded="false">
                    <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.projects'))); ?></span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/projects/overview')); ?>"
                        data-url="<?php echo e(url('/report/projects/overview')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.overview'); ?></a>
                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/projects/client')); ?>"
                        data-url="<?php echo e(url('/report/projects/client')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.client_projects'); ?></a>
                    <!--[project-category]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/projects/category')); ?>"
                        data-url="<?php echo e(url('/report/projects/category')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.project_category'); ?></a>
                    <!--[MODULES] - dynamic menu-->
                    <?php echo config('modules.menus.reports.projects'); ?>

                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            <?php echo config('modules.menus.reports.parent4'); ?>


            <!--clients-->
            <li class="nav-item dropdown <?php echo e($page['reports_tabs_productivty'] ?? ''); ?>">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_clients" aria-expanded="false">
                    <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.clients'))); ?></span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/clients/overview')); ?>"
                        data-url="<?php echo e(url('/report/clients/overview')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.overview'); ?></a>
                    <!--[MODULES] - dynamic menu-->
                    <?php echo config('modules.menus.reports.clients'); ?>

                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            <?php echo config('modules.menus.reports.parent5'); ?>


            <!--timesheets-->
            <li class="nav-item dropdown <?php echo e($page['reports_tabs_productivty'] ?? ''); ?>">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_timesheets" aria-expanded="false">
                    <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.timesheets'))); ?></span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[team_member]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/timesheets/team')); ?>"
                        data-url="<?php echo e(url('/report/timesheets/team')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.team_member'); ?></a>

                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/timesheets/client')); ?>"
                        data-url="<?php echo e(url('/report/timesheets/client')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.client'); ?></a>

                    <!--[project]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/timesheets/project')); ?>"
                        data-url="<?php echo e(url('/report/timesheets/project')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.project'); ?></a>
                    <!--[MODULES] - dynamic menu-->
                    <?php echo config('modules.menus.reports.timesheets'); ?>

                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            <?php echo config('modules.menus.reports.parent6'); ?>


            <!--financial-->
            <li class="nav-item dropdown <?php echo e($page['reports_tabs_productivty'] ?? ''); ?>">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_financial" aria-expanded="false">
                    <span class="hidden-xs-down"><?php echo e(cleanLang(__('lang.financial'))); ?></span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[profit and loss]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="<?php echo e(url('/reports/financial/income-expenses')); ?>"
                        data-url="<?php echo e(url('/report/financial/income-expenses')); ?>" href="javascript:void(0);"
                        role="tab"><?php echo app('translator')->get('lang.income_vs_expenses'); ?></a>
                    <!--[MODULES] - dynamic menu-->
                    <?php echo config('modules.menus.reports.financial'); ?>

                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            <?php echo config('modules.menus.reports.parent7'); ?>


        </ul>
        <!-- Tab panes -->
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/reports/components/misc/topnav.blade.php ENDPATH**/ ?>