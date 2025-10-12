<!--heading-->
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i><?php echo e(cleanLang(__('lang.organisation'))); ?></div>



<!--Form Data-->
<div class="card-show-form-data " id="card-lead-organisation">

    <!--company name-->
    <div class="form-data-row">

        <span class="x-data-title"><?php echo e(cleanLang(__('lang.company_name'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_company_name ?? ''); ?></span>

    </div>


    <!--job title-->
    <div class="form-data-row">
        <span class="x-data-title"><?php echo e(cleanLang(__('lang.job_title'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_job_position ?? ''); ?></span>
    </div>


    <!--street-->
    <div class="form-data-row">
        <span class="x-data-title"><?php echo e(cleanLang(__('lang.street'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_street ?? ''); ?></span>
    </div>


    <!--city-->
    <div class="form-data-row">
        <span class="x-data-title"><?php echo e(cleanLang(__('lang.city'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_city ?? ''); ?></span>
    </div>


    <!--state-->
    <div class="form-data-row">
        <span class="x-data-title"><?php echo e(cleanLang(__('lang.state'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_state ?? ''); ?></span>
    </div>


    <!--zip-->
    <div class="form-data-row">
        <span class="x-data-title"><?php echo e(cleanLang(__('lang.zipcode'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_zip ?? ''); ?></span>
    </div>

    <!--country-->
    <div class="form-data-row">
        <span class="x-data-title"><?php echo e(cleanLang(__('lang.country'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_country ?? ''); ?></span>
    </div>


    <!--website-->
    <div class="form-data-row">
        <span class="x-data-title"><?php echo e(cleanLang(__('lang.website'))); ?>:</span>
        <span class="x-data-content"><?php echo e($lead->lead_website ?? ''); ?></span>
    </div>


    <!--edit button-->
    <?php if(config('visibility.lead_editing_buttons')): ?>
    <div class="form-data-row-buttons">
        <button type="button" class="btn waves-effect waves-light btn-xs btn-info ajax-request"
            data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/edit-organisation')); ?>"
            data-loading-class="loading-before-centre" data-loading-target="card-leads-left-panel"><?php echo app('translator')->get('lang.edit'); ?></button>
    </div>
    <?php endif; ?>

</div>
<!--address and organisation--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/content/organisation/show.blade.php ENDPATH**/ ?>