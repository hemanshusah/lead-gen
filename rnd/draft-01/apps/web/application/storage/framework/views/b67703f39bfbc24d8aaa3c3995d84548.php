 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        <?php echo $__env->make('pages.leads.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    <div class="stats-wrapper " id="tasks-stats-wrapper">
        <?php echo $__env->make('pages.leads.components.misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!--stats panel-->

    <!-- page content -->
    <div class="row kanban-wrapper">
        <div class="col-12" id="leads-layout-wrapper">
            <?php if(auth()->user()->pref_view_leads_layout == 'kanban'): ?>
            <?php echo $__env->make('pages.leads.components.kanban.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
            <!--leads table-->
            <?php echo $__env->make('pages.leads.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--leads table-->
            <?php endif; ?>

            <!--filter-->
            <?php echo $__env->make('pages.leads.components.misc.filter-leads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--filter-->

            <!--table config-->
            <?php echo $__env->make('pages.leads.components.misc.table-config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--table config-->

        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
<?php echo $__env->make('pages.lead.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!--dynamic load lead lead (dynamic_trigger_dom)-->
<?php if(config('visibility.dynamic_load_modal')): ?>
<a href="javascript:void(0)" id="dynamic-lead-content"
    class="show-modal-button reset-card-modal-form js-ajax-ux-request js-ajax-ux-request" data-toggle="modal"
    data-target="#cardModal" data-url="<?php echo e(url('/leads/'.request()->route('lead').'?ref=list')); ?>"
    data-loading-target="main-top-nav-bar"></a>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/leads/wrapper.blade.php ENDPATH**/ ?>