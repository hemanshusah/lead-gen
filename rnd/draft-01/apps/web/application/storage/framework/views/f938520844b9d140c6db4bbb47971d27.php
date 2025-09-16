<!--options menu-->
<div class="col-sm-12 col-lg-3">
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <div class="ticket-panel">
                    <div class="x-top-header">
                        <?php echo e(cleanLang(__('lang.ticket_options'))); ?>

                    </div>
                    <div class="x-body form-horizontal">
                        <?php if(auth()->user()->is_team): ?>
                        <div class="form-group row">
                            <label for="example-month-input" class="col-12 control-label col-form-label text-left required"><?php echo e(cleanLang(__('lang.client'))); ?></label>
                            <div class="col-12">
                                <select name="ticket_clientid" id="ticket_clientid" class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-projects-dropdown="ticket_projectid" data-feed-request-type="clients_projects"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                            </div>
                        </div>

                        <!--project-->
                        <div class="form-group row">
                            <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.project'))); ?></label>
                            <div class="col-12">
                                <select class="select2-basic form-control form-control-sm dynamic_ticket_projectid" id="ticket_projectid" name="ticket_projectid"
                                    disabled>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!--department-->
                        <div class="form-group row">
                            <label for="example-month-input" class="col-12 control-label col-form-label text-left required"><?php echo e(cleanLang(__('lang.department'))); ?></label>
                            <div class="col-12">
                                <select class="select2-basic form-control  form-control-sm" id="ticket_categoryid" name="ticket_categoryid">
                                    <option></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->category_id); ?>">
                                        <?php echo e($category->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <!--clients projects-->
                        <?php if(auth()->user()->is_client): ?>
                        <div class="form-group row">
                            <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.project'))); ?></label>
                            <div class="col-12">
                                <select class="select2-basic form-control  form-control-sm" id="ticket_projectid" name="ticket_projectid"
                                    data-allow-clear="true">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $clients_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->project_id); ?>">
                                        <?php echo e($project->project_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!--priority-->
                        <?php if(auth()->user()->is_team): ?>
                        <div class="form-group row">
                            <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.priority'))); ?></label>
                            <div class="col-12">
                                <select class="select2-basic form-control  form-control-sm" id="ticket_priority" name="ticket_priority">
                                    <?php $__currentLoopData = config('settings.ticket_priority'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e(runtimeLang($key)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="line m-t-40 m-b-0"></div>

                        <?php echo $__env->make('pages.tickets.components.create.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tickets/components/create/options.blade.php ENDPATH**/ ?>