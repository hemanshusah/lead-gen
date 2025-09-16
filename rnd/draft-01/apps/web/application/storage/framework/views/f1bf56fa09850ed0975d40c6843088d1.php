<!--customer type selector-->
<?php if(config('modal.action') == 'create'): ?>
<div class="modal-selector">
    <!--client-->
    <div class="customer-selector-container" id="customer-type-client-container">
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.client'); ?></label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="doc_client_id" id="doc_client_id"
                    class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                <!--select2 basic search-->
                </select>
            </div>
        </div>
    </div>

    <!--lead-->
    <div class="customer-selector-container hidden" id="customer-type-lead-container">
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.lead'); ?></label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="doc_lead_id" id="doc_lead_id"
                    class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                    data-ajax--url="<?php echo e(url('/')); ?>/feed/leadnames?ref=general"></select>
                <!--select2 basic search-->
                </select>
            </div>
        </div>
    </div>

    <!--option buttons-->
    <div class="modal-selector-links">
        <a href="javascript:void(0)" class="customer-type-selector" data-type="lead"
            data-target-container="customer-type-lead-container"><?php echo app('translator')->get('lang.lead'); ?></a> |
        <a href="javascript:void(0)" class="customer-type-selector active" data-type="client"
            data-target-container="customer-type-client-container"><?php echo app('translator')->get('lang.client'); ?></a>
    </div>

    <!--client type indicator-->
    <input type="hidden" name="customer-selection-type" id="customer-selection-type" value="client">
</div>
<?php endif; ?>

<!--template-->
<div class="form-group row">
    <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.template'); ?></label>
    <div class="col-sm-12 col-lg-9">
        <select class="select2-basic form-control form-control-sm" id="proposal_template" name="proposal_template">
            <option value="blank"><?php echo app('translator')->get('lang.none_blank'); ?></option>
            <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($template->proposal_template_id); ?>"><?php echo e($template->proposal_template_title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<div class="line"></div>

<!--proposal_title-->
<div class="form-group row">
    <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.proposal_title'); ?></label>
    <div class="col-sm-12 col-lg-9">
        <input type="text" class="form-control form-control-sm" id="doc_title" name="doc_title"
            value="<?php echo e($proposal->doc_title ?? ''); ?>">
    </div>
</div>

<!--proposal_date-->
<div class="form-group row">
    <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.proposal_date'); ?></label>
    <div class="col-sm-12 col-lg-9">
        <input type="text" class="form-control form-control-sm pickadate" autocomplete="off" name="doc_date_start"
            value="<?php echo e(runtimeDatepickerDate($proposal->doc_date_start ?? '')); ?>">
        <input class="mysql-date" type="hidden" name="doc_date_start" id="doc_date_start"
            value="<?php echo e($proposal->doc_date_start ?? ''); ?>">
    </div>
</div>


<!--valid_until-->
<div class="form-group row">
    <label class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo app('translator')->get('lang.valid_until'); ?></label>
    <div class="col-sm-12 col-lg-9">
        <input type="text" class="form-control form-control-sm pickadate" autocomplete="off" name="doc_date_end"
            value="<?php echo e(runtimeDatepickerDate($proposal->doc_date_end ?? '')); ?>">
        <input class="mysql-date" type="hidden" name="doc_date_end" id="doc_date_end"
            value="<?php echo e($proposal->doc_date_end ?? ''); ?>">
    </div>
</div>

<!--category-->
<div class="form-group row">
    <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label  required"><?php echo e(cleanLang(__('lang.category'))); ?></label>
    <div class="col-sm-12 col-lg-9">
        <select class="select2-basic form-control form-control-sm" id="doc_categoryid" name="doc_categoryid">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->category_id); ?>"
                <?php echo e(runtimePreselected($proposal->doc_categoryid ?? '', $category->category_id)); ?>><?php echo e(runtimeLang($category->category_name)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<!--automation-->
<?php if(config('response') == 'create'): ?>
<div class="form-group form-group-checkbox row">
    <label class="col-10 col-form-label text-left"><?php echo app('translator')->get('lang.automation'); ?> <span class="align-middle text-info font-16"
            data-toggle="tooltip" title="<?php echo app('translator')->get('lang.apply_default_automation_proposals'); ?>" data-placement="top"><i
                class="ti-info-alt"></i></span></label>
    <div class="col-2 text-right p-t-5">
        <input type="checkbox" id="automation" name="automation" class="filled-in chk-col-light-blue"
            <?php echo e(runtimePrechecked(config('system.settings2_proposals_automation_default_status'))); ?>>
        <label class="p-l-30" for="automation"></label>
    </div>
</div>
<?php endif; ?>

<div class="line m-t-40"></div>

<!--redirect to project-->
<div class="form-group form-group-checkbox row">
    <div class="col-12 text-left p-t-5">
        <input type="checkbox" id="show_after_adding" name="show_after_adding" class="filled-in chk-col-light-blue"
            checked="checked">
        <label for="show_after_adding"><?php echo e(cleanLang(__('lang.show_proposal_after_its_created'))); ?></label>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/proposals/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>