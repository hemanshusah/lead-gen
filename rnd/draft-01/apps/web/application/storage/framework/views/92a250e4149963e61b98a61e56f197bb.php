 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        <?php echo $__env->make('pages.tasks.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    <?php if(auth()->user()->is_team): ?>
    <div class="stats-wrapper " id="tasks-stats-wrapper">
        <?php echo $__env->make('pages.tasks.components.misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php endif; ?>
    <!--stats panel-->


    <!-- page content -->
    <div class="row kanban-wrapper">
        <div class="col-12" id="tasks-layout-wrapper">
            <?php if(auth()->user()->pref_view_tasks_layout == 'kanban'): ?>
            <?php echo $__env->make('pages.tasks.components.kanban.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
            <!--tasks table-->
            <?php echo $__env->make('pages.tasks.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--tasks table-->
            <?php endif; ?>
            <!--filter-->
            <?php if(auth()->user()->is_team): ?>
            <?php echo $__env->make('pages.tasks.components.misc.filter-tasks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <!--filter-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->

<!--task modal-->
<?php echo $__env->make('pages.task.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--dynamic load task task (dynamic_trigger_dom)-->
<?php if(config('visibility.dynamic_load_modal')): ?>
<a href="javascript:void(0)" id="dynamic-task-content"
    class="show-modal-button reset-card-modal-form js-ajax-ux-request js-ajax-ux-request" data-toggle="modal"
    data-target="#cardModal" data-url="<?php echo e(url('/tasks/'.request()->route('task').'?ref=list')); ?>"
    data-loading-target="main-top-nav-bar"></a>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tasks/wrapper.blade.php ENDPATH**/ ?>