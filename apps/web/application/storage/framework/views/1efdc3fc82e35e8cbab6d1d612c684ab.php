<!--FIRST STEP-->
<div id="importing-step-1">

    <!--splash images-->
    <div class="x-splash-images">
        <span class="x-icons">
            <img src="<?php echo e(url('public/images/file-icons/icon-csv.svg')); ?>" alt="CSV FILE" />
        </span>
        <span class="x-icons">
            <img src="<?php echo e(url('public/images/file-icons/icon-xlsx.svg')); ?>" alt="XLSX FILE" />
        </span>
    </div>


    <!--fileupload-->
    <div class="form-group row">
        <div class="col-12">
            <div class="dropzone dz-clickable text-center file-upload-box import-files-upload">
                <div class="dz-default dz-message">
                    <div>
                        <h4><?php echo e(cleanLang(__('lang.drag_drop_single_file'))); ?></h4>
                    </div>
                    <div>
                        <h6>(CVS or XLSX)</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--samples-->
    <div class="p-t-10 p-b-30 text-align-center">
        <?php echo $__env->make('pages.import.common.samples', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/import/common/first-step.blade.php ENDPATH**/ ?>