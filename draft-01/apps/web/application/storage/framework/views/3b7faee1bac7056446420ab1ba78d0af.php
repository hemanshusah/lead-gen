<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">

        <!--ADD NEW ITEM-->
        <?php if(config('visibility.list_page_actions_add_button')): ?>
        <button type="button"
            class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" 
            data-target="#commonModal"
            data-url="<?php echo e(url('templates/proposals/create?proposalresource_id=' . request('proposalresource_id') . '&proposalresource_type=' . request('proposalresource_type'))); ?>"
            data-loading-target="commonModalBody" 
            data-modal-title="<?php echo app('translator')->get('lang.create_proposal_template'); ?>"
            data-action-url="<?php echo e(url('templates/proposals?proposalresource_id=' . request('proposalresource_id') . '&proposalresource_type=' . request('proposalresource_type'))); ?>"
            data-action-method="POST" 
            data-modal-size="modal-xxl" 
            data-action-ajax-loading-target="commonModalBody">
            <i class="ti-plus"></i>
        </button>
        <?php endif; ?>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/templates/proposals/components/misc/list-page-actions.blade.php ENDPATH**/ ?>