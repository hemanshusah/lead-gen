<!--heading-->
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i><?php echo e(cleanLang(__('lang.custom_fields'))); ?></div>



<!--Form Data-->
<div class="card-show-form-data" id="card-lead-organisation">
<?php if(count($fields ?? []) > 0): ?> 
<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="form-data-row">

        <span class="x-data-title"><?php echo e($field->customfields_title); ?>:</span>
        <span class="x-data-content <?php echo e($field->customfields_datatype); ?>"><?php echo customFieldValueDisplay($field->customfields_name, $lead, $field->customfields_datatype); ?></span>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(config('app.application_demo_mode')): ?>
<!--DEMO INFO-->
<div class="alert alert-info">
    <h5 class="text-info"><i class="sl-icon-info"></i> Demo Info</h5>  
    These are custom fields. You can change them or <a href="<?php echo e(url('app/settings/customfields/projects')); ?>">create your own.</a>
</div>
<?php endif; ?>


<!--edit button-->
<?php if(config('visibility.lead_editing_buttons')): ?>
<div class="form-data-row-buttons">
    <button type="button" class="btn waves-effect waves-light btn-xs btn-info ajax-request"
        data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/edit-customfields')); ?>"
        data-loading-class="loading-before-centre"
        data-loading-target="card-leads-left-panel"><?php echo app('translator')->get('lang.edit'); ?></button>
</div>
<?php endif; ?>

<?php else: ?>

<div class="x-no-result">
    <img src="<?php echo e(url('/')); ?>/public/images/no-download-avialble.png" alt="404 - Not found" /> 
    <div class="p-t-20"><h4><?php echo e(cleanLang(__('lang.you_do_not_have_custom_fields'))); ?></h4></div>
    <?php if(auth()->user()->is_admin): ?>
    <div class="p-t-10">
        <a href="<?php echo e(url('app/settings/customfields/leads')); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->get('lang.create_custom_fields'); ?></a>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/content/customfields/show.blade.php ENDPATH**/ ?>