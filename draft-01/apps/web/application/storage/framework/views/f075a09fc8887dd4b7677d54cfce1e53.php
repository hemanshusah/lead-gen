<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-timesheets">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.filter_timesheets'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-timesheets"></i>
                </span>
            </div>
            <!--body-->
            <div class="r-panel-body">


                <!-- team member -->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.team_members'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_timer_creatorid" id="filter_timer_creatorid"
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

                <!--project-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.project'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_timer_projectid" id="filter_timer_projectid"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/projects?ref=general"></select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--grouping-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.grouping'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm" id="filter_grouping"
                                    name="filter_grouping">
                                    <option value="none"><?php echo e(cleanLang(__('lang.no_grouping'))); ?></option>
                                    <option value="task"><?php echo e(cleanLang(__('lang.group_by_task'))); ?></option>
                                    <option value="user"><?php echo e(cleanLang(__('lang.group_by_user'))); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--date range-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_date_created_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start">
                                <input class="mysql-date" type="hidden" name="filter_date_created_start"
                                    id="filter_date_created_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_date_created_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off" placeholder="End">
                                <input class="mysql-date" type="hidden" name="filter_date_created_end"
                                    id="filter_date_created_end" value="">
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
                                <select class="select2-basic form-control form-control-sm select2-preselected"
                                data-allow-clear="true" id="filter_timer_billing_status" name="filter_timer_billing_status">
                                <option></option>
                                <option value="invoiced"><?php echo app('translator')->get('lang.invoice'); ?></option>
                                <option value="not_invoiced"><?php echo app('translator')->get('lang.not_invoiced'); ?></option>
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
                        data-url="<?php echo e(urlResource('/timesheets/search?')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/timesheets/components/misc/filter-timesheets.blade.php ENDPATH**/ ?>