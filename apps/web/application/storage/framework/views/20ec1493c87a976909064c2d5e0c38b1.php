<!DOCTYPE html>
<html lang="en" class="<?php echo e(auth()->user()->type ?? ''); ?> <?php echo e(config('visibility.page_rendering')); ?> <?php echo e(config('active_theme')); ?>">

<!--CRM - mycrm.IO-->
<?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body id="main-body"
    class="loggedin fix-header card-no-border fix-sidebar <?php echo e(config('settings.css_kanban')); ?> <?php echo e(runtimePreferenceLeftmenuPosition(auth()->user()->left_menu_position)); ?> <?php echo e($page['page'] ?? ''); ?>">

    <!--main wrapper-->
    <div id="main-wrapper">


        <!---------------------------------------------------------------------------------------
            [NEXTLOOP}
             always collapse left menu for small devices
            (NB: this code is in the correct place. It must run before menu is added to DOM)
         --------------------------------------------------------------------------------------->

        <!--top nav-->
        <?php echo $__env->make('nav.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make('nav.leftmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--top nav-->


        <!--page wrapper-->
        <div class="page-wrapper">

            <!--overlay-->
            <div class="page-wrapper-overlay js-close-side-panels hidden" data-target=""></div>
            <!--overlay-->

            <!--preloader-->
            <?php if(config('visibility.page_rendering') == '' || config('visibility.page_rendering') != 'print-page'): ?>
            <div class="preloader">
                <div class="loader">
                    <div class="loader-loading"></div>
                </div>
            </div>
            <?php endif; ?>
            <!--preloader-->


            <!-- main content -->
            <?php echo $__env->yieldContent('content'); ?>
            <!-- /#main content -->


            <!--reminders panel-->
            <?php echo $__env->make('pages.reminders.misc.reminder-panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!--notifications panel-->
            <?php echo $__env->make('nav.notifications-panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <!--panels-->
            <?php echo $__env->make('nav.reminders-panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
        <?php echo $__env->make('pages.starred.panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--page wrapper-->
    </div>

    <!--common modals-->
    <?php echo $__env->make('modals.actions-modal-wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.common-modal-wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.plain-modal-wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('pages.search.modal.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('pages.authentication.modal.relogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--selector - modals-->
    <?php echo $__env->make('modals.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!--js footer-->
    <?php echo $__env->make('layout.footerjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--js automations-->
    <?php echo $__env->make('layout.automationjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--[note: no sanitizing required] for this trusted content, which is added by the admin-->
    <?php echo config('system.settings_theme_body'); ?>

</body>


<!--[PRINTING]-->
<?php if(config('visibility.page_rendering') == 'print-page'): ?>
<script src="public/js/dynamic/print.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<?php endif; ?>

</html><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/layout/wrapper.blade.php ENDPATH**/ ?>