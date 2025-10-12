    <!-- Column -->
    <div class="col-lg-4 col-md-12" id="dashboard-widgets-leads">
        <div class="card">
            <div class="card-body">
                <div class="d-flex m-b-30 no-block">
                    <h5 class="card-title m-b-0 align-self-center"><?php echo e(cleanLang(__('lang.leads'))); ?></h5>
                    <div class="ml-auto">
                        <?php echo e(cleanLang(__('lang.this_year'))); ?>

                    </div>
                </div>
                <div id="leadsWidget"></div>
                <ul class="list-inline m-t-30 text-center font-12">
                    <?php $__currentLoopData = config('home.lead_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="p-b-10"><span class="label <?php echo e($lead_status['label']); ?> label-rounded"><i class="fa fa-circle <?php echo e($lead_status['color']); ?>"></i> <?php echo e($lead_status['title']); ?></span></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>

    <!--[DYNAMIC INLINE SCRIPT]  Backend Variables to Javascript Variables-->
    <script>
        NX.admin_home_c3_leads_data = JSON.parse('<?php echo clean($payload["leads_stats"]); ?>', true);
        NX.admin_home_c3_leads_colors = JSON.parse('<?php echo clean($payload["leads_key_colors"]); ?>', true);
        NX.admin_home_c3_leads_title = "<?php echo e($payload['leads_chart_center_title']); ?>";
    </script><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/home/admin/widgets/second-row/leads.blade.php ENDPATH**/ ?>