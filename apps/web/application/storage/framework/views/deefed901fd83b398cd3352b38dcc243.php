<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-estimates">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_estimates'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-estimates"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--company name-->
                <?php if(config('visibility.filter_panel_client')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <!--select2 basic search-->
                                <select name="filter_bill_clientid" id="filter_bill_clientid"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                                <!--select2 basic search-->
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
                                <select class="select2-basic form-control form-control-sm" id="filter_bill_projectid"
                                    name="filter_bill_projectid">
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

                <!--amount-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.amount'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_bill_subtotal_min" id="filter_bill_subtotal_min"
                                    class="form-control form-control-sm" placeholder="<?php echo e(cleanLang(__('lang.minimum'))); ?>">
                            </div>
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon"><?php echo e(config('system.settings_system_currency_symbol')); ?></span>
                                <input type="number" name="filter_bill_subtotal_max" id="filter_bill_subtotal_max"
                                    class="form-control form-control-sm" placeholder="<?php echo e(cleanLang(__('lang.maximum'))); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!--date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.estimate_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_date_start" 
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start">
                                <input class="mysql-date" type="hidden" name="filter_bill_date_start" id="filter_bill_date_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_date_end" 
                                    class="form-control form-control-sm pickadate" autocomplete="off" placeholder="End">
                                <input class="mysql-date" type="hidden" name="filter_bill_date_end" id="filter_bill_date_end" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <!--expiry-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.expiry_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_expiry_date_start"
                                    
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start">
                                <input class="mysql-date" type="hidden" id="filter_bill_expiry_date_start" name="filter_bill_expiry_date_start"
                                    value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_bill_expiry_date_end"
                                     class="form-control form-control-sm pickadate"
                                    autocomplete="off" placeholder="End">
                                <input class="mysql-date" type="hidden" id="filter_bill_expiry_date_end" name="filter_bill_expiry_date_end" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <!--tags-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.tags'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_tags" id="filter_tags"
                                    class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tag->tag_title); ?>">
                                        <?php echo e($tag->tag_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tags-->

                <!--created by-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.created_by'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_bill_creatorid" id="filter_bill_creatorid"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--categorgies-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_bill_categoryid" id="filter_bill_categoryid"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->category_id); ?>">
                                        <?php echo e($category->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--status-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.status'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_bill_status" id="filter_bill_status"
                                    class="form-control form-control-sm select2-basic select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = config('settings.estimate_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e(runtimeLang($key)); ?></option>
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
                        data-url="<?php echo e(urlResource('/estimates/search')); ?>"
                        data-type="form" data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/estimates/components/misc/filter-estimates.blade.php ENDPATH**/ ?>