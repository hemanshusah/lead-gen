<div class="col-lg-8  col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(cleanLang(__('lang.latest_activity'))); ?></h5>
            <div class="dashboard-events profiletimeline" id="dashboard-admin-events">
                <?php $events = $payload['all_events'] ; ?>
                <?php echo $__env->make('pages.timeline.components.misc.ajax', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <!--load more-->
        </div>
    </div>
</div><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/home/admin/widgets/third-row/events.blade.php ENDPATH**/ ?>