    <!----------Assigned----------->
    <div class="x-section">
        <div class="x-title">
            <h6><?php echo e(cleanLang(__('lang.assigned_users'))); ?></h6>
        </div>
        <span id="lead-assigned-container" class="">
            <?php echo $__env->make('pages.lead.components.assigned', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </span>
        <!--user-->
        <span class="x-assigned-user x-assign-new js-card-settings-button-static card-lead-assigned text-info" data-container=".card-modal" 
            tabindex="0" data-popover-content="card-lead-team" data-title="<?php echo e(cleanLang(__('lang.assign_users'))); ?>"><i
                class="mdi mdi-plus"></i></span>
    </div>

    <!----------settings----------->
    <div class="x-section">

        <!--customer-->
        <?php if($lead->lead_converted == 'yes'): ?>
        <div class="x-element x-customer"><?php echo e(cleanLang(__('lang.customer'))); ?></div>
        <?php endif; ?>

        <div class="x-title">
            <h6><?php echo e(cleanLang(__('lang.details'))); ?></h6>
        </div>
        <!--Name-->
        <div class="x-element text-center font-14" id="card-lead-element-container-name">
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable js-card-settings-button-static" id="card-lead-name" data-container=".card-modal" tabindex="0"
                data-popover-content="card-lead-name-popover" data-title="<?php echo e(cleanLang(__('lang.name'))); ?>">
                <span id="card-lead-firstname-containter"><?php echo e($lead->lead_firstname); ?></span> <span
                    id="card-lead-lastname-containter"><?php echo e($lead->lead_lastname); ?></span></span>
            <?php else: ?>
            <span class="x-highlight"><?php echo e($lead->lead_firstname); ?> <?php echo e($lead->lead_lastname); ?></span>
            <?php endif; ?>
        </div>
        <!--value-->
        <div class="x-element"><i class="mdi mdi-cash-multiple"></i> <span><?php echo e(cleanLang(__('lang.value'))); ?>: </span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable js-card-settings-button-static" data-container=".card-modal" id="card-lead-value" tabindex="0"
                data-popover-content="card-lead-value-popover" data-value="<?php echo e($lead->lead_value); ?>"
                data-title="<?php echo e(cleanLang(__('lang.value'))); ?>"><?php echo e(runtimeMoneyFormat($lead->lead_value)); ?></span>
            <?php else: ?>
            <span class="x-highlight"><?php echo e(runtimeMoneyFormat($lead->lead_value)); ?></span>
            <?php endif; ?>
        </div>
        <!--status-->
        <div class="x-element" id="card-lead-status"><i class="mdi mdi-flag"></i>
            <span><?php echo e(cleanLang(__('lang.status'))); ?>: </span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable js-card-settings-button-static" data-container=".card-modal" id="card-lead-status-text" tabindex="0"
                data-popover-content="card-lead-status-popover"
                data-title="<?php echo e(cleanLang(__('lang.status'))); ?>"><?php echo e(runtimeLang($lead->leadstatus_title)); ?></strong></span>
            <?php else: ?>
            <span class="x-highlight"><?php echo e(runtimeLang($lead->leadstatus_title)); ?></span>
            <?php endif; ?>
        </div>
        <!--added-->
        <div class="x-element" id="lead-date-added"><i class="mdi mdi-calendar-plus"></i>
            <span><?php echo e(cleanLang(__('lang.added'))); ?>:</span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable card-pickadate"
                data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-date-added/')); ?>" data-type="form"
                data-form-id="lead-date-added" data-hidden-field="lead_created"
                data-container="lead-date-added-container" data-ajax-type="post"
                id="lead-date-added-container"><?php echo e(runtimeDate($lead->lead_created)); ?></span></span>
            <input type="hidden" name="lead_created" id="lead_created">
            <?php else: ?>
            <span class="x-highlight"><?php echo e(runtimeDate($lead->lead_created)); ?></span>
            <?php endif; ?>
        </div>

        <!--category-->
        <div class="x-element" id="card-lead-category"><i class="mdi mdi-folder"></i>
            <span><?php echo e(cleanLang(__('lang.category'))); ?>:
            </span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable js-card-settings-button-static" data-container=".card-modal" id="card-lead-category-text"
                tabindex="0" data-popover-content="card-lead-category-popover"
                data-title="<?php echo e(cleanLang(__('lang.status'))); ?>"><?php echo e(runtimeLang($lead->category_name)); ?></strong></span>
            <?php else: ?>
            <span class="x-highlight"><?php echo e(runtimeLang($lead->category_name)); ?></span>
            <?php endif; ?>
        </div>
        <!--last contacted-->
        <div class="x-element" id="lead-contacted"><i class="mdi mdi-message-text"></i>
            <span><?php echo e(cleanLang(__('lang.contacted'))); ?>:
            </span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable card-pickadate"
                data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-contacted/')); ?>" data-type="form"
                data-progress-bar='hidden' data-form-id="lead-contacted" data-hidden-field="lead_last_contacted"
                data-container="lead-contacted-container" data-ajax-type="post"
                id="lead-contacted-container"><?php echo e(runtimeDate($lead->lead_last_contacted)); ?></span>
            <input type="hidden" name="lead_last_contacted" id="lead_last_contacted">
            <?php else: ?>
            <span class="x-highlight"><?php echo e(runtimeDate($lead->lead_last_contacted)); ?></span>
            <?php endif; ?>
        </div>
        <!--telephone-->
        <div class="x-element"><i class="mdi mdi-phone"></i> <span><?php echo e(cleanLang(__('lang.telephone'))); ?>: </span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable js-card-settings-button-static" data-container=".card-modal" id="card-lead-phone" tabindex="0"
                data-popover-content="card-lead-phone-popover" data-value="<?php echo e($lead->lead_phone); ?>"
                data-title="<?php echo e(cleanLang(__('lang.telephone'))); ?>"><?php echo e($lead->lead_phone ?? '---'); ?></span>
            <?php else: ?>
            <span class="x-highlight"><?php echo e($lead->lead_phone ?? '---'); ?></span>
            <?php endif; ?>
        </div>

        <!--email-->
        <div class="x-element"><i class="mdi mdi-email"></i> <span><?php echo e(cleanLang(__('lang.email'))); ?>: </span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable js-card-settings-button-static" data-container=".card-modal" id="card-lead-email" tabindex="0"
                data-popover-content="card-lead-email-popover" data-value="<?php echo e($lead->lead_email); ?>"
                data-title="<?php echo e(cleanLang(__('lang.email'))); ?>"><?php echo e($lead->lead_email ?? '---'); ?></span>
            <?php else: ?>
            <span class="x-highlight"><?php echo e($lead->lead_email ?? '---'); ?></span>
            <?php endif; ?>
        </div>

        <!--Source-->
        <div class="x-element" id="card-lead-source"><i class="mdi mdi-magnify-plus"></i>
            <span><?php echo e(cleanLang(__('lang.source'))); ?>:
            </span>
            <?php if($lead->permission_edit_lead): ?>
            <span class="x-highlight x-editable js-card-settings-button-static" data-container=".card-modal" id="card-lead-source-text" tabindex="0"
                data-popover-content="card-lead-source-popover"
                data-title="<?php echo e(cleanLang(__('lang.source'))); ?>"><?php echo e($lead->lead_source ?? '---'); ?></strong></span>
            <?php else: ?>
            <span class="x-highlight"><?php echo e($lead->lead_source ?? '---'); ?></span>
            <?php endif; ?>
        </div>


        <!--reminder-->
        <?php if(config('visibility.modules.reminders')): ?>
        <div class="card-reminders-container" id="card-reminders-container">
            <?php echo $__env->make('pages.reminders.cards.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php endif; ?>

    </div>




    <!----------tags----------->
    <div class="card-tags-container" id="card-tags-container">
        <?php echo $__env->make('pages.lead.components.tags', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>


    <!----------actions----------->
    <div class="x-section">
        <div class="x-title">
            <h6><?php echo e(cleanLang(__('lang.actions'))); ?></h6>
        </div>
        <!--convert to customer-->
        <?php if($lead->permission_edit_lead && $lead->lead_converted == 'no'): ?>
        <div class="x-element x-action js-lead-convert-to-customer" id="card-lead-milestone" tabindex="0"
             data-url="<?php echo e(url('leads/'.$lead->lead_id.'/convert-details')); ?>"
            data-popover-content="card-lead-milestones" data-title="<?php echo e(cleanLang(__('lang.convert_to_customer'))); ?>"><i
                class="mdi mdi-redo-variant"></i>
            <span class="x-highlight"><?php echo app('translator')->get('lang.convert_to_customer'); ?></strong></span>
        </div>
        <?php endif; ?>

        <!--archive-->
        <?php if($lead->permission_edit_lead && runtimeArchivingOptions()): ?>
        <div class="x-element x-action confirm-action-info  <?php echo e(runtimeActivateOrAchive('archive-button', $lead->lead_active_state)); ?> card_archive_button_<?php echo e($lead->lead_id); ?>"
            id="card_archive_button_<?php echo e($lead->lead_id); ?>" data-confirm-title="<?php echo e(cleanLang(__('lang.archive_lead'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
            data-url="<?php echo e(url('/')); ?>/leads/<?php echo e($lead->lead_id); ?>/archive"><i class="mdi mdi-archive"></i> <span
                class="x-highlight" id="lead-start-date"><?php echo e(cleanLang(__('lang.archive'))); ?></span></span></div>
        <?php endif; ?>

        <!--restore-->
        <?php if($lead->permission_edit_lead && runtimeArchivingOptions()): ?>
        <div class="x-element x-action confirm-action-info  <?php echo e(runtimeActivateOrAchive('activate-button', $lead->lead_active_state)); ?> card_restore_button_<?php echo e($lead->lead_id); ?>"
            id="card_restore_button_<?php echo e($lead->lead_id); ?>" data-confirm-title="<?php echo e(cleanLang(__('lang.restore_lead'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
            data-url="<?php echo e(url('/')); ?>/leads/<?php echo e($lead->lead_id); ?>/activate"><i class="mdi mdi-archive"></i> <span
                class="x-highlight" id="lead-start-date"><?php echo e(cleanLang(__('lang.restore'))); ?></span></span></div>
        <?php endif; ?>


        <!--delete-->
        <?php if($lead->permission_delete_lead): ?>
        <div class="x-element x-action confirm-action-danger"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
            data-url="<?php echo e(url('/')); ?>/leads/<?php echo e($lead->lead_id); ?>"><i class="mdi mdi-delete"></i> <span
                class="x-highlight" id="lead-start-date"><?php echo e(cleanLang(__('lang.delete'))); ?></span></span></div>
        <?php endif; ?>
    </div>

    <!----------meta infor----------->
    <div class="x-section">
        <div class="x-title">
            <h6><?php echo e(cleanLang(__('lang.information'))); ?></h6>
        </div>
        <div class="x-element x-action">
            <table class=" table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.lead_id'))); ?></td>
                        <td><strong>#<?php echo e($lead->lead_id); ?></strong></td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.created_by'))); ?></td>
                        <td><strong><?php echo e($lead->first_name); ?> <?php echo e($lead->last_name); ?></strong></td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.date_created'))); ?></td>
                        <td><strong><?php echo e(runtimeDate($lead->lead_created)); ?></strong></td>
                    </tr>
                    <?php if($lead->lead_converted == 'yes'): ?>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.converted'))); ?></td>
                        <td><strong><?php echo e(runtimeDate($lead->lead_converted_date)); ?></strong></td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.converted_by'))); ?></td>
                        <td><strong><?php echo e($lead->converted_by_first_name); ?>

                                <?php echo e($lead->converted_by_last_name); ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.client_id'))); ?></td>
                        <td><strong><a
                                    href="<?php echo e(url('client/'.$lead->lead_converted_clientid)); ?>">#<?php echo e($lead->lead_converted_clientid); ?></a></strong>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>




    <!----------------------------------------------------- components-------------------------------------------------------->

    <!--lead - contact name -->
    <div class="hidden" id="card-lead-name-popover">
        <div class="form-group row m-b-10">
            <label
                class="col-sm-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.first_name'))); ?></label>
            <div class="col-sm-12 ">
                <input type="text" class="form-control form-control-sm" id="lead_firstname" name="lead_firstname"
                    placeholder="">
            </div>
        </div>
        <div class="form-group row m-b-10">
            <label
                class="col-sm-12 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.last_name'))); ?></label>
            <div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="lead_lastname" name="lead_lastname"
                    placeholder="">
            </div>
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-name-button"
                data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-name')); ?>"
                data-type="form" data-ajax-type="post" data-form-id="popover-body">
                <?php echo e(cleanLang(__('lang.update'))); ?>

            </button>
        </div>
    </div>

    <!--lead - value -->
    <div class="hidden" id="card-lead-value-popover">
        <div class="form-group row m-b-10">
            <div class="col-sm-12 ">
                <input type="number" class="form-control form-control-sm" id="lead_value" name="lead_value"
                    placeholder="">
            </div>
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-value-button"
                data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-value')); ?>"
                data-type="form" data-ajax-type="post" data-form-id="popover-body">
                <?php echo e(cleanLang(__('lang.update'))); ?>

            </button>
        </div>
    </div>


    <!--lead status - popover -->
    <div class="hidden" id="card-lead-status-popover">
        <div class="form-group m-t-10">
            <select class="custom-select col-12 form-control form-control-sm" id="lead_status" name="lead_status">
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statuse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($statuse->leadstatus_id); ?>">
                    <?php echo e(runtimeLang($statuse->leadstatus_title)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="hidden" id="current_lead_status_text" name="current_lead_status_text" value="">
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-status-button"
                data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-status')); ?>"
                data-type="form" data-ajax-type="post" data-form-id="popover-body">
                <?php echo e(cleanLang(__('lang.update'))); ?>

            </button>
        </div>
    </div>


    <!--lead category - popover -->
    <div class="hidden" id="card-lead-category-popover">
        <div class="form-group m-t-10">
            <select class="custom-select col-12 form-control form-control-sm" id="lead_categoryid"
                name="lead_categoryid">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->category_id); ?>">
                    <?php echo e(runtimeLang($category->category_name)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="hidden" id="current_lead_category_text" name="current_lead_category_text" value="">
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-category-button"
                data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-category')); ?>"
                data-type="form" data-ajax-type="post" data-form-id="popover-body">
                <?php echo e(cleanLang(__('lang.update'))); ?>

            </button>
        </div>
    </div>



    <!--lead - phone -->
    <div class="hidden" id="card-lead-phone-popover">
        <div class="form-group row m-b-10">
            <div class="col-sm-12 ">
                <input type="text" class="form-control form-control-sm" id="lead_phone" name="lead_phone"
                    placeholder="">
            </div>
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-phone-button"
                data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-phone')); ?>"
                data-type="form" data-ajax-type="post" data-form-id="popover-body">
                <?php echo e(cleanLang(__('lang.update'))); ?>

            </button>
        </div>
    </div>

    <!--lead - email -->
    <div class="hidden" id="card-lead-email-popover">
        <div class="form-group row m-b-10">
            <div class="col-sm-12 ">
                <input type="text" class="form-control form-control-sm" id="lead_email" name="lead_email"
                    placeholder="">
            </div>
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-email-button"
                data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-email')); ?>"
                data-type="form" data-ajax-type="post" data-form-id="popover-body">
                <?php echo e(cleanLang(__('lang.update'))); ?>

            </button>
        </div>
    </div>

    <!--lead source - popover -->
    <div class="hidden" id="card-lead-source-popover">
        <div class="form-group m-t-10">
            <?php if(config('system.settings_leads_allow_new_sources') == 'yes'): ?>
            <input type="text" name="lead_source" id="lead_source" class="col-12 form-control form-control-sm"
                list="sources">
            <datalist id="sources">
                <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($source->leadsources_title); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </datalist>
            <?php else: ?>
            <select class="custom-select col-12 form-control form-control-sm" id="lead_source" name="lead_source">
                <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($source->leadsources_title); ?>">
                    <?php echo e(runtimeLang($source->leadsources_title)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php endif; ?>

        </div>
        <?php if($lead->permission_edit_lead): ?>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-source-button"
                data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-source')); ?>"
                data-type="form" data-ajax-type="post" data-form-id="popover-body">
                <?php echo e(cleanLang(__('lang.update'))); ?>

            </button>
        </div>
        <?php endif; ?>
    </div>


    <!--assign user-->
    <div class="hidden" id="card-lead-team">
        <div class="card-assigned-popover-content">
            <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check m-b-15">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" name="assigned[<?php echo e($staff->id); ?>]"
                        class="custom-control-input  assigned_user_<?php echo e($staff->id); ?>">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"><img
                            src="<?php echo e(getUsersAvatar($staff->avatar_directory, $staff->avatar_filename)); ?>"
                            class="img-circle avatar-xsmall"> <?php echo e($staff->first_name); ?> <?php echo e($staff->last_name); ?></span>
                </label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group text-right">
                <button type="button" class="btn btn-danger btn-sm" id="card-leads-update-assigned"
                    data-progress-bar='hidden' data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/update-assigned')); ?>"
                    data-type="form" data-ajax-type="post" data-form-id="popover-body">
                    <?php echo e(cleanLang(__('lang.update'))); ?>

                </button>
            </div>
        </div>
    </div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/rightpanel.blade.php ENDPATH**/ ?>