<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">

        <!--SEARCH BOX-->
        <?php if( config('visibility.list_page_actions_search')): ?>
        <div class="header-search" id="header-search">
            <i class="sl-icon-magnifier"></i>
            <input type="text" class="form-control search-records list-actions-search"
                data-url="<?php echo e(_url('templates/projects/search?action=search')); ?>" data-type="form" data-ajax-type="post"
                data-form-id="header-search" id="search_query" name="search_query"
                placeholder="<?php echo e(cleanLang(__('lang.search'))); ?>">
        </div>
        <?php endif; ?>


        <!--ADD NEW ITEM-->
        <?php if(config('visibility.list_page_actions_add_button')): ?>
        <button type="button"
            class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" 
            data-target="#commonModal" 
            data-url="<?php echo e(_url('templates/projects/create')); ?>"
            data-loading-target="commonModalBody" 
            data-modal-title="<?php echo app('translator')->get('lang.create_a_project_template'); ?>"
            data-action-url="<?php echo e(url('templates/projects')); ?>"
            data-action-method="POST"
            data-action-ajax-loading-target="commonModalBody">
            <i class="ti-plus"></i>
        </button>
        <?php endif; ?>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/templates/projects/components/misc/list-page-actions.blade.php ENDPATH**/ ?>