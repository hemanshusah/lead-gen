<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('nav.leftmenu-team', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<?php if(auth()->user()->is_client): ?>
<?php echo $__env->make('nav.leftmenu-client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<!--[AFFILIATE]-->
<?php if(config('settings.custom_modules.cs_affiliate') && auth()->user()->type == 'cs_affiliate'): ?>
<?php echo $__env->make('pages.cs_affiliates.home.widgets.leftmenu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>
<?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/nav/leftmenu.blade.php ENDPATH**/ ?>