<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.first_name'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="first_name" name="first_name"
                    value="<?php echo e($user->first_name ?? ''); ?>">
            </div>
        </div>
        <!--chrome workaround prevent autofill (as of dec 2016)-->
        <div class="fx-fake-login">
            <input type="text" name="fake_username_remembered">
            <input type="password" name="fake_password_remembered">
        </div>
        <!--chrome workaround prevent autofill-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.last_name'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="last_name" name="last_name"
                    value="<?php echo e($user->last_name ?? ''); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.email_address'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="email" name="email"
                    value="<?php echo e($user->email ?? ''); ?>">
            </div>
        </div>

        <!--[edit] phone-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.phone'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="phone" name="phone"
                    value="<?php echo e($user->phone ?? ''); ?>">
            </div>
        </div>
        <!--/#[edit] phone-->

        <!--position-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.job_title'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="position" name="position"
                    value="<?php echo e($user->position ?? ''); ?>">
            </div>
        </div>
        <!--position-->

        <?php if(@request('type') != 'profile'): ?>
        <!--[team][admin] user role-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.role'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="role_id" name="role_id">
                    <option></option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(runtimeTeamCreateAdminPermissions($role->role_id)): ?>
                    <option value="<?php echo e($role->role_id); ?>" <?php echo e(runtimePreselected($role->role_id, $user->role_id ?? '')); ?>>
                        <?php echo e($role->role_name); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <!--[team][admin] user role-->
        <?php endif; ?>

        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
        <!--preferences-->
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <?php echo e(cleanLang(__('lang.preferences'))); ?>

            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="toggle_social_profile" id="toggle_social_preferences"
                            class="js-switch-toggle-hidden-content" data-target="preferences_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="hidden" id="preferences_section">
            <div class="form-group form-group-checkbox row">
                <label class="col-4 col-form-label text-left"><?php echo e(cleanLang(__('lang.email_notifications'))); ?></label>
                <div class="col-8 text-left p-t-5">
                    <input type="checkbox" id="pref_email_notifications" name="pref_email_notifications"
                        class="filled-in chk-col-light-blue"
                        <?php echo e(runtimePrechecked($user->pref_email_notifications ?? '')); ?>>
                    <label for="pref_email_notifications"></label>
                </div>
            </div>
        </div>
        <!--/#preferences-->
        <?php endif; ?>

        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
        <!--social profile-->
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <?php echo e(cleanLang(__('lang.social_profile'))); ?>

            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="toggle_social_profile" id="toggle_social_profile"
                            class="js-switch-toggle-hidden-content" data-target="social_profile_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="hidden" id="social_profile_section">
            <!--twitter-->
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">Twitter</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="social_twitter" name="social_twitter"
                        value="<?php echo e($user->social_twitter ?? ''); ?>" placeholder="https://twitter.com">
                </div>
            </div>
            <!--facebook-->
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">Facebook</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="social_facebook" name="social_facebook"
                        value="<?php echo e($user->social_facebook ?? ''); ?>" placeholder="https://www.facebook.com">
                </div>
            </div>
            <!--linkedin-->
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">LinkedIn</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="social_linkedin" name="social_linkedin"
                        value="<?php echo e($user->social_linkedin ?? ''); ?>" placeholder="https://www.linkedin.com">
                </div>
            </div>
            <!--github-->
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">Github</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="social_github" name="social_github"
                        value="<?php echo e($user->social_github ?? ''); ?>" placeholder="https://github.com">
                </div>
            </div>
            <!--dribble-->
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">Dribble</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="social_dribble" name="social_dribble"
                        value="<?php echo e($user->social_dribble ?? ''); ?>" placeholder="https://dribble.com">
                </div>
            </div>
        </div>
        <!--social profile-->
        <?php endif; ?>

        <!--pass source-->
        <input type="hidden" name="source" value="<?php echo e(request('source')); ?>">

        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>
            </div>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/team/modals/add-edit-inc.blade.php ENDPATH**/ ?>