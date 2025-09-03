<!--CRUMBS CONTAINER (LEFT)-->
<div class="col-md-12 <?php echo e(runtimeCrumbsColumnSize($page['crumbs_col_size'] ?? '')); ?> align-self-center <?php echo e($page['crumbs_special_class'] ?? ''); ?>" id="breadcrumbs">
    <h3 class="text-themecolor"><?php echo e($page['heading']); ?></h3>
    <!--crumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo e(cleanLang(__('lang.app'))); ?></li>
        <?php if(isset($page['crumbs'])): ?>
        <?php $__currentLoopData = $page['crumbs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <li class="breadcrumb-item <?php if($loop->last): ?> active active-bread-crumb <?php endif; ?>"><?php echo e($title ?? ''); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <!--filtered results label-->
        <?php if(request('filtered_results')): ?>
        <li class="m-t-3" id="clear_preset_filter_button_container">
            <div class="btn-group display-inline-block">
                <button type="button" class="btn btn-sm btn-warning dropdown-toggle display-inline-block font-10 m-l-8 p-0 p-l-10 p-r-10" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <?php echo app('translator')->get('lang.filtered_results'); ?>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item font-13 ajax-request" href="javascript:void(0);" id="clear_preset_filter_button"
                    data-url="<?php echo e(urlResource(request('filtered_url'))); ?>"><?php echo app('translator')->get('lang.clear_filter'); ?></a>
                </div>
            </div>
        </li>
        <?php endif; ?>
    </ol>
    <!--crumbs-->
</div>

<!--include various checkbox actions-->

<?php if(isset($page['page']) && $page['page'] == 'files'): ?>
<?php echo $__env->make('pages.files.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(isset($page['page']) && $page['page'] == 'notes'): ?>
<?php echo $__env->make('pages.notes.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/misc/heading-crumbs.blade.php ENDPATH**/ ?>