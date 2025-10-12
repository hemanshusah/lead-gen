<ul class="nav nav-tabs" role="tablist">
    <!--home-->
    <li class="nav-item"> <a class="nav-link active ajax-request" data-toggle="tab" href="javascript:void(0);"
            role="tab" data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/show-main?show=tab')); ?>"
            data-loading-class="loading-before-centre" data-loading-target="card-leads-left-panel"><span
                class="hidden-sm-up"><i class="ti-home"></i></span> <span
                class="hidden-xs-down"><?php echo app('translator')->get('lang.lead'); ?></span></a> </li>

                
    <!--organisation-->
    <li class="nav-item"> <a class="nav-link ajax-request" data-toggle="tab" href="javascript:void(0);" role="tab"
        data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/show-organisation')); ?>" data-loading-class="loading-before-centre"
        data-loading-target="card-leads-left-panel"><span class="hidden-sm-up"><i class="ti-id-badge"></i></span><span
            class="hidden-xs-down"><?php echo app('translator')->get('lang.address'); ?></span></a> </li>

    <!--customfields-->
    <li class="nav-item"> <a class="nav-link ajax-request" data-toggle="tab" href="javascript:void(0);" role="tab"
            data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/show-customfields')); ?>" data-loading-class="loading-before-centre"
            data-loading-target="card-leads-left-panel"><span class="hidden-sm-up"><i class="ti-menu"></i></span><span class="hidden-xs-down"><?php echo app('translator')->get('lang.information'); ?></span></a>
    </li>


    <!--my notes-->
    <li class="nav-item"> <a class="nav-link ajax-request" data-toggle="tab" href="javascript:void(0);" role="tab"
            data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/show-mynotes')); ?>" data-loading-class="loading-before-centre"
            data-loading-target="card-leads-left-panel"><span class="hidden-sm-up"><i class="ti-notepad"></i></span><span class="hidden-xs-down"><?php echo app('translator')->get('lang.my_notes'); ?></span></a>
    </li>

     <!--logs-->
     <li class="nav-item"> <a class="nav-link ajax-request" data-toggle="tab" href="javascript:void(0);" role="tab"
        data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/show-logs')); ?>" data-loading-class="loading-before-centre"
        data-loading-target="card-leads-left-panel"><span class="hidden-sm-up"><i class="ti-comment-alt"></i></span><span class="hidden-xs-down"><?php echo app('translator')->get('lang.log'); ?></span></a> </li>
</ul><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/content/tabmenu.blade.php ENDPATH**/ ?>