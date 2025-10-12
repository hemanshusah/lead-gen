
<!--SECOND STEP FORM-->
<?php $__env->startSection('second-step-form'); ?>
<div class="form-group row">
    <label class="col-sm-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.status'))); ?>*</label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="lead_status" name="lead_status">
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($status->leadstatus_id); ?>"
                <?php echo e(runtimePreselected($lead->lead_status ?? '', $status->leadstatus_id)); ?>><?php echo e(runtimeLang($status->leadstatus_title)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<!--assigned [roles]-->
<?php if(config('visibility.lead_modal_assign_fields')): ?>
<div class="form-group row">
    <label
        class="col-sm-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.assigned'))); ?>*</label>
    <div class="col-sm-12">
        <select name="assigned" id="assigned"
            class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
            multiple="multiple" tabindex="-1" aria-hidden="true">
            <!--users list-->
            <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>" <?php echo e(runtimePreselectedInArray($user->id ?? '', $assigned ?? [])); ?>><?php echo e($user->full_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--/#users list-->
        </select>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.import.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/import/leads/import.blade.php ENDPATH**/ ?>