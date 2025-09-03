<!-- Todays Payments -->
<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body p-l-15 p-r-15">
            <div class="d-flex p-10 no-block">
                <span class="align-slef-center">
                    <h2 class="m-b-0"><?php echo e($payload['tasks']['completed']); ?></h2>
                    <h6 class="text-muted m-b-0"><?php echo e(cleanLang(__('lang.tasks'))); ?> - <?php echo e(cleanLang(__('lang.completed'))); ?></h6>
                </span>
                <div class="align-self-center display-6 ml-auto"><i class="text-warning sl-icon-clock"></i>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-warning w-100 h-px-3" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/home/team/widgets/first-row/tasks-feedback.blade.php ENDPATH**/ ?>