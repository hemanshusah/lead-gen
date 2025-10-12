<div class="col-lg-6  col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo e(cleanLang(__('lang.latest_activity'))); ?></h5>
            <div class="dashboard-events profiletimeline" id="dashboard-client-events">
                <?php $events = $payload['all_events'] ; ?>
                <?php echo $__env->make('pages.timeline.components.misc.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!--load more-->
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/home/team/widgets/second-row/events.blade.php ENDPATH**/ ?>