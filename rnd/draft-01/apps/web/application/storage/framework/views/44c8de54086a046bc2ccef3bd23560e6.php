<!--PASSED SYSTEM REQUIREMENTS-->
<?php if($server_status == 'passed'): ?>
<div class="importing-modal" id="importing-modal-container">


    <!--FIRST STEP-->
    <?php echo $__env->make('pages.import.common.first-step', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!--SECOND STEP-->
    <div class="hidden" id="importing-step-2">


        <div class="import-payload-preview hidden p-r-30" id="import-payload-preview-csv">
            <a><img src="<?php echo e(url('public/images/file-icons/icon-csv.svg')); ?>" alt="CSV FILE" />
            </a>
        </div>

        <div class="import-payload-preview hidden p-r-30" id="import-payload-preview-xls">
            <a><img src="<?php echo e(url('public/images/file-icons/icon-xls.svg')); ?>" alt="XLS FILE" />
            </a>
        </div>

        <div class="import-payload-preview hidden p-r-30" id="import-payload-preview-xlsx">
            <a><img src="<?php echo e(url('public/images/file-icons/icon-xlsx.svg')); ?>" alt="CSV FILE" />
            </a>
        </div>

        <div class="import-payload-preview-text hidden" id="import-payload-preview-text">
            <div class="x-title" id="import-payload-preview-filename">
                <!--dynamic file name-->
            </div>
            <div class="x-meta" id="import-payload-preview-meta">
                <!--dynamic file size-->
            </div>
        </div>

        <!-- main content -->
        <?php echo $__env->yieldContent('second-step-form'); ?>
        <!-- /#main content -->


        <!--payload-->
        <input type="hidden" name="importing-file-name" id="importing-file-name">
        <input type="hidden" name="importing-file-uniqueid" id="importing-file-uniqueid">
    </div>
</div>
<?php endif; ?>


<?php if($server_status == 'failed'): ?>
<?php echo $__env->make('pages.import.common.requirements', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/import/wrapper.blade.php ENDPATH**/ ?>