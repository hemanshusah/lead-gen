<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-projects">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_projects'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-projects"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--client-->
                <?php if(config('visibility.filter_panel_client_project')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <!--select2 basic search-->
                                <select name="filter_project_clientid" id="filter_project_clientid"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                                <!--select2 basic search-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!--client-->

                <!--assigned-->
                <?php if(config('visibility.filter_panel_assigned')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.assigned'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_assigned" id="filter_assigned"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <!--users list-->
                                    <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!--/#users list-->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!--start date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.start_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_start_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_start_date_start"
                                    name="filter_start_date_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_start_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_start_date_end"
                                    name="filter_start_date_end" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--start date-->


                <!--due date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.due_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_due_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_due_date_start"
                                    name="filter_due_date_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_due_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_due_date_end"
                                    name="filter_due_date_end" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--due date-->

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

                <!--categorgies-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_project_categoryid" id="filter_project_categoryid"
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
                                <select name="filter_project_status" id="filter_project_status"
                                    class="form-control form-control-sm select2-basic select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = config('settings.project_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e(runtimeLang($key)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--status-->


                <!--state-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.show'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm"
                                    id="filter_project_state" name="filter_project_state">
                                    <option value=""></option>
                                    <option value="active"><?php echo app('translator')->get('lang.active_projects'); ?></option>
                                    <option value="archived"><?php echo app('translator')->get('lang.archives_projects'); ?></option>
                                    <option value="all"><?php echo app('translator')->get('lang.everything'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--status -->
                    
                <!--custom fields-->
                <?php echo $__env->make('misc.customfields-filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel"><?php echo e(cleanLang(__('lang.reset'))); ?></button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/projects/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/projects/components/misc/filter-projects.blade.php ENDPATH**/ ?>