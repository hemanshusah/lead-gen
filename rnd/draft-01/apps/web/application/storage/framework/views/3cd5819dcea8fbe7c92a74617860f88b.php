<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">
        <!--SEARCH BOX-->
        <div class="header-search" id="header-search">
            <i class="sl-icon-magnifier"></i>
            <input type="text" class="form-control search-records list-actions-search"
                data-url="<?php echo e($page['dynamic_search_url'] ?? ''); ?>" data-type="form" data-ajax-type="post"
                data-form-id="header-search" id="search_query" name="search_query"
                placeholder="<?php echo e(cleanLang(__('lang.search'))); ?>">
        </div>

        <!--SHOW ARCHIVED LEADS-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.show_archive_leads'))); ?>"
            id="pref_filter_show_archived_leads"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-ajax-ux-request <?php echo e(runtimeActive(auth()->user()->pref_filter_show_archived_leads)); ?>"
            data-url="<?php echo e(url('/leads/search?action=search&toggle=pref_filter_show_archived_leads')); ?>">
            <i class="ti-archive"></i>
        </button>

        <!--SHOW OWN LEADS-->
        <?php if( config('visibility.own_leads_toggle_button')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.my_leads'))); ?>"
            id="pref_filter_own_leads"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-ajax-ux-request <?php echo e(runtimeActive(auth()->user()->pref_filter_own_leads)); ?>"
            data-url="<?php echo e(url('/leads/search?action=search&toggle=pref_filter_own_leads')); ?>">
            <i class="sl-icon-user"></i>
        </button>
        <?php endif; ?>

        <!--TOGGLE STATS-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.quick_stats'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-stats-widget update-user-ux-preferences"
            data-type="statspanel" data-progress-bar="hidden" data-url-temp="<?php echo e(url('/team/updatepreferences')); ?>"
            data-url="" data-target="list-pages-stats-widget">
            <i class="ti-stats-up"></i>
        </button>

        <!--LEADS - KANBAN VIEW & SORTING-->
        <!--leads kanban toggle-->
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.kanban_view'))); ?>"
            id="pref_view_leads_layout"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-ajax-ux-request <?php echo e(runtimeActive(auth()->user()->pref_view_leads_layout)); ?>"
            data-url="<?php echo e(urlResource('/leads/search?action=search&toggle=layout')); ?>">
            <i class="sl-icon-list"></i>
        </button>
        <!--leads kanban task sorting-->
        <div class="btn-group" id="list_actions_sort_kanban">
            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="list-actions-button btn waves-effect waves-dark dropdown-toggle">
                <i class="mdi mdi-sort"></i></button>
            <div class="dropdown-menu dropdown-menu-right fx-kaban-sorting-dropdown">
                <div class="fx-kaban-sorting-dropdown-container"><?php echo e(cleanLang(__('lang.sort_by'))); ?></div>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_lead_created" href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_created&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date_created'))); ?></a>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_lead_firstname" href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_firstname&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.name'))); ?></a>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_lead_value" href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_value&sortorder=desc')); ?>"><?php echo e(cleanLang(__('lang.value'))); ?></a>
                <a class="dropdown-item js-ajax-ux-request" id="sort_kanban_lead_last_contacted"
                    href="javascript:void(0)"
                    data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_last_contacted&sortorder=desc')); ?>"><?php echo e(cleanLang(__('lang.date_last_contacted'))); ?></a>
            </div>
        </div>

        <!--IMPORTING-->
        <?php if(config('visibility.list_page_actions_importing')): ?>
        <button type="button" title="<?php echo e(cleanLang(__('lang.import_leads'))); ?>" id="leads-import-button"
            class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal" data-footer-visibility="hidden" data-top-padding="none"
            data-action-url="<?php echo e(url('import/leads')); ?>" data-action-method="POST" data-loading-target="commonModalBody"
            data-action-ajax-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.import_leads'); ?>"
            data-url="<?php echo e(url('import/leads/create')); ?>">
            <i class="ti-import"></i>
        </button>
        <?php endif; ?>

        <!--EXPORT-->
        <?php if(config('visibility.list_page_actions_exporting')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.export_leads'); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="sidepanel-export-leads">
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
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/leads/components/misc/list-page-actions.blade.php ENDPATH**/ ?>