 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        <?php echo $__env->make('pages.leads.components.misc.list-page-actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    <div class="stats-wrapper " id="tasks-stats-wrapper">
        <?php echo $__env->make('pages.leads.components.misc.list-pages-stats', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <!--stats panel-->

    <!-- page content -->
    <div class="row kanban-wrapper">
        <div class="col-12" id="leads-layout-wrapper">
            <?php if(auth()->user()->pref_view_leads_layout == 'kanban'): ?>
            <?php echo $__env->make('pages.leads.components.kanban.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
            <!--leads table-->
            <?php echo $__env->make('pages.leads.components.table.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!--leads table-->
            <?php endif; ?>

            <!--filter-->
            <?php echo $__env->make('pages.leads.components.misc.filter-leads', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!--filter-->

            <!--table config-->
            <?php echo $__env->make('pages.leads.components.misc.table-config', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!--table config-->

        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
<?php echo $__env->make('pages.lead.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<!--dynamic load lead lead (dynamic_trigger_dom)-->
<?php if(config('visibility.dynamic_load_modal')): ?>
<a href="javascript:void(0)" id="dynamic-lead-content"
    class="show-modal-button reset-card-modal-form js-ajax-ux-request js-ajax-ux-request" data-toggle="modal"
    data-target="#cardModal" data-url="<?php echo e(url('/leads/'.request()->route('lead').'?ref=list')); ?>"
    data-loading-target="main-top-nav-bar"></a>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/leads/wrapper.blade.php ENDPATH**/ ?>