<div class="card-description" id="card-description">
    <div class="x-heading"><i class="mdi mdi-file-document-box"></i><?php echo e(cleanLang(__('lang.description'))); ?></div>
    <div class="x-content rich-text-formatting" id="card-description-container">
        <?php echo clean($lead->lead_description); ?>

    </div>
    <?php if($lead->permission_edit_lead): ?>
    <!--buttons: edit-->
    <div id="card-description-edit" class="p-t-20">
        <div class="x-action" id="card-description-button-edit"><a href="javaScript:void(0);"><?php echo e(cleanLang(__('lang.edit_description'))); ?></a>
        </div>
        <input type="hidden" name="lead_description" id="card-description-input" value="">
    </div>
    <!--button: subit & cancel-->
    <div id="card-description-submit" class="p-t-10 hidden text-right">
        <button type="button" class="btn waves-effect waves-light btn-xs btn-default"
            id="card-description-button-cancel"><?php echo e(cleanLang(__('lang.cancel'))); ?></button>
        <button type="button" class="btn waves-effect waves-light btn-xs btn-danger js-description-save"
            data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-description')); ?>" data-progress-bar='hidden'
            data-type="form" data-form-id="card-description" data-ajax-type="post"
            id="card-description-button-save"><?php echo e(cleanLang(__('lang.save'))); ?></button>
    </div>
    <?php endif; ?>
</div>

<!--section js resource-->
<?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/components/description.blade.php ENDPATH**/ ?>