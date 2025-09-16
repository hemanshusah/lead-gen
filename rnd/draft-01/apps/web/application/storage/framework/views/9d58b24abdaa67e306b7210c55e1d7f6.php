<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($field->customfields_show_filter_panel == 'yes'): ?>
<div class="filter-block">


    <div class="title">
        <?php echo e($field->customfields_title); ?>

    </div>

    <!--text-->
    <?php if($field->customfields_datatype =='text' || $field->customfields_datatype =='paragraph'): ?>
    <div class="fields">
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control form-control-sm"
                    id="filter_<?php echo e($field->customfields_name); ?>" name="filter_<?php echo e($field->customfields_name); ?>">
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!--number-->
    <?php if($field->customfields_datatype =='number' || $field->customfields_datatype =='decimal'): ?>
    <div class="fields">
        <div class="row">
            <div class="col-md-12">
                <input type="number" class="form-control form-control-sm"
                    id="filter_<?php echo e($field->customfields_name); ?>" name="filter_<?php echo e($field->customfields_name); ?>">
            </div>
        </div>
    </div>
    <?php endif; ?>


    <!--date-->
    <?php if($field->customfields_datatype =='date'): ?>
    <div class="fields">
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control form-control-sm pickadate"
                    name="filter_<?php echo e($field->customfields_name); ?>" autocomplete="off">
                <input class="mysql-date" type="hidden" name="filter_<?php echo e($field->customfields_name); ?>"
                    id="filter_<?php echo e($field->customfields_name); ?>">
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!--dropdown-->
    <?php if($field->customfields_datatype =='dropdown'): ?>
    <div class="fields">
        <div class="row">
            <div class="col-md-12">
                <select class="select2-basic-with-search form-control form-control-sm" data-allow-clear="true"
                    id="filter_<?php echo e($field->customfields_name); ?>" name="filter_<?php echo e($field->customfields_name); ?>">
                    <option value=""></option>
                    <?php echo runtimeCustomFieldsJsonLists($field->customfields_datapayload); ?>

                </select>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <!--checkbox-->
    <?php if($field->customfields_datatype =='checkbox'): ?>

    <div class="fields">
        <div class="row">
            <div class="col-md-12">
                <input type="checkbox" id="filter_<?php echo e($field->customfields_name); ?>" name="filter_<?php echo e($field->customfields_name); ?>"
                    class="filled-in chk-col-light-blue">
                <label class="p-l-0" for="filter_<?php echo e($field->customfields_name); ?>"></label>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/misc/customfields-filters.blade.php ENDPATH**/ ?>