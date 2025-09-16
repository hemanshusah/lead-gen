<div class="chat-left-aside menu-closed">
    <div class="open-panel"><i class="ti-angle-right"></i></div>
    <div class="chat-left-inner" id="chat-left-inner">
        <ul class="chatonline style-none" id="messages-left-menu">
            <!--team-->
            <li id="<?php echo e(messagesUniqueID(auth()->user()->unique_id, 'team')); ?>">
                <a href="javascript:void(0)" class="ajax-request messages-menu-link active" data-type="form"
                    id="messages_team_link"
                    data-form-id="<?php echo e(messagesUniqueID(auth()->user()->unique_id, 'team')); ?>"
                    data-ajax-type="post" data-loading-target="chat-messages-container"
                    data-message-target="team" data-progress-bar="hidden"
                    data-counter-id="messages_counter_team" data-url="<?php echo e(url('/messages/feed?action=load')); ?>">
                    <img src="<?php echo e(url('public/images/team.png')); ?>" alt="user-img" class="img-circle">
                    <span><?php echo app('translator')->get('lang.team'); ?>
                        <small class="text-info messages_user_status text-lc"><?php echo app('translator')->get('lang.all_team_members'); ?>
                            <!--counter-->
                            <span class="badge badge-pill badge-danger messages_counter hidden"
                                id="messages_counter_team">
                                <!--dynamic--></span>
                        </small>
                    </span>
                </a>
                <!--(dynamic)-->
                <input type="hidden" name="message_source" value="<?php echo e(auth()->user()->unique_id); ?>">
                <input type="hidden" name="message_target" value="team">
                <input type="hidden" name="message_load" value="initial">
            </li>
            <!-- users list-->
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($user->id != auth()->user()->id): ?>
            <li id="<?php echo e(messagesUniqueID(auth()->user()->unique_id, $user->unique_id)); ?>">
                <a href="javascript:void(0)" class="ajax-request messages-menu-link" data-type="form"
                    data-form-id="<?php echo e(messagesUniqueID(auth()->user()->unique_id, $user->unique_id)); ?>"
                    data-ajax-type="post" data-loading-target="chat-messages-container"
                    data-progress-bar="hidden" data-message-target="<?php echo e($user->unique_id); ?>"
                    data-counter-id="<?php echo e(messagesCounterUniqueID($user->unique_id)); ?>"
                    data-url="<?php echo e(url('/messages/feed?action=load')); ?>">
                    <img src="<?php echo e($user->avatar); ?>" alt="user-img" class="img-circle">
                    <span><?php echo e($user->full_name); ?>

                        <small id="user_status_<?php echo e($user->id); ?>"
                            class="<?php echo e(runtimeMessagesUserStatus($user->is_online, 'label')); ?> messages_user_status text-lc">
                            <!--status-->
                            <span class="message_status_label" id="user_status_lang_<?php echo e($user->id); ?>"><?php echo e(runtimeMessagesUserStatus($user->is_online, 'lang')); ?></span>
                            <!--counter-->
                            <span class="badge badge-pill badge-danger messages_counter hidden"
                                id="<?php echo e(messagesCounterUniqueID($user->unique_id)); ?>">
                                <!--dynamic--></span>
                        </small></span></a>
                <!--(dynamic)-->
                <input type="hidden" name="message_source" value="<?php echo e(auth()->user()->unique_id); ?>">
                <input type="hidden" name="message_target" value="<?php echo e($user->unique_id); ?>">
                <input type="hidden" name="message_load" value="initial">
            </li>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <li class="p-20"></li>
        </ul>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/messages/components/left-panel.blade.php ENDPATH**/ ?>