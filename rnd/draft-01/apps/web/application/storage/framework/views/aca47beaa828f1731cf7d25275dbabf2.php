
<?php $__env->startSection('settings-page'); ?>

<!--settings-->
<div class="form">

    <!--system information table-->
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <!--crm version-->
                <tr>
                    <td class="w-40"><?php echo app('translator')->get('lang.crm_version'); ?></td>
                    <td><?php echo e(config('system.settings_version') ?? ''); ?></td>
                </tr>

                <!--database name-->
                <tr>
                    <td><?php echo app('translator')->get('lang.database_name'); ?></td>
                    <td><?php echo e(env('DB_DATABASE')); ?></td>
                </tr>

                <!--email system-->
                <tr>
                    <td><?php echo app('translator')->get('lang.email_system'); ?></td>
                    <td>
                        <?php if(config('system.settings_email_server_type') == 'smtp'): ?>
                        <?php echo app('translator')->get('lang.smtp'); ?>
                        <?php else: ?>
                        <?php echo app('translator')->get('lang.sendmail'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <!--last cronjob run-->
                <tr>
                    <td><?php echo app('translator')->get('lang.last_cronjob_run'); ?></td>
                    <td>
                        <?php if(config('system.settings_cronjob_last_run')): ?>
                        <?php echo e(runtimeDate(config('system.settings_cronjob_last_run'))); ?>

                        <?php else: ?>
                        <?php echo app('translator')->get('lang.never'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <!--php version-->
                <tr>
                    <td><?php echo app('translator')->get('lang.php_version'); ?></td>
                    <td><?php echo e($php_version); ?></td>
                </tr>

                <!--memory limit-->
                <tr>
                    <td><?php echo app('translator')->get('lang.server_memory_limit'); ?></td>
                    <td><?php echo e($memory_limit); ?></td>
                </tr>

                <!--file upload limit-->
                <tr>
                    <td><?php echo app('translator')->get('lang.server_file_upload_limit'); ?></td>
                    <td><?php echo e($upload_max_filesize); ?></td>
                </tr>

                <!--files count-->
                <tr>
                    <td><?php echo app('translator')->get('lang.crm_files_count'); ?></td>
                    <td><?php echo e($files_count); ?></td>
                </tr>


                <!--disc usage-->
                <tr id="crm-hard-disk-usage" data-url="<?php echo e(url('/settings/system/disc-usage')); ?>">
                    <td><?php echo app('translator')->get('lang.crm_hard_drive_usage'); ?></td>
                    <td>
                        <div id="system-info-disc-usage-loading">
                            <div class="loading-placeholder-container">
                                <?php echo app('translator')->get('lang.calculating'); ?> <span class="loading-placeholder"></span>
                            </div>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="modal-selector hidden m-t-30 m-l-0 m-r-0" id="system-info-disc-usage">

    <table class="table table-sm m-b-0">
        <tr>
            <td class="p-l-0"><?php echo app('translator')->get('lang.temp_folder'); ?>:</td>
            <td class="text-right font-weight-500" id="system-info-disc-usage-temp">0</td>
        </tr>
        <tr>
            <td class="p-l-0"><?php echo app('translator')->get('lang.logs_folder'); ?>:</td>
            <td class="text-right font-weight-500" id="system-info-disc-usage-logs">0</td>
        </tr>
        <tr>
            <td class="p-l-0"><?php echo app('translator')->get('lang.cache_folder'); ?>:</td>
            <td class="text-right font-weight-500" id="system-info-disc-usage-cache">0</td>
        </tr>
        <tr class="b-t">
            <td class="p-l-0 font-weight-600"><?php echo app('translator')->get('lang.total'); ?>:</td>
            <td class="text-right font-weight-600" id="system-info-disc-usage-total">0</td>
        </tr>
    </table>

    <div class="alert alert-info"><h5 class="text-info"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.info'); ?></h5><?php echo app('translator')->get('lang.cleanup_info'); ?></div>

    <!--cleanup button-->
    <div class="m-t-20 text-right m-b-30">
        <button type="button" class="btn btn-sm btn-danger waves-effect text-left ajax-request"
            data-url="<?php echo e(url('/settings/system/cleanup')); ?>" data-type="form" data-form-id="cleanup-form"
            data-ajax-type="POST" data-loading-target="cleanup-form">
            <?php echo app('translator')->get('lang.free_up_space'); ?>
        </button>
    </div>
</div>

<!--load disc usage on page load-->
<script>
    $(document).ready(function () {
        //load disc usage via ajax
        nxAjaxUxRequest($("#crm-hard-disk-usage"));

        //toggle cleanup options
        $("#cleanup-toggle-button").click(function () {
            $("#cleanup-options").toggleClass("hidden");
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/system/system-info.blade.php ENDPATH**/ ?>