<?php if($reminders->count() > 0): ?>
<?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each reminder-->
<div class="topnav-reminder clearfix" id="topnav_reminder_<?php echo e($reminder->reminder_id); ?>">
    <div class="x-icon">
        <?php if($reminder->reminderresource_type == 'client'): ?>
        <i class="sl-icon-people"></i>
        <?php endif; ?>
        <?php if($reminder->reminderresource_type == 'project'): ?>
        <i class="ti-folder"></i>
        <?php endif; ?>
        <?php if($reminder->reminderresource_type == 'invoice'): ?>
        <i class="ti-wallet"></i>
        <?php endif; ?>
        <?php if($reminder->reminderresource_type == 'estimate'): ?>
        <i class="ti-wallet"></i>
        <?php endif; ?>
        <?php if($reminder->reminderresource_type == 'task'): ?>
        <i class="ti-menu-alt"></i>
        <?php endif; ?>
        <?php if($reminder->reminderresource_type == 'lead'): ?>
        <i class="sl-icon-call-in"></i>
        <?php endif; ?>
        <?php if($reminder->reminderresource_type == 'ticket'): ?>
        <i class="ti-comments"></i>
        <?php endif; ?>
    </div>
    <div class="x-content">
        <div class="x-date-time clearfix">
            <div class="x-time reminders-panel-time"><?php echo e(runtimeTime($reminder->reminder_datetime)); ?></div>
            <div class="x-date reminders-panel-date"><span><?php echo e(runtimeDate($reminder->reminder_datetime)); ?></span>
                <span class="js-reminder-mark-read-single"
                    data-container="topnav_reminder_<?php echo e($reminder->reminder_id); ?>" data-progress-bar='hidden'
                    data-url="<?php echo e(url('reminders/'.$reminder->reminder_id.'/delete-reminder')); ?>">
                    <input class="radio-col-info" name="group4" type="radio"
                        id="reminder_checkbox_<?php echo e($reminder->reminder_id); ?>">
                    <label for="reminder_checkbox_<?php echo e($reminder->reminder_id); ?>"></label></span>
            </div>
        </div>
        <div class="x-title">
            <?php echo e($reminder->reminder_title); ?>

        </div>
        <div class="x-link">
            <?php if($reminder->reminderresource_type == 'client'): ?>
            <a
                href="<?php echo e(url('clients/'.$reminder->reminderresource_id)); ?>"><?php echo e(str_limit($reminder->reminder_meta ?? __('lang.client'), 33)); ?></a>
            <?php endif; ?>
            <?php if($reminder->reminderresource_type == 'project'): ?>
            <a
                href="<?php echo e(url('projects/'.$reminder->reminderresource_id)); ?>"><?php echo e(str_limit($reminder->reminder_meta ?? __('lang.project'), 33)); ?></a>
            <?php endif; ?>
            <?php if($reminder->reminderresource_type == 'invoice'): ?>
            <a
                href="<?php echo e(url('invoices/'.$reminder->reminderresource_id)); ?>"><?php echo e(str_limit($reminder->reminder_meta ?? __('lang.invoice'), 33)); ?></a>
            <?php endif; ?>
            <?php if($reminder->reminderresource_type == 'estimate'): ?>
            <a
                href="<?php echo e(url('estmates/'.$reminder->reminderresource_id)); ?>"><?php echo e(str_limit($reminder->reminder_meta ?? __('lang.estimate'), 33)); ?></a>
            <?php endif; ?>
            <?php if($reminder->reminderresource_type == 'task'): ?>
            <a
                href="<?php echo e(url('tasks/v/'.$reminder->reminderresource_id.'/view')); ?>"><?php echo e(str_limit($reminder->reminder_meta ?? __('lang.task'), 33)); ?></a>
            <?php endif; ?>
            <?php if($reminder->reminderresource_type == 'lead'): ?>
            <a
                href="<?php echo e(url('leads/v/'.$reminder->reminderresource_id.'/view')); ?>"><?php echo e(str_limit($reminder->reminder_meta ?? __('lang.lead'), 33)); ?></a>
            <?php endif; ?>
            <?php if($reminder->reminderresource_type == 'ticket'): ?>
            <a
                href="<?php echo e(url('tickets/'.$reminder->reminderresource_id)); ?>"><?php echo e(str_limit($reminder->reminder_meta ?? __('lang.ticket'), 33)); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<!--no reminders found-->
<?php if($reminders->count() == 0): ?>
<div class="reminders-none-existing" id="reminders-none-existing">
    <div class="x-image m-t-50 text-center p-t-30">
        <img class="w-px-250" src="<?php echo e(url('/public/images/reminders_none.svg')); ?>" alt="404 - Not found" />
    </div>
    <div class="x-text m-t-30 text-center">
        <h4><?php echo app('translator')->get('lang.no_reminders_found'); ?></h4>
    </div>
</div>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/reminders/topnav/reminder.blade.php ENDPATH**/ ?>