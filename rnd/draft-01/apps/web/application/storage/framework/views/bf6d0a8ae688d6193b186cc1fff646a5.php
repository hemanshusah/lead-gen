<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">
        <!--SEARCH BOX-->
        <?php if( config('visibility.list_page_actions_search')): ?>
        <div class="header-search" id="header-search">
            <i class="sl-icon-magnifier"></i>
            <input type="text" class="form-control search-records list-actions-search"
                data-url="<?php echo e($page['dynamic_search_url'] ?? ''); ?>" data-type="form" data-ajax-type="post"
                data-form-id="header-search" id="search_query" name="search_query"
                placeholder="<?php echo e(cleanLang(__('lang.search'))); ?>">
        </div>
        <?php endif; ?>

        <!--ARCHIVED TASKS-->
        <?php if(config('visibility.archived_tasks_toggle_button')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.show_archive_tasks'))); ?>"
            id="pref_filter_show_archived_tasks"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-ajax-ux-request <?php echo e(runtimeActive(auth()->user()->pref_filter_show_archived_tasks)); ?>"
            data-url="<?php echo e(urlResource('/tasks/search?action=search&toggle=pref_filter_show_archived_tasks')); ?>">
            <i class="ti-archive"></i>
        </button>
        <?php endif; ?>

        <!--SHOW OWN TASKS-->
        <?php if(config('visibility.own_tasks_toggle_button')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.my_tasks'))); ?>"
            id="pref_filter_own_tasks"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-ajax-ux-request <?php echo e(runtimeActive(auth()->user()->pref_filter_own_tasks)); ?>"
            data-url="<?php echo e(urlResource('/tasks/search?action=search&toggle=pref_filter_own_tasks')); ?>">
            <i class="sl-icon-user"></i>
        </button>
        <?php endif; ?>


        <!--HIDE COMPLETED TASKS-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.hide_completed_tasks'))); ?>"
            id="pref_hide_completed_tasks"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-ajax-ux-request <?php echo e(runtimeActive(auth()->user()->pref_hide_completed_tasks)); ?>"
            data-url="<?php echo e(urlResource('/tasks/search?action=search&toggle=pref_hide_completed_tasks')); ?>">
            <i class="ti-check-box"></i>
        </button>

        <!--TOGGLE STATS-->
        <?php if(config('visibility.stats_toggle_button')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.quick_stats'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-stats-widget update-user-ux-preferences"
            data-type="statspanel" data-progress-bar="hidden"
            data-url-temp="<?php echo e(urlResource('/')); ?>/<?php echo e(auth()->user()->team_or_contact); ?>/updatepreferences" data-url=""
            data-target="list-pages-stats-widget">
            <i class="ti-stats-up"></i>
        </button>
        <?php endif; ?>


        <!--TASKS - KANBAN VIEW & SORTING-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.kanban_view'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-ajax-ux-request"
            data-url="<?php echo e(urlResource('/tasks/search?action=search&toggle=layout')); ?>">
            <i class="sl-icon-list"></i>
        </button>
        <!--kanban task sorting-->
        <div class="btn-group">
            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="list-actions-button btn waves-effect waves-dark dropdown-toggle">
                <i class="mdi mdi-sort"></i></button>
            <div class="dropdown-menu dropdown-menu-right fx-kaban-sorting-dropdown">
                <div class="fx-kaban-sorting-dropdown-container"><?php echo e(cleanLang(__('lang.sort_by'))); ?></div>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_task_created" href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/tasks?action=sort&orderby=task_created&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date_created'))); ?></a>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_task_date_start" href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/tasks?action=sort&orderby=task_date_start&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.start_date'))); ?></a>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_task_date_due" href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/tasks?action=sort&orderby=task_date_due&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.due_date'))); ?></a>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_task_title" href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/tasks?action=sort&orderby=task_title&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.title'))); ?></a>
            </div>
        </div>


        <!--EXPORT-->
        <?php if(config('visibility.list_page_actions_exporting')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.export_tasks'); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="sidepanel-export-tasks">
            <i class="ti-export"></i>
        </button>
        <?php endif; ?>

        <!--FILTERING-->
        <?php if(config('visibility.list_page_actions_filter_button')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.filter'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="<?php echo e($page['sidepanel_id'] ?? ''); ?>">
            <i class="mdi mdi-filter-outline"></i>
        </button>
        <?php endif; ?>


        <!--ADD NEW ITEM-->
        <?php if(config('visibility.list_page_actions_add_button')): ?>
        <button type="button"
            class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form <?php echo e($page['add_button_classes'] ?? ''); ?>"
            data-toggle="modal" data-target="#commonModal" data-url="<?php echo e($page['add_modal_create_url'] ?? ''); ?>"
            data-loading-target="commonModalBody" data-modal-title="<?php echo e($page['add_modal_title'] ?? ''); ?>"
            data-action-url="<?php echo e($page['add_modal_action_url'] ?? ''); ?>"
            data-action-method="<?php echo e($page['add_modal_action_method'] ?? ''); ?>"
            data-action-ajax-class="<?php echo e($page['add_modal_action_ajax_class'] ?? ''); ?>"
            data-modal-size="<?php echo e($page['add_modal_size'] ?? ''); ?>"
            data-action-ajax-loading-target="<?php echo e($page['add_modal_action_ajax_loading_target'] ?? ''); ?>"
            data-save-button-class="<?php echo e($page['add_modal_save_button_class'] ?? ''); ?>" data-project-progress="0">
            <i class="ti-plus"></i>
        </button>
        <?php endif; ?>

        <!--add new button (link)-->
        <?php if( config('visibility.list_page_actions_add_button_link')): ?>
        <a id="fx-page-actions-add-button" type="button" class="btn btn-danger btn-add-circle edit-add-modal-button"
            href="<?php echo e($page['add_button_link_url'] ?? ''); ?>">
            <i class="ti-plus"></i>
        </a>
        <?php endif; ?>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tasks/components/misc/list-page-actions.blade.php ENDPATH**/ ?>