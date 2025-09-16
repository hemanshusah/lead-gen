<!--convert lead buttons-->
<button type="button"
    class="btn btn-rounded-x btn-secondary waves-effect text-left js-lead-convert-to-customer-close"><?php echo e(cleanLang(__('lang.close'))); ?></button>
<button type="submit" id="createCustomerButton" class="btn btn-rounded-x btn-danger waves-effect text-left"
    data-url="<?php echo e(url('leads/'.$lead->lead_id.'/convert-lead')); ?>" data-loading-target="actionsModalBody"
    data-ajax-type="post" data-type="form" data-form-id="convertLeadForm"><?php echo e(cleanLang(__('lang.submit'))); ?></button><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/components/footer.blade.php ENDPATH**/ ?>