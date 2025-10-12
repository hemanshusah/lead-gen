<div class="splash-image" id="updatePasswordSplash">
    <img src="<?php echo e(url('/')); ?>/public/images/authentication-update-password.png" alt="404 - Not found" />
</div>
<div class="splash-text">
    <?php echo e(cleanLang(__('lang.change_your_password'))); ?>

</div>

<div class="form-group row">
    <div class="col-sm-12">
        <input type="password" class="form-control" id="password" name="password"
            placeholder="<?php echo e(cleanLang(__('lang.password'))); ?>">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
            placeholder="<?php echo e(cleanLang(__('lang.confirm_password'))); ?>">
    </div>
</div>

<!--if editing contact password-->
<?php if(auth()->user()->is_team): ?>
<input type="hidden" class="form-control" id="contact_id" name="contact_id"
value="<?php echo e(request('contact_id')); ?>">
<?php endif; ?>

<!--if editing team password-->
<?php if(is_numeric(request('team_id'))): ?>
<input type="hidden" class="form-control" id="team_id" name="team_id"
value="<?php echo e(request('team_id')); ?>">
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/user/modals/update-password.blade.php ENDPATH**/ ?>