<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-payments">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_payments'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-payments"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">


                <?php if(config('visibility.filter_panel_client_project')): ?>
                <!--company name-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_payment_clientid" id="filter_payment_clientid"
                                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-projects-dropdown="filter_payment_projectid"
                                    data-feed-request-type="clients_projects"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--project-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.project'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm dynamic_filter_payment_projectid" id="filter_payment_projectid"
                                    name="filter_payment_projectid" disabled>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


                <!--clients project list-->
                <?php if(config('visibility.filter_panel_clients_projects')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.project'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm" id="filter_payment_projectid"
                                    name="filter_payment_projectid">
                                    <option></option>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->project_id); ?>"><?php echo e($project->project_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!--payment id-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.invoice_id'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"
                                        id="basic-addon1"><?php echo e(config('system.settings_invoices_prefix')); ?></span>
                                    <input type="text" name="filter_payment_invoiceid" id="filter_payment_invoiceid"
                                        class="form-control form-control-sm" placeholder=""
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--amount-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.amount'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6 input-group input-group-sm">
                                <span
                                    class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_payment_amount_min" id="filter_payment_amount_min"
                                    class="form-control form-control-sm" placeholder="<?php echo e(cleanLang(__('lang.minimum'))); ?>">
                            </div>
                            <div class="col-md-6 input-group input-group-sm">
                                <span
                                    class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_payment_amount_max" id="filter_payment_amount_max"
                                    class="form-control form-control-sm" placeholder="<?php echo e(cleanLang(__('lang.maximum'))); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.payment_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_payment_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_payment_date_start"
                                    name="filter_payment_date_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_payment_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_payment_date_end"
                                    name="filter_payment_date_end" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <!--methods-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.payment_method'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_payment_gateway" id="filter_payment_gateway"
                                    class="select2-basic form-control form-control-sm">
                                    <option></option>
                                    <?php $__currentLoopData = config('system.gateways'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($gateway); ?>"><?php echo e($gateway); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel"><?php echo e(cleanLang(__('lang.reset'))); ?></button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/payments/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/payments/components/misc/filter-payments.blade.php ENDPATH**/ ?>