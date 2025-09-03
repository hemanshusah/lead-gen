 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        <?php echo $__env->make('pages.payments.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    <?php if(auth()->user()->is_team): ?>
    <div class="stats-wrapper" id="payments-stats-wrapper">
    <?php echo $__env->make('misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php endif; ?>
    <!--stats panel-->

    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--payments table-->
            <?php echo $__env->make('pages.payments.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--payments table-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
<!--dynamic load payment payment (dynamic_trigger_dom)-->
<?php if(config('visibility.dynamic_load_modal')): ?>
<a href="javascript:void(0)" id="dynamic-payment-content"
    class="show-modal-button edit-add-modal-button js-ajax-ux-request reset-target-modal-form" data-toggle="modal" data-modal-title="<?php echo e(cleanLang(__('lang.payment'))); ?>"
    data-target="#plainModal" data-url="<?php echo e(url('/payments/'.request()->route('payment').'?ref=list')); ?>"
    data-loading-target="plainModalBody"></a>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/payments/wrapper.blade.php ENDPATH**/ ?>