<!DOCTYPE html>
<html lang="en" class="<?php echo e(auth()->user()->type ?? ''); ?> <?php echo e(config('visibility.page_rendering')); ?> <?php echo e(config('active_theme')); ?>">

<!--CRM - mycrm.IO-->
<?php echo $__env->make('layout.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
        <?php echo $__env->make('nav.topnav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php echo $__env->make('nav.leftmenu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
            <?php echo $__env->make('pages.reminders.misc.reminder-panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!--notifications panel-->
            <?php echo $__env->make('nav.notifications-panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            <!--panels-->
            <?php echo $__env->make('nav.reminders-panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </div>
        <?php echo $__env->make('pages.starred.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!--page wrapper-->
    </div>

    <!--common modals-->
    <?php echo $__env->make('modals.actions-modal-wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('modals.common-modal-wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('modals.plain-modal-wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('pages.search.modal.search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('pages.authentication.modal.relogin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--selector - modals-->
    <?php echo $__env->make('modals.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <!--js footer-->
    <?php echo $__env->make('layout.footerjs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--js automations-->
    <?php echo $__env->make('layout.automationjs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--[note: no sanitizing required] for this trusted content, which is added by the admin-->
    <?php echo config('system.settings_theme_body'); ?>

</body>


<!--[PRINTING]-->
<?php if(config('visibility.page_rendering') == 'print-page'): ?>
<script src="public/js/dynamic/print.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<?php endif; ?>

</html><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/layout/wrapper.blade.php ENDPATH**/ ?>