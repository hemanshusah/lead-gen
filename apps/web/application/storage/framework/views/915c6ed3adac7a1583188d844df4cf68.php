<div class="card count-<?php echo e(@count($projects ?? [])); ?>" id="projects-view-wrapper">
    <div class="card-body">
        <div class="table-responsive">
            <?php if(@count($projects ?? []) > 0): ?>
            <table class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <th class="projects_col_title"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_project_title" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/templates/projects?action=sort&orderby=project_title&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.title'))); ?></a>
                        </th>
                        <th class="projects_col_date"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.date_created'))); ?></a>
                        </th>
                        <th class="projects_col_category"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_category" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/templates/projects?action=sort&orderby=category&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.category'))); ?></a>
                    </th>
                        <th class="projects_col_createby"><a
                                href="javascript:void(0)"><?php echo e(cleanLang(__('lang.created_by'))); ?></a></th>
                        <th class="projects_col_action w-px-99"><a
                                href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="projects-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.templates.projects.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(@count($projects ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/templates/projects/components/table/table.blade.php ENDPATH**/ ?>