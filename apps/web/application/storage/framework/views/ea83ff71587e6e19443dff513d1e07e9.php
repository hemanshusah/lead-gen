<div class="card count-<?php echo e(@count($templates ?? [])); ?>" id="template-table-wrapper">
    <div class="card-body">
        <div class="table-responsive">
            <?php if(@count($templates ?? []) > 0): ?>
            <table id="template-proposal-addrow" class="table m-t-0 m-b-0 table-hover no-wrap" data-page-size="10">
                <thead>

                    <!--proposal_template_title-->
                    <th class="col_proposal_template_title"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_proposal_template_title" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/templates/proposals?action=sort&orderby=proposal_template_title&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.title'); ?><span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                    <!--proposal_template_created-->
                    <th class="col_proposal_template_created"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_proposal_template_created" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/templates/proposals?action=sort&orderby=proposal_template_created&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.date_created'); ?><span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                    <!--created by-->
                    <th class="col_created_by"><a class="js-list-sorting" id="sort_fooo"
                            href="javascript:void(0)"><?php echo app('translator')->get('lang.created_by'); ?></a></th>

                    <!--actions-->
                    <th class="col_proposals_actions w-px-120"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.actions'); ?></a>
                    </th>
                </thead>
                <tbody id="template-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.templates.proposals.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($templates ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/templates/proposals/components/table/table.blade.php ENDPATH**/ ?>