<div class="row" id="js-trigger-invoices-modal-add-edit" data-payload="<?php echo e($page['section'] ?? ''); ?>">
    <div class="col-lg-12">

        <!--meta data - creatd by-->
        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
        <div class="modal-meta-data">
            <small><strong><?php echo e(cleanLang(__('lang.created_by'))); ?>:</strong> <?php echo e($invoice->first_name); ?>

                <?php echo e($invoice->last_name); ?> |
                <?php echo e(runtimeDate($invoice->bill_created)); ?></small>
        </div>
        <?php endif; ?>



        <!--client and project-->
        <?php if(config('visibility.invoice_modal_client_project_fields')): ?>
        <!--client-->
        <div class="client-selector">

            <!--existing client-->
            <div class="client-selector-container" id="client-existing-container">
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-3 text-left control-label col-form-label  required"><?php echo e(cleanLang(__('lang.client'))); ?>*</label>
                    <div class="col-sm-12 col-lg-9">
                        <!--select2 basic search-->
                        <select name="bill_clientid" id="bill_clientid"
                            class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                            data-projects-dropdown="bill_projectid" data-feed-request-type="clients_projects"
                            data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names">
                            <!--regular invoices-->
                            <?php if(isset($invoice->bill_clientid) && $invoice->bill_clientid != ''): ?>
                            <option value="<?php echo e($invoice->bill_clientid ?? ''); ?>"><?php echo e($invoice->client_company_name); ?>

                            </option>
                            <?php endif; ?>
                            <!--creating invoice from an expense-->
                            <?php if(config('visibility.invoice_from_expense_client_name')): ?>
                            <option value="<?php echo e($expense->expense_clientid ?? ''); ?>"><?php echo e($expense->client_company_name); ?>

                            </option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <!--projects-->
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.project'))); ?></label>
                    <div class="col-sm-12 col-lg-9">
                        <select class="select2-basic form-control form-control-sm dynamic_bill_projectid"
                            data-allow-clear="true" id="bill_projectid" name="bill_projectid" disabled>
                        </select>
                    </div>
                </div>
            </div>

            <!--new client-->
            <div class="client-selector-container hidden" id="client-new-container">
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.company_name'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="client_company_name"
                            name="client_company_name">
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.first_name'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="first_name" name="first_name"
                            placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.last_name'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="last_name" name="last_name"
                            placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        class="col-sm-12 col-lg-4 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.email_address'))); ?>*</label>
                    <div class="col-sm-12 col-lg-8">
                        <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="">
                    </div>
                </div>
            </div>


            <!--CUSTOMER FIELDS [collapsed]-->
            <div class="hidden" id="new-client-custom-fields">
                <?php if(auth()->user()->is_team): ?>
                <div class="spacer row">
                    <div class="col-sm-12 col-lg-8">
                        <span class="title"><?php echo e(cleanLang(__('lang.additional_client_details'))); ?></span class="title">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="switch  text-right">
                            <label>
                                <input type="checkbox" name="add_client_option_other" id="add_client_option_other"
                                    class="js-switch-toggle-hidden-content" data-target="client_custom_fields_collaped">
                                <span class="lever switch-col-light-blue"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="client_custom_fields_collaped" class="hidden">

                    <?php if(config('app.application_demo_mode')): ?>
                    <!--DEMO INFO-->
                    <div class="alert alert-info">
                        <h5 class="text-info"><i class="sl-icon-info"></i> Demo Info</h5>
                        These are custom fields. You can change them or <a
                            href="<?php echo e(url('app/settings/customfields/projects')); ?>">create your own.</a>
                    </div>
                    <?php endif; ?>

                    <?php echo $__env->make('misc.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <?php endif; ?>
            </div>
            <!--/#CUSTOMER FIELDS [collapsed]-->

            <!--option buttons-->
            <div class="client-selector-links">
                <a href="javascript:void(0)" class="client-type-selector" data-type="new"
                    data-target-container="client-new-container"><?php echo app('translator')->get('lang.new_client'); ?></a> |
                <a href="javascript:void(0)" class="client-type-selector active" data-type="existing"
                    data-target-container="client-existing-container"><?php echo app('translator')->get('lang.existing_client'); ?></a>
            </div>

            <!--client type indicator-->
            <input type="hidden" name="client-selection-type" id="client-selection-type" value="existing">
        </div>

        <?php endif; ?>



        <!--invoice date-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.invoice_date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control  form-control-sm pickadate" name="bill_date_add_edit"
                    autocomplete="off" value="<?php echo e(runtimeDatepickerDate($invoice->bill_date ?? '')); ?>">
                <input class="mysql-date" type="hidden" name="bill_date" id="bill_date_add_edit"
                    value="<?php echo e($invoice->bill_date ?? ''); ?>">
            </div>
        </div>

        <!--due date-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.due_date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="bill_due_date_add_edit"
                    autocomplete="off" value="<?php echo e(runtimeDatepickerDate($invoice->bill_due_date ?? '')); ?>">
                <input class="mysql-date" type="hidden" name="bill_due_date" id="bill_due_date_add_edit"
                    value="<?php echo e($invoice->bill_due_date ?? ''); ?>">
            </div>
        </div>



        <!--clients projects-->
        <?php if(config('visibility.invoice_modal_clients_projects')): ?>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label  required"><?php echo e(cleanLang(__('lang.project'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="bill_projectid" name="bill_projectid">
                    <?php $__currentLoopData = config('settings.clients_projects'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($project->project_id ?? ''); ?>"><?php echo e($project->project_title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <?php endif; ?>

        <!--invoice category-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label  required"><?php echo e(cleanLang(__('lang.category'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="bill_categoryid" name="bill_categoryid">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->category_id); ?>"
                        <?php echo e(runtimePreselected($invoice->bill_categoryid ?? '', $category->category_id)); ?>><?php echo e(runtimeLang($category->category_name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="line"></div>

        <!--otions toggle-->
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.additional_information'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" class="js-switch-toggle-hidden-content"
                            data-target="edit_bill_recurring_toggle">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="hidden" id="edit_bill_recurring_toggle">
            <!--tags-->
            <div class="form-group row">
                <label class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.tags'))); ?></label>
                <div class="col-12">
                    <select name="tags" id="tags"
                        class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">
                        <!--array of selected tags-->
                        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
                        <?php $__currentLoopData = $invoice->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $selected_tags[] = $tag->tag_title ; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <!--/#array of selected tags-->
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tag->tag_title); ?>"
                            <?php echo e(runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags ?? [])); ?>>
                            <?php echo e($tag->tag_title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <!-- notes-->
            <div class="form-group row">
                <label class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.notes'))); ?></label>
                <div class="col-12">
                    <textarea id="bill_notes" name="bill_notes"
                        class="tinymce-textarea"><?php echo e($invoice->bill_notes ?? ''); ?></textarea>
                </div>
            </div>


            <!-- terms-->
            <div class="form-group row">
                <label
                    class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.terms_and_conditions'))); ?></label>
                <div class="col-12">
                    <textarea id="bill_terms" name="bill_terms" class="tinymce-textarea">
                        <?php if(isset($page['section']) && $page['section'] == 'create'): ?>
                        <?php echo e(config('system.settings_invoices_default_terms_conditions')); ?>

                        <?php else: ?>
                        <?php echo e($invoice->bill_terms ?? ''); ?>

                        <?php endif; ?>                 
                </textarea>
                </div>
            </div>
        </div>
        <!--/#options toggle-->



        <!--source-->
        <input type="hidden" name="source" value="<?php echo e(request('source')); ?>">

        <!--expenses payload-->
        <?php if(config('visibility.invoice_modal_expenses_payload')): ?>
        <input type="hidden" name="expense_payload[]" value="<?php echo e(config('settings.expense_id')); ?>">
        <?php endif; ?>

        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>
            </div>
        </div>

        <!--recurring notes-->
        <div class="alert alert-info m-t-10"><i class="sl-icon-refresh text-warning"></i>
            <?php echo e(cleanLang(__('lang.recurring_invoice_options_info'))); ?></div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/invoices/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>