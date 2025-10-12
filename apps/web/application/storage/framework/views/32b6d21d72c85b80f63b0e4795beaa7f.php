<!--heading-->
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i><?php echo app('translator')->get('lang.lead_logs'); ?></div>

<!--[create new log]-->
<div class="post-comment" id="post-card-comment-form">
    <!--placeholder textbox-->
    <div class="x-message-field x-message-field-placeholder m-b-10" id="card-coment-placeholder-input-container"
        data-show-element-container="card-comment-tinmyce-container">
        <textarea class="form-control form-control-sm w-100" rows="1"
            id="card-coment-placeholder-input"><?php echo app('translator')->get('lang.record_a_log'); ?>...</textarea>
    </div>
    <!--rich text editor-->
    <div class="x-message-field hidden" id="card-comment-tinmyce-container">
        <!--tinymce editor-->
        <textarea class="form-control form-control-sm w-99 tinymce-textarea" rows="2" id="card-comment-tinmyce" name="lead_log_text"></textarea>

        <!--Log Type-->
        <div class="form-group row m-t-10">
            <label class="col-sm-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.log_type'); ?>*</label>
            <div class="col-sm-12">
                <select class="select2-basic form-control form-control-sm" id="lead_log_type" name="lead_log_type">
                    <option value="general"><?php echo app('translator')->get('lang.general'); ?></option>
                    <option value="call"><?php echo app('translator')->get('lang.call'); ?></option>
                    <option value="meeting"><?php echo app('translator')->get('lang.meeting'); ?></option>
                    <option value="email"><?php echo app('translator')->get('lang.email'); ?></option>
                </select>
            </div>
        </div>

        <!--close button-->
        <div class="x-button p-t-10 p-b-10 text-right">
            <button type="button" class="btn btn-default btn-sm" id="card-comment-close-button">
                <?php echo app('translator')->get('lang.close'); ?>
            </button>
            <!--submit button-->
            <button type="button" class="btn btn-danger btn-sm x-submit-button ajax-request"
                data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/store-log')); ?>" data-type="form" data-ajax-type="post"
                data-form-id="post-card-comment-form" data-loading-target="card-coment-placeholder-input-container">
                <?php echo app('translator')->get('lang.post'); ?>
            </button>
        </div>
    </div>
</div>

<!--List of log entries-->
<div class="card-show-form-data" id="lead-logs-container">
    <?php if(count($logs ?? []) > 0): ?>
        <?php echo $__env->make('pages.lead.content.logs.log', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
    <div class="x-no-result">
        <img src="<?php echo e(url('/')); ?>/public/images/no-download-avialble.png" alt="404 - Not found" />
        <div class="p-t-20">
            <h4><?php echo app('translator')->get('lang.you_do_not_have_logs'); ?></h4>
        </div>
    </div>
    <?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/content/logs/show.blade.php ENDPATH**/ ?>