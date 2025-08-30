<!--task resources (comment|checklists|files)-->
<?php if($event->event_parent_type == 'task'): ?>
<a href="<?php echo e(url('/tasks/v/'.$event->event_parent_id.'/'.str_slug($event->event_parent_title))); ?>">
        (<?php echo e(runtimeLang($event->event_parent_type)); ?>

        #<?php echo e($event->event_parent_id); ?>) -
        <?php echo e($event->event_parent_title); ?></a>
<?php endif; ?>


<!--task (actual)-->
<?php if($event->event_parent_type == 'project' && $event->event_item == 'task'): ?>
<div class="x-reference">
        <a href="<?php echo e(_url('projects/'.$event->event_parent_id.'/tasks')); ?>"> (<?php echo e(runtimeLang($event->event_parent_type)); ?>

                #<?php echo e($event->event_parent_id); ?>) -
                <?php echo e($event->event_parent_title); ?></a></div>
<?php endif; ?>


<!--lead (all event types)-->
<?php if($event->event_parent_type == 'lead'): ?>
<a href="<?php echo e(url('/leads/v/'.$event->event_parent_id.'/'.str_slug($event->event_parent_title))); ?>">
        (<?php echo e(runtimeLang($event->event_parent_type)); ?> #<?php echo e($event->event_parent_id); ?>) -
        <?php echo e($event->event_parent_title); ?></a>
<?php endif; ?>


<!--project (invoices)-->
<?php if($event->event_parent_type == 'project' && $event->event_item == 'invoice'): ?>
<div class="x-reference">
        <a href="<?php echo e(_url('projects/'.$event->event_parent_id.'/invoices')); ?>">
                (<?php echo e(runtimeLang($event->event_parent_type)); ?>

                #<?php echo e($event->event_parent_id); ?>) -
                <?php echo e($event->event_parent_title); ?></a></div>
<?php endif; ?>


<!--project (files)-->
<?php if($event->event_parent_type == 'project' && $event->event_item == 'file'): ?>
<div class="x-reference">
        <a href="<?php echo e(_url('projects/'.$event->event_parent_id.'/files')); ?>"> (<?php echo e(runtimeLang($event->event_parent_type)); ?>

                #<?php echo e($event->event_parent_id); ?>) -
                <?php echo e($event->event_parent_title); ?></a></div>
<?php endif; ?>


<!--project (estimates)-->
<?php if($event->event_parent_type == 'project' && $event->event_item == 'estimate'): ?>
<div class="x-reference">
        <a href="<?php echo e(_url('projects/'.$event->event_parent_id.'/estimates')); ?>">
                (<?php echo e(runtimeLang($event->event_parent_type)); ?>

                #<?php echo e($event->event_parent_id); ?>) -
                <?php echo e($event->event_parent_title); ?></a></div>
<?php endif; ?>


<!--project (comments)-->
<?php if($event->event_parent_type == 'project' && $event->event_item == 'comment'): ?>
<div class="x-reference">
        <a href="<?php echo e(_url('projects/'.$event->event_parent_id.'/comments')); ?>">
                (<?php echo e(runtimeLang($event->event_parent_type)); ?>

                #<?php echo e($event->event_parent_id); ?>) -
                <?php echo e($event->event_parent_title); ?></a></div>
<?php endif; ?>


<!--tickets-->
<?php if($event->event_item == 'ticket'): ?>
<div class="x-reference">
        <?php echo e($event->event_item_content2); ?></div>
<?php endif; ?>
<?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/events/includes/parent.blade.php ENDPATH**/ ?>