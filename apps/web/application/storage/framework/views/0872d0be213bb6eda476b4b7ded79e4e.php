<!--modal-->
<div class="row" id="js-trigger-clients-modal-add-edit" data-payload="<?php echo e($page['section'] ?? ''); ?>">
    <div class="col-lg-12">

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.company_name'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="client_company_name"
                    name="client_company_name" value="<?php echo e($client->client_company_name ?? ''); ?>">
            </div>
        </div>



        <?php if(isset($page['section']) && $page['section'] == 'edit' && auth()->user()->is_team): ?>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.category'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="client_categoryid"
                    name="client_categoryid">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->category_id); ?>"
                        <?php echo e(runtimePreselected($client->client_categoryid ?? '', $category->category_id)); ?>><?php echo e(runtimeLang($category->category_name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="example-month-input"
                class="col-sm-12 col-lg-3 col-form-label text-left"><?php echo e(cleanLang(__('lang.status'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="client_status" name="client_status">
                    <option></option>
                    <option value="active" <?php echo e(runtimePreselected($client->client_status ?? '', 'active')); ?>>
                        <?php echo e(cleanLang(__('lang.active'))); ?></option>
                    <option value="suspended" <?php echo e(runtimePreselected($client->client_status ?? '', 'suspended')); ?>>
                        <?php echo e(cleanLang(__('lang.suspended'))); ?>

                    </option>
                </select>
            </div>
        </div>

        <div class="line"></div>
        <?php endif; ?>

        <!--contact section-->
        <?php if(isset($page['section']) && $page['section'] == 'create'): ?>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.first_name'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="first_name" name="first_name"
                    placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.last_name'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="last_name" name="last_name" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.email_address'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.category'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="client_categoryid"
                    name="client_categoryid">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->category_id); ?>"
                        <?php echo e(runtimePreselected($client->client_categoryid ?? '', $category->category_id)); ?>><?php echo e(runtimeLang($category->category_name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="line"></div>
        <?php endif; ?>
        <!--contact section-->


        <!--CUSTOMER FIELDS [expanded]-->
        <?php if(auth()->user()->is_team && config('system.settings_customfields_display_clients') == 'expanded'): ?>
        <?php echo $__env->make('misc.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!--/#CUSTOMER FIELDS [expanded]-->

        <!--DESCRIPTION & DETAILS-->
        <?php if(auth()->user()->is_team): ?>
        <div class="spacer row">
            <div class="col-sm-8">
                <span class="title"><?php echo e(cleanLang(__('lang.description_and_details'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" class="js-switch-toggle-hidden-content"
                            data-target="edit_client_description_toggle">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="hidden" id="edit_client_description_toggle">

            <textarea id="client_description" name="client_description"
                class="tinymce-textarea"><?php echo e($client->client_description ?? ''); ?></textarea>


            <!--tags-->
            <div class="form-group row m-t-20">
                <label class="col-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.tags'))); ?></label>
                <div class="col-12">
                    <select name="tags" id="tags"
                        class="form-control form-control-sm select2-multiple select2-tags select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">

                        <!--array of selected tags-->
                        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
                        <?php $__currentLoopData = $client->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $selected_tags[] = $tag->tag_title ; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <!--/#array of selected tags-->

                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tag->tag_title); ?>"
                            <?php echo e(runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags  ?? [])); ?>>
                            <?php echo e($tag->tag_title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <!--/#tags-->

            <div class="line m-t-30"></div>

        </div>
        <?php endif; ?>
        <!--/#DESCRIPTION & DETAILS-->


        <!--billing address section-->
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.billing_address'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="add_client_option_bill_address" id="add_client_option_bill_address"
                            class="js-switch-toggle-hidden-content" data-target="add_client_billing_address_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <!--billing address section-->


        <!--billing address section-->
        <div id="add_client_billing_address_section" class="hidden">
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.street'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_street"
                        name="client_billing_street" value="<?php echo e($client->client_billing_street ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.city'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_city"
                        name="client_billing_city" value="<?php echo e($client->client_billing_city ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.state'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_state"
                        name="client_billing_state" value="<?php echo e($client->client_billing_state ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.zipcode'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_zip"
                        name="client_billing_zip" value="<?php echo e($client->client_billing_zip ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-month-input"
                    class="col-sm-12 col-lg-3 col-form-label text-left"><?php echo e(cleanLang(__('lang.country'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <?php $selected_country = $client->client_billing_country ?? ''; ?>
                    <select class="select2-basic-with-search form-control form-control-sm" id="client_billing_country"
                        name="client_billing_country">
                        <option></option>
                        <?php echo $__env->make('misc.country-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.telephone'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_phone" name="client_phone"
                        value="<?php echo e($client->client_phone ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.website'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_website" name="client_website"
                        value="<?php echo e($client->client_website ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.vat_tax_number'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_vat" name="client_vat"
                        value="<?php echo e($client->client_vat ?? ''); ?>">
                </div>
            </div>
            <div class="line"></div>
        </div>
        <!--billing address section-->


        <!--shipping address section-->
        <?php if(config('system.settings_clients_shipping_address') == 'enabled'): ?>
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.shipping_address'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="add_client_option_shipping_address"
                            id="add_client_option_shipping_address" class="js-switch-toggle-hidden-content"
                            data-target="add_client_shipping_address_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!--shipping address section-->


        <!--shipping address section-->
        <?php if(config('system.settings_clients_shipping_address') == 'enabled'): ?>
        <div id="add_client_shipping_address_section" class="hidden">
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.street'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_street"
                        name="client_shipping_street" value="<?php echo e($client->client_shipping_street ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.city'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_city"
                        name="client_shipping_city" value="<?php echo e($client->client_shipping_city ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.state'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_state"
                        name="client_shipping_state" value="<?php echo e($client->client_shipping_state ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.zipcode'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_zip"
                        name="client_shipping_zip" value="<?php echo e($client->client_shipping_zip ?? ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-month-input"
                    class="col-sm-12 col-lg-3 col-form-label text-left"><?php echo e(cleanLang(__('lang.country'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <?php $selected_country = $client->client_shipping_country ?? ''; ?>
                    <select class="select2-basic-with-search form-control form-control-sm" id="client_shipping_country"
                        name="client_shipping_country">
                        <option></option>
                        <?php echo $__env->make('misc.country-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-checkbox row" id="expense_billable_option">
                <label
                    class="col-sm-12 col-lg-3 col-form-label text-left"><?php echo e(cleanLang(__('lang.same_as_billing'))); ?></label>
                <div class="col-6 text-left p-t-5">
                    <input type="checkbox" id="same_as_billing_address" name="same_as_billing_address"
                        class="filled-in chk-col-light-blue">
                    <label for="same_as_billing_address"></label>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!--shipping address section-->


        <!--APP MODULES-->
        <?php if(auth()->user()->is_team): ?>
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.app_modules'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="add_client_option_other" id="add_client_option_other"
                            class="js-switch-toggle-hidden-content" data-target="client_app_modules_collaped">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div id="client_app_modules_collaped" class="hidden">

            <!--(select2-preselected) &  (data-preselected) are optional-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo app('translator')->get('lang.enabled_modules'); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <select class="select2-basic form-control form-control-sm select2-preselected"
                        id="client_app_modules" name="client_app_modules"
                        data-preselected="<?php echo e($client->client_app_modules ?? 'system'); ?>">
                        <option value="system"><?php echo app('translator')->get('lang.use_system_settings'); ?></option>
                        <option value="custom"><?php echo app('translator')->get('lang.use_custom_settings'); ?></option>
                    </select>
                </div>
            </div>


            <!--custom client modules settings-->
            <div id="client_app_modules_pemissions"
                class="<?php echo e(runtimeVisibility('client_app_modules_pemissions', $client->client_app_modules ?? 'system')); ?>">

                <div class="highlighted-panel">
                    <!--preselect when in create mode-->
                    <?php $creation_prechecked = ($page['section'] == 'create') ? 'checked' : ''; ?>

                    <!--_projects-->
                    <?php if(config('system.settings_modules_projects') == 'enabled'): ?>
                    <div class="form-group form-group-checkbox row">
                        <label class="col-sm-12 col-lg-10 col-form-label text-left"><?php echo app('translator')->get('lang.projects'); ?></label>
                        <div class="col-sm-12 col-lg-2 text-left p-t-5">
                            <input type="checkbox" id="client_settings_modules_projects"
                                name="client_settings_modules_projects"
                                <?php echo e(runtimePrechecked($client->client_settings_modules_projects ?? '')); ?> <?php echo e($creation_prechecked); ?> class="filled-in chk-col-light-blue">
                            <label for="client_settings_modules_projects"></label>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!--invoices-->
                    <?php if(config('system.settings_modules_invoices') == 'enabled'): ?>
                    <div class="form-group form-group-checkbox row">
                        <label class="col-sm-12 col-lg-10 col-form-label text-left"><?php echo app('translator')->get('lang.invoices'); ?></label>
                        <div class="col-sm-12 col-lg-2 text-left p-t-5">
                            <input type="checkbox" id="client_settings_modules_invoices"
                                name="client_settings_modules_invoices"
                                <?php echo e(runtimePrechecked($client->client_settings_modules_invoices ?? '')); ?> <?php echo e($creation_prechecked); ?>  class="filled-in chk-col-light-blue">
                            <label for="client_settings_modules_invoices"></label>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!--payments-->
                    <?php if(config('system.settings_modules_payments') == 'enabled'): ?>
                    <div class="form-group form-group-checkbox row">
                        <label class="col-sm-12 col-lg-10 col-form-label text-left"><?php echo app('translator')->get('lang.payments'); ?></label>
                        <div class="col-sm-12 col-lg-2 text-left p-t-5">
                            <input type="checkbox" id="client_settings_modules_payments"
                                name="client_settings_modules_payments"
                                <?php echo e(runtimePrechecked($client->client_settings_modules_payments ?? '')); ?> <?php echo e($creation_prechecked); ?>  class="filled-in chk-col-light-blue">
                            <label for="client_settings_modules_payments"></label>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!--knowledgebase-->
                    <?php if(config('system.settings_modules_knowledgebase') == 'enabled'): ?>
                    <div class="form-group form-group-checkbox row">
                        <label class="col-sm-12 col-lg-10 col-form-label text-left"><?php echo app('translator')->get('lang.knowledgebase'); ?></label>
                        <div class="col-sm-12 col-lg-2 text-left p-t-5">
                            <input type="checkbox" id="client_settings_modules_knowledgebase"
                                name="client_settings_modules_knowledgebase"
                                <?php echo e(runtimePrechecked($client->client_settings_modules_knowledgebase ?? '')); ?> <?php echo e($creation_prechecked); ?>  class="filled-in chk-col-light-blue">
                            <label for="client_settings_modules_knowledgebase"></label>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!--estimates-->
                    <?php if(config('system.settings_modules_estimates') == 'enabled'): ?>
                    <div class="form-group form-group-checkbox row">
                        <label class="col-sm-12 col-lg-10 col-form-label text-left"><?php echo app('translator')->get('lang.estimates'); ?></label>
                        <div class="col-sm-12 col-lg-2 text-left p-t-5">
                            <input type="checkbox" id="client_settings_modules_estimates"
                                name="client_settings_modules_estimates"
                                <?php echo e(runtimePrechecked($client->client_settings_modules_estimates ?? '')); ?> <?php echo e($creation_prechecked); ?>  class="filled-in chk-col-light-blue">
                            <label for="client_settings_modules_estimates"></label>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!--subscriptions-->
                    <?php if(config('system.settings_modules_subscriptions') == 'enabled'): ?>
                    <div class="form-group form-group-checkbox row">
                        <label class="col-sm-12 col-lg-10 col-form-label text-left"><?php echo app('translator')->get('lang.subscriptions'); ?></label>
                        <div class="col-sm-12 col-lg-2 text-left p-t-5">
                            <input type="checkbox" id="client_settings_modules_subscriptions"
                                name="client_settings_modules_subscriptions"
                                <?php echo e(runtimePrechecked($client->client_settings_modules_subscriptions ?? '')); ?> <?php echo e($creation_prechecked); ?>  class="filled-in chk-col-light-blue">
                            <label for="client_settings_modules_subscriptions"></label>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!--tickets-->
                    <?php if(config('system.settings_modules_tickets') == 'enabled'): ?>
                    <div class="form-group form-group-checkbox row">
                        <label class="col-sm-12 col-lg-10 col-form-label text-left"><?php echo app('translator')->get('lang.tickets'); ?></label>
                        <div class="col-sm-12 col-lg-2 text-left p-t-5">
                            <input type="checkbox" id="client_settings_modules_tickets"
                                name="client_settings_modules_tickets"
                                <?php echo e(runtimePrechecked($client->client_settings_modules_tickets ?? '')); ?> <?php echo e($creation_prechecked); ?>  class="filled-in chk-col-light-blue">
                            <label for="client_settings_modules_tickets"></label>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="alert alert-info"><?php echo app('translator')->get('lang.only_system_enabled_modules_enabled'); ?> <a href="<?php echo e(url('app/settings/modules')); ?>" target="_blank">(<?php echo app('translator')->get('lang.see_settings'); ?>)</a></div>
                </div>

            </div>

        </div>
        <?php endif; ?>


        <!--CUSTOMER FIELDS [collapsed]-->
        <?php if(auth()->user()->is_team && config('system.settings_customfields_display_clients') == 'toggled'): ?>
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.more_information'))); ?></span class="title">
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
                These are custom fields. You can change them or <a href="<?php echo e(url('app/settings/customfields/projects')); ?>">create your own.</a>
            </div>
            <?php endif; ?>
            
            <?php echo $__env->make('misc.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php endif; ?>
        <!--/#CUSTOMER FIELDS [collapsed]-->


        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>
            </div>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/clients/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>