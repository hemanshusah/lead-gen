<a tabindex="0" data-trigger="focus" data-toggle="popover" data-html="true" data-placement="top" data-offset="0 4"
    data-content="
                         <div class='title'><?php echo e($more_users_title ?? __('lang.users')); ?></div>
                         <div class='text-center'>

                         <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <!--each user-->
                         <img src='<?php echo e($user->avatar); ?>' data-toggle='tooltip' title='<?php echo e($user->first_name); ?>'
                             data-placement='top' alt='<?php echo e($user->first_name); ?>' class='img-circle avatar-xsmall'>
                         <!--each user-->   
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </div>">
    <span class="btn btn-secondary btn-circle btn-sm more-users">
        <i class="ti-more"></i>
    </span>
</a><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/misc/more-users.blade.php ENDPATH**/ ?>