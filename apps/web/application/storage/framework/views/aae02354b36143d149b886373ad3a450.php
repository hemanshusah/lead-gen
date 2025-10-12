<?php if(count($events ?? []) >0): ?>
<?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(is_numeric($event->event_id)): ?>
<div class="display-flex flex-row topevent" id="event_<?php echo e($event->event_id); ?>">
    <!--avatar-->
    <div class="">
        <img src="<?php echo e(getUsersAvatar($event->avatar_directory, $event->avatar_filename, $event->event_creatorid)); ?>"
            class="avatar img-circle" alt="user" width="35">
    </div>
    <div class="x-content">
        <!--user-->
        <div class="x-name clearfix">
            <?php if($event->event_creatorid == 0 || $event->event_creatorid == -1): ?>
            <?php if($event->event_creatorid == 0): ?>
            <?php echo e(cleanLang(__('lang.system_bot_name'))); ?>

            <?php else: ?>
            <!--non registered users-->
            <?php echo e($event->event_creator_name); ?>

            <?php endif; ?>
            <?php else: ?>
            <?php echo e($event->first_name ?? runtimeUnkownUser()); ?>

            <?php endif; ?>
            <!--mark as read-->
            <span class="pull-right js-notification-mark-read-single" id="fx-top-nav-mark-read"
                data-container="event_<?php echo e($event->event_id); ?>" data-progress-bar='hidden'
                data-url="<?php echo e(url('events/'.$event->event_id.'/mark-read-my-event')); ?>">
                <?php if($event->eventtracking_status == 'unread'): ?>
                <input name="group4" type="radio" id="event_checkbox_<?php echo e($event->event_id); ?>" class="radio-col-info">
                <label for="event_checkbox_<?php echo e($event->event_id); ?>"></label>
                <?php endif; ?>
            </span>
            <span class="x-time pull-right muted"><?php echo e(runtimeDateAgo($event->event_created)); ?></span></div>
        <!--main title-->
        <div class="x-title"><span><?php echo e(runtimeLang($event->event_item_lang)); ?></span>
        </div>
        <!--parent link-->
        <div class="x-ref-title">
            <?php echo $__env->make('pages.events.includes.parent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!--sub content-->
        <?php if($event->event_show_item == 'yes'): ?>
        <?php echo $__env->make('pages.events.includes.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<div class="top-nav-no-evenets">
    <img src="<?php echo e(url('/')); ?>/public/images/relax.png" alt="No events found" />
    <div class="x-message"><?php echo e(cleanLang(__('lang.no_notifications_found'))); ?></div>
</div>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/events/topnav.blade.php ENDPATH**/ ?>