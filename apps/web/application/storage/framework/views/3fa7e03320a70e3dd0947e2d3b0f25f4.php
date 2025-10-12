<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="form-group row">

    <!--text-->
    <?php if($field->customfields_datatype =='text'): ?>
    <label
        class="col-12 text-left control-label col-form-label <?php echo e(runtimeCustomFieldsRequiredCSS($field->customfields_required)); ?>">
        <?php echo e($field->customfields_title); ?><?php echo e(runtimeCustomFieldsRequiredAsterix($field->customfields_required)); ?></label>
    <div class="col-12">
        <input type="text" class="form-control form-control-sm a-custom-field" id="<?php echo e($field->customfields_name); ?>"
            name="<?php echo e($field->customfields_name); ?>" value="<?php echo e($field->current_value ?? ''); ?>">
    </div>
    <?php endif; ?>


    <!--paragraph-->
    <?php if($field->customfields_datatype =='paragraph'): ?>
    <label
        class="col-sm-12 text-left control-label col-form-label <?php echo e(runtimeCustomFieldsRequiredCSS($field->customfields_required)); ?>">
        <?php echo e($field->customfields_title); ?><?php echo e(runtimeCustomFieldsRequiredAsterix($field->customfields_required)); ?></label>
    <div class="col-sm-12">
        <textarea class="form-control form-control-sm tinymce-textarea-plain a-custom-field" rows="5" name="<?php echo e($field->customfields_name); ?>"
            id="<?php echo e($field->customfields_name); ?>"><?php echo e($field->current_value ?? ''); ?></textarea>
    </div>
    <?php endif; ?>

    <!--number & decimal-->
    <?php if($field->customfields_datatype =='number' || $field->customfields_datatype =='decimal'): ?>
    <label
        class="col-12 text-left control-label col-form-label <?php echo e(runtimeCustomFieldsRequiredCSS($field->customfields_required)); ?>">
        <?php echo e($field->customfields_title); ?><?php echo e(runtimeCustomFieldsRequiredAsterix($field->customfields_required)); ?></label>
    <div class="col-12">
        <input type="number" class="form-control form-control-sm a-custom-field" id="<?php echo e($field->customfields_name); ?>"
            name="<?php echo e($field->customfields_name); ?>" value="<?php echo e($field->current_value ?? ''); ?>">
    </div>
    <?php endif; ?>

    <!--date-->
    <?php if($field->customfields_datatype =='date'): ?>
    <label
        class="col-12 text-left control-label col-form-label <?php echo e(runtimeCustomFieldsRequiredCSS($field->customfields_required)); ?>">
        <?php echo e($field->customfields_title); ?><?php echo e(runtimeCustomFieldsRequiredAsterix($field->customfields_required)); ?></label>
    <div class="col-12">
        <input type="text" class="form-control form-control-sm pickadate a-custom-field" name="<?php echo e($field->customfields_name); ?>" value="<?php echo e(runtimeDatepickerDate($field->current_value ?? '')); ?>"
            autocomplete="off">
        <input class="mysql-date" type="hidden" name="<?php echo e($field->customfields_name); ?>"
            id="<?php echo e($field->customfields_name); ?>" value="<?php echo e($field->current_value ?? ''); ?>">
    </div>
    <?php endif; ?>

    <!--dropdown-->
    <?php if($field->customfields_datatype =='dropdown'): ?>
    <label
        class="col-12 text-left control-label col-form-label <?php echo e(runtimeCustomFieldsRequiredCSS($field->customfields_required)); ?>">
        <?php echo e($field->customfields_title); ?><?php echo e(runtimeCustomFieldsRequiredAsterix($field->customfields_required)); ?></label>
    <div class="col-12">
        <select class="select2-basic form-control form-control-sm select2-preselected a-custom-field" id="<?php echo e($field->customfields_name); ?>"
            name="<?php echo e($field->customfields_name); ?>" data-preselected="<?php echo e($field->current_value ?? ''); ?>">
            <option value=""></option>
            <?php echo runtimeCustomFieldsJsonLists($field->customfields_datapayload); ?>

        </select>
    </div>
    <?php endif; ?>


    <!--checkbox-->
    <?php if($field->customfields_datatype =='checkbox'): ?>
    <label
        class="col-12 text-left control-label col-form-label <?php echo e(runtimeCustomFieldsRequiredCSS($field->customfields_required)); ?>">
        <?php echo e($field->customfields_title); ?><?php echo e(runtimeCustomFieldsRequiredAsterix($field->customfields_required)); ?></label>
    <div class="col-12">
        <input type="checkbox" id="<?php echo e($field->customfields_name); ?>" name="<?php echo e($field->customfields_name); ?>" class="filled-in chk-col-light-blue a-custom-field" <?php echo e(runtimePrechecked($field->current_value ?? '')); ?>>
        <label  class="p-l-0" for="<?php echo e($field->customfields_name); ?>"></label>
    </div>
    <?php endif; ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tickets/components/create/customfields.blade.php ENDPATH**/ ?>