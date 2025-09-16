
<div class="row">
    <div class="col-lg-12">

        <?php if(config('visibility.task_modal_project_option')): ?>
        <!--project-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.project'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select name="task_projectid" id="task_projectid"
                    class="projects_assigned_toggle projects_assigned_client_toggle form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                    data-assigned-dropdown="assigned" data-client-assigned-dropdown="assigned-client"
                    data-ajax--url="<?php echo e(url('/')); ?>/feed/projects?ref=general"></select>
            </div>
        </div>
        <?php endif; ?>

        <!--title-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.title'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="task_title" name="task_title"
                    placeholder="">
            </div>
        </div>



        <?php if(config('visibility.task_modal_milestone_option')): ?>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.milestone'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select name="task_milestoneid" id="task_milestoneid"
                    class="select2-basic form-control form-control-sm">
                    <?php if(isset($milestones)): ?>
                    <?php $__currentLoopData = $milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($milestone->milestone_id); ?>">
                        <?php echo e(runtimeLang($milestone->milestone_title, 'task_milestone')); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <!--/#users list-->
                </select>
            </div>
        </div>
        <?php endif; ?>

        <!--task status-->
        <?php if(request('status') != ''): ?>
        <input type="hidden" name="task_status" value="<?php echo e(request('status')); ?>">
        <?php else: ?>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.status'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="task_status" name="task_status">
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status->taskstatus_id); ?>"><?php echo e(runtimeLang($status->taskstatus_title)); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
            </div>
        </div>
        <?php endif; ?>




        <!--task priority-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.priority'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="task_priority" name="task_priority">
                    <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($priority->taskpriority_id); ?>"><?php echo e($priority->taskpriority_title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <!--assigned [team users]-->
        <?php if(auth()->user()->role->role_assign_tasks == 'yes' && config('visibility.tasks_standard_features')): ?>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.assign_users'))); ?>

                <a class="align-middle font-16 toggle-collapse" href="#assigning_info" role="button"><i
                        class="ti-info-alt text-themecontrast"></i></a></label>
            <div class="col-sm-12 col-lg-9">
                <?php if(config('visibility.projects_assigned_users')): ?>
                <select name="assigned" id="assigned"
                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                    multiple="multiple" tabindex="-1" aria-hidden="true">
                    <?php $__currentLoopData = config('project.assigned'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user->type =='team'): ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php else: ?>
                <select name="assigned" id="assigned"
                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                    multiple="multiple" tabindex="-1" aria-hidden="true" disabled>
                </select>
                <?php endif; ?>
            </div>
        </div>
        <div class="collapse" id="assigning_info">
            <div class="alert alert-info">
                <?php echo e(cleanLang(__('lang.assigning_users_to_a_task_info'))); ?>

            </div>
        </div>
        <?php endif; ?>



        <!--assigned [client users]-->
        <?php if(auth()->user()->role->role_assign_tasks == 'yes' && config('visibility.tasks_standard_features')): ?>
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo app('translator')->get('lang.assign_client'); ?>
                <a class="align-middle font-16 toggle-collapse" href="#assigning_client_info" role="button"><i
                        class="ti-info-alt text-themecontrast"></i></a></label>
            <div class="col-sm-12 col-lg-9">
                <?php if(config('visibility.projects_assigned_users')): ?>
                <select name="assigned-client" id="assigned-client"
                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                    multiple="multiple" tabindex="-1" aria-hidden="true">
                    <?php $__currentLoopData = config('project.client_users'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php else: ?>
                <select name="assigned-client" id="assigned-client"
                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                    multiple="multiple" tabindex="-1" aria-hidden="true" disabled>
                </select>
                <?php endif; ?>
            </div>
        </div>
        <div class="collapse" id="assigning_client_info">
            <div class="alert alert-info">
                <?php echo app('translator')->get('lang.assign_client_info'); ?>
            </div>
        </div>
        <?php endif; ?>


        <!--CUSTOMER FIELDS [expanded]-->
        <?php if(config('system.settings_customfields_display_tasks') == 'expanded'): ?>
        <?php echo $__env->make('misc.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!--/#CUSTOMER FIELDS [expanded]-->

        <div class="line"></div>
        <!--spacer-->
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.description'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="show_more_settings_tasks" id="show_more_settings_tasks"
                            class="js-switch-toggle-hidden-content" data-target="task_description_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <!--spacer-->

        <!--description-->
        <div class="hidden" id="task_description_section">
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea id="project_description" name="task_description"
                        class="tinymce-textarea"><?php echo e($task->task_description ?? ''); ?></textarea>
                </div>
            </div>
        </div>



        <!--CUSTOMER FIELDS [collapsed]-->
        <?php if(config('system.settings_customfields_display_tasks') == 'toggled'): ?>
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.more_information'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="add_client_option_other" id="add_client_option_other"
                            class="js-switch-toggle-hidden-content" data-target="leads_custom_fields_collaped">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div id="leads_custom_fields_collaped" class="hidden">
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
        <!--/#CUSTOMER FIELDS [collapsed]-->

        <?php if(config('visibility.task_modal_additional_options')): ?>
        <!--spacer-->
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title"><?php echo e(cleanLang(__('lang.options'))); ?></span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="show_more_settings_tasks2" id="show_more_settings_tasks2"
                            class="js-switch-toggle-hidden-content" data-target="additional_information_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <!--spacer-->
        <!--option toggle-->
        <div class="hidden" id="additional_information_section">

            <!--due date-->
            <?php if(config('visibility.tasks_standard_features')): ?>
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.target_date'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm pickadate" name="task_date_due"
                        autocomplete="off" placeholder="">
                    <input class="mysql-date" type="hidden" name="task_date_due" id="task_date_due">
                </div>
            </div>
            <?php endif; ?>


            <!--tags-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.tags'))); ?></label>
                <div class="col-sm-12 col-lg-9">
                    <select name="tags" id="tags"
                        class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">
                        <!--array of selected tags-->
                        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
                        <?php $__currentLoopData = $lead->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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


            <!--[toggled] project options-->
            <div class="toggle_task_type add_task_toggle_container_project">
                <div class="form-group form-group-checkbox row">
                    <div class="col-12 p-t-5">
                        <div class="pull-left min-w-200">
                            <label><?php echo e(cleanLang(__('lang.visible_to_client'))); ?></label>
                        </div>
                        <div class="pull-left p-l-10">
                            <?php if(isset($page['section']) && $page['section'] == 'create'): ?>
                            <input type="checkbox" id="task_client_visibility" name="task_client_visibility"
                                <?php echo e(runtimeTasksDefaults('task_client_visibility')); ?>

                                class="filled-in chk-col-light-blue">
                            <?php endif; ?>
                            <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
                            <input type="checkbox" id="task_client_visibility" name="task_client_visibility"
                                class="filled-in chk-col-light-blue">
                            <?php endif; ?>
                            <label for="task_client_visibility"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-checkbox row">
                    <div class="col-12 p-t-5">
                        <div class="pull-left min-w-200">
                            <label><?php echo e(cleanLang(__('lang.billable'))); ?></label>
                        </div>
                        <div class="pull-left p-l-10">
                            <?php if(isset($page['section']) && $page['section'] == 'create'): ?>
                            <input type="checkbox" id="task_billable" name="task_billable"
                                <?php echo e(runtimeTasksDefaults('task_billable')); ?> class="filled-in chk-col-light-blue">
                            <?php endif; ?>
                            <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
                            <input type="checkbox" id="task_billable" name="task_billable"
                                class="filled-in chk-col-light-blue">
                            <?php endif; ?>
                            <label for="task_billable"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--option toggle-->
        <?php endif; ?>


        <!--redirect to project-->
        <?php if(config('visibility.task_show_task_option')): ?>
        <div class="line"></div>
        <div class="form-group form-group-checkbox row">
            <div class="col-12 text-left p-t-5">
                <input type="checkbox" id="show_after_adding" name="show_after_adding"
                    class="filled-in chk-col-light-blue" checked="checked">
                <label for="show_after_adding"><?php echo e(cleanLang(__('lang.show_task_after_adding'))); ?></label>
            </div>
        </div>
        <?php endif; ?>

        <!--pass source-->
        <input type="hidden" name="source" value="<?php echo e(request('source')); ?>">
        <input type="hidden" name="ref" value="<?php echo e(request('ref')); ?>">

        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>
            </div>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tasks/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>