<!-- right-sidebar -->
<div class="right-sidebar sidebar-lg" id="sidepanel-canned-messages">
    <div class="slimscrollright">
        <!--title-->
        <div class="rpanel-title">
            <i class="sl-icon-speech"></i><?php echo e(cleanLang(__('lang.canned_messages'))); ?>

            <span>
                <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-items"></i>
            </span>
        </div>

        <!--body-->
        <div class="r-panel-body">

            <!--search-->
            <div class="form-group row">
                <div class="col-sm-12 col-lg-6" id="canned-search-form">
                    <div class="search-text-field">
                        <i class="sl-icon-magnifier"></i>
                        <input type="text" class="form-control form-control-sm search_canned" id="search_canned"
                            name="search_canned" data-type="form" data-ajax-type="post"
                            data-form-id="canned-search-form" data-url="<?php echo e(url('canned/search')); ?>"
                            placeholder="<?php echo app('translator')->get('lang.search'); ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6" id="canned-browse-form">
                    <select class="select2-basic form-control form-control-sm select2-preselected browse_canned"
                        data-type="form" data-ajax-type="post" data-form-id="canned-browse-form"
                        data-url="<?php echo e(url('canned/search')); ?>" id="browse_canned" name="browse_canned"
                        data-placeholder="Browse">
                        <option><?php echo app('translator')->get('lang.categories'); ?></option>
                        <?php $__currentLoopData = $canned_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->category_id); ?>"><?php echo e($category->category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="canned-reponses-container" id="canned-reponses-container">

                <?php if(count($canned_recently_used) > 0): ?>
                <h5 class="m-b-20 m-t-40"><?php echo app('translator')->get('lang.recently_used'); ?></h5>

                <?php $__currentLoopData = $canned_recently_used; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('pages.ticket.components.misc.canned', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                <div class="page-notification">
                    <img src="<?php echo e(url('/')); ?>/public/images/no-results-found.png" alt="404" />
                    <h4><?php echo app('translator')->get('lang.canned_no_recently_found'); ?></h4>
                    <h5><?php echo app('translator')->get('lang.canned_you_can_search_or_browse'); ?></h5>
                </div>
                <?php endif; ?>

            </div>
        </div>
        <!--body-->
    </div>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/ticket/components/misc/canned-side-panel.blade.php ENDPATH**/ ?>