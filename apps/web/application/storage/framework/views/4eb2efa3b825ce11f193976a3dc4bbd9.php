 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!-- Page Title & Bread Crumbs -->
    <div class="row page-titles">

        <div class="col-md-12 col-lg-6 align-self-center">
            <h3 class="text-themecolor"><?php echo e($page['heading'] ?? ''); ?>

            </h3>
            <!--crumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo e(cleanLang(__('lang.app'))); ?></li>
                <li class="breadcrumb-item reports-breadcrumbs active"><?php echo app('translator')->get('lang.reports'); ?></li>
                <li class="breadcrumb-item reports-breadcrumbs hidden" id="reports-breadcrumbs-heading"><!--dynamic--></li>
                <li class="breadcrumb-item reports-breadcrumbs hidden" id="reports-breadcrumbs-sub-heading"><!--dynamic--></li>
            </ol>
            <!--crumbs-->
        </div>

        <!--filter panel-->
        <div class="col-md-12  col-lg-6 align-self-center text-right reports-list-page-actions-container"
            id="reports-list-page-actions-container">
            <div id="list-page-actions">
                <!--dynamic-->

            </div>
        </div>
    </div>

    <!--topnav-->
    <?php echo $__env->make('pages.reports.components.misc.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--topnav-->

    <!-- page content -->
    <div class="row m-t-10" id="reports-tab-single-screen">
        <!--dynamic ajax section-->
        <div class="col-lg-12">
            <div class="card min-h-400">
                <div class="tab-content">
                    <div class="tab-pane active ext-ajax-container" id="reportss_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                            <!--dynamic content here-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--page content -->
</div>
<!--main content -->

<!--ajax tab initial loading - summary-->
<span id="dynamic-reports-content" class="js-ajax-ux-request hidden" data-loading-target="embed-content-container"
    data-url="<?php echo e($page['dynamic_url'] ?? ''); ?>">
</span>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/reports/wrapper.blade.php ENDPATH**/ ?>