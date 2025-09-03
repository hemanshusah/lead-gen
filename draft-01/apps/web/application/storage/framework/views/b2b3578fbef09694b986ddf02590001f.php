<?php $__currentLoopData = $board['leads']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each card-->
<div class="kanban-card show-modal-button reset-card-modal-form js-ajax-ux-request <?php echo e($lead->pinned_status ?? ''); ?>"
    data-toggle="modal" data-target="#cardModal" data-url="<?php echo e(urlResource('/leads/'.$lead->lead_id)); ?>"
    data-lead-id="<?php echo e($lead->lead_id); ?>" data-loading-target="main-top-nav-bar" id="card_lead_<?php echo e($lead->lead_id); ?>">
    <!--cover image-->
    <div id="kanban-card-cover-image-<?php echo e($lead->lead_id); ?>"
        class="kanban-card-cover-image <?php echo e(runtimeKanbanCoverImage($lead->lead_cover_image)); ?>" <?php echo runtimeCoverImage($lead->lead_cover_image_uniqueid, $lead->lead_cover_image_filename); ?>>

    </div>
    <div class="kanban-card-content-comntainer">
        <div class="x-title wordwrap" id="kanban_lead_title_<?php echo e($lead->lead_id); ?>"><?php echo e($lead->lead_title); ?>

            <span class="x-action-button" id="card-action-button-<?php echo e($lead->lead_id); ?>" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></span>
            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right js-stop-propagation"
                aria-labelledby="card-action-button-<?php echo e($lead->lead_id); ?>">
                <?php $count_actions = 0 ; ?>

                <!--send email-->
                <a class="dropdown-item data-toggle-action-tooltip edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(url('/appwebmail/compose?view=modal&webmail_template_type=leads&resource_type=lead&resource_id='.$lead->lead_id)); ?>"
                    data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.send_email'); ?>"
                    data-action-url="<?php echo e(url('/appwebmail/send')); ?>" data-action-method="POST" data-modal-size="modal-xl"
                    data-action-ajax-loading-target="leads-td-container">
                    <?php echo app('translator')->get('lang.send_email'); ?>
                </a>

                <!--delete-->
                <?php if($lead->permission_delete_lead): ?>
                <a class="dropdown-item confirm-action-danger js-stop-propagation"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                    data-url="<?php echo e(url('/')); ?>/leads/<?php echo e($lead->lead_id); ?>"><?php echo e(cleanLang(__('lang.delete'))); ?></a>
                <?php $count_actions ++ ; ?>
                <?php endif; ?>


                <!--clone lead (team only)-->
                <?php if($lead->permission_edit_lead): ?>
                <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal" data-modal-title="<?php echo app('translator')->get('lang.clone_lead'); ?>"
                    data-url="<?php echo e(urlResource('/leads/'.$lead->lead_id.'/clone')); ?>"
                    data-action-url="<?php echo e(urlResource('/leads/'.$lead->lead_id.'/clone')); ?>" data-modal-size="modal-lg"
                    data-loading-target="commonModalBody" data-action-method="POST" aria-expanded="false">
                    <?php echo app('translator')->get('lang.clone_lead'); ?>
                </a>
                <?php $count_actions ++ ; ?>
                <?php endif; ?>

                <!--archive-->
                <?php if($lead->permission_edit_lead && runtimeArchivingOptions()): ?>
                <a class="dropdown-item confirm-action-info  <?php echo e(runtimeActivateOrAchive('archive-button', $lead->lead_active_state)); ?> card_archive_button_<?php echo e($lead->lead_id); ?>"
                    id="card_archive_button_<?php echo e($lead->lead_id); ?>"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.archive_lead'))); ?>"
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
                    data-url="<?php echo e(urlResource('/leads/'.$lead->lead_id.'/archive')); ?>">
                    <?php echo e(cleanLang(__('lang.archive'))); ?>

                </a>
                <?php $count_actions ++ ; ?>
                <?php endif; ?>

                <!--activate-->
                <?php if($lead->permission_edit_lead && runtimeArchivingOptions()): ?>
                <a class="dropdown-item confirm-action-info <?php echo e(runtimeActivateOrAchive('activate-button', $lead->lead_active_state)); ?> card_restore_button_<?php echo e($lead->lead_id); ?>"
                    id="card_restore_button_<?php echo e($lead->lead_id); ?>"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.restore_lead'))); ?>"
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
                    data-url="<?php echo e(urlResource('/leads/'.$lead->lead_id.'/activate')); ?>">
                    <?php echo e(cleanLang(__('lang.restore'))); ?>

                </a>
                <?php $count_actions ++ ; ?>
                <?php endif; ?>

                <!--no actions-->
                <?php if($count_actions == 0): ?>
                <a class="dropdown-item js-stop-propagation"
                    href="javascript:void(0);"><?php echo e(cleanLang(__('lang.no_actions_available'))); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="x-meta">
            <!--name-->
            <label class="label label-outline-default p-t-3 p-b-3 p-r-8 p-l-8"><?php echo e($lead->lead_firstname); ?>

                <?php echo e($lead->lead_lastname); ?></label>
            <!--value-->
            <?php if(config('system.settings_leads_kanban_value') == 'show'): ?>
            <div><label
                    class="label label-light-info p-t-3 p-b-3 p-r-8 p-l-8"><?php echo e(runtimeMoneyFormat($lead->lead_value)); ?></label>
            </div>
            <?php endif; ?>

            <!--tags-->
            <?php if(config('system.settings_leads_kanban_tags') == 'show'): ?>
            <div class="wrap-words">
                <?php $__currentLoopData = $lead->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="label label-light-primary p-t-3 p-b-3 p-r-8 p-l-8"><?php echo e($lead_tag->tag_title); ?></label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>


            <!--telephone-->
            <?php if(config('system.settings_leads_kanban_telephone') == 'show'): ?>
            <span class="wordwrap"><strong><?php echo e(cleanLang(__('lang.telephone'))); ?>:</strong>
                <?php echo e($lead->lead_phone ?? '---'); ?></span>
            <?php endif; ?>
            <!--date created-->
            <?php if(config('system.settings_leads_kanban_date_created') == 'show'): ?>
            <span><strong><?php echo e(cleanLang(__('lang.created'))); ?>:</strong> <?php echo e(runtimeDate($lead->lead_created)); ?></span>
            <?php endif; ?>
            <!--date contacted-->
            <?php if(config('system.settings_leads_kanban_date_contacted') == 'show'): ?>
            <span><strong><?php echo e(cleanLang(__('lang.contacted'))); ?>:</strong>
                <?php echo e(runtimeDate($lead->lead_last_contacted )); ?></span>
            <?php endif; ?>
            <!--category-->
            <?php if(config('system.settings_leads_kanban_category') == 'show'): ?>
            <span><strong><?php echo e(cleanLang(__('lang.category'))); ?>:</strong> <?php echo e($lead->category_name ?? '---'); ?></span>
            <?php endif; ?>
            <!--email-->
            <?php if(config('system.settings_leads_kanban_email') == 'show'): ?>
            <span class="wordwrap"><strong><?php echo e(cleanLang(__('lang.email'))); ?>:</strong>
                <?php echo e($lead->lead_email ?? '---'); ?></span>
            <?php endif; ?>
            <!--source-->
            <?php if(config('system.settings_leads_kanban_source') == 'show'): ?>
            <span class="wordwrap"><strong><?php echo e(cleanLang(__('lang.source'))); ?>:</strong>
                <?php echo e($lead->lead_source ?? '---'); ?></span>
            <?php endif; ?>

            <!--show enabled custom fields-->
            <?php $__currentLoopData = $lead->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($field->customfields_show_lead_summary == 'yes'): ?>
            <span><strong><?php echo e($field->customfields_title); ?>:</strong>:
                <?php echo e(strip_tags(customFieldValue($field->customfields_name, $lead, $field->customfields_datatype))); ?></span>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!--reminder-->
            <?php if(config('system.settings_leads_kanban_reminder') == 'show'): ?>
            <div class="wrap-words" id="reminder_card_view_container_<?php echo e($lead->lead_id ?? ''); ?>">
                <?php $__currentLoopData = $lead->reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--only show current users reminders-->
                <?php if($reminder->reminder_userid == auth()->user()->id): ?>
                <?php echo $__env->make('pages.reminders.cards.kanban', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

        </div>
        <div class="x-footer row">
            <div class="col-6 x-icons">

                <!--pin-->
                <span title="<?php echo e(cleanLang(__('lang.pinning'))); ?>" data-parent="lead_<?php echo e($lead->lead_id); ?>"
                    data-url="<?php echo e(url('/leads/'.$lead->lead_id.'/pinning')); ?>"
                    class="x-icon display-inline-block vm p-t-2 data-toggle-action-tooltip opacity-4 js-toggle-pinning font-14">
                    <i class="ti-pin2"></i>
                </span>

                <!--captured via a webform-->
                <?php if($lead->lead_input_source == 'webform'): ?>
                <span class="x-icon" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.source_webform'); ?>"><i
                        class="sl-icon-cloud-upload"></i></span>
                <?php endif; ?>

                <!--created by you-->
                <?php if($lead->lead_creatorid == auth()->user()->id): ?>
                <span class="x-icon text-info" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.you_created_this_lead'); ?>"
                    data-placement="top"><i class="mdi mdi-account-circle"></i></span>
                <?php endif; ?>


                <!--converted-->
                <?php if($lead->lead_converted == 'yes'): ?>
                <span class="x-icon text-success"><i class="mdi mdi-star" data-toggle="tooltip"
                        title="<?php echo e(cleanLang(__('lang.customer'))); ?>"></i></span>
                <?php endif; ?>

                <!--archived-->
                <?php if(runtimeArchivingOptions()): ?>
                <span class="x-icon <?php echo e(runtimeActivateOrAchive('archived-icon', $lead->lead_active_state)); ?>"
                    id="archived_icon_<?php echo e($lead->lead_id); ?>" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.archived'); ?>"><i
                        class="ti-archive font-15"></i></span>
                <?php endif; ?>

                <!--attachments-->
                <?php if($lead->has_attachments): ?>
                <span class="x-icon"><i class="mdi mdi-attachment"></i>
                    <?php if($lead->count_unread_attachments > 0): ?>
                    <span class="x-notification" id="card_notification_attachment_<?php echo e($lead->lead_id); ?>"></span>
                    <?php endif; ?>
                </span>
                <?php endif; ?>
                <!--comments-->
                <?php if($lead->has_comments): ?>
                <span class="x-icon"><i class="mdi mdi-comment-text-outline"></i>
                    <?php if($lead->count_unread_comments > 0): ?>
                    <span class="x-notification" id="card_notification_comment_<?php echo e($lead->lead_id); ?>"></span>
                    <?php endif; ?>
                </span>
                <?php endif; ?>
                <!--checklists-->
                <?php if($lead->has_checklist): ?>
                <span class="x-icon"><i class="mdi mdi-checkbox-marked-outline"></i></span>
                <?php endif; ?>

            </div>
            <div class="col-6 x-assigned">
                <?php $__currentLoopData = $lead->assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(getUsersAvatar($user->avatar_directory, $user->avatar_filename)); ?>" data-toggle="tooltip"
                    title="" data-placement="top" alt="<?php echo e($user->first_name); ?>" class="img-circle avatar-xsmall"
                    data-original-title="<?php echo e($user->first_name); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/leads/components/kanban/card.blade.php ENDPATH**/ ?>