<div class="board">
    <div class="board-body <?php echo e(runtimeKanbanBoardColors($board['color'])); ?>">
        <div class="board-heading clearfix">
            <div class="pull-left"><?php echo e(runtimeLang($board['name'])); ?></div>
            <div class="pull-right x-action-icons">
                <!--action add-->
                <?php if(config('visibility.kanban_board_add_buttons')): ?>
                <span class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form cursor-pointer"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(urlResource('/tasks/create?status='.$board['id'])); ?>"
                    data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.add_task'))); ?>"
                    data-action-url="<?php echo e(urlResource('/tasks?type=kanban')); ?>" data-action-method="POST"
                    data-action-ajax-loading-target="commonModalBody"
                    data-save-button-class="" data-action-ajax-loading-target="commonModalBody"><i
                        class="mdi mdi-plus-circle"></i></span>
                <?php endif; ?>
            </div>
        </div>
        <!--cards-->
        <div class="content kanban-content" id="kanban-board-wrapper-<?php echo e($board['id']); ?>" data-board-name="<?php echo e($board['id']); ?>">

            <!--dynamic content-->
            <?php if(@count($board['tasks'] ?? []) > 0): ?>
            <?php echo $__env->make('pages.tasks.components.kanban.card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <!-- dynamic load more button-->
            <?php echo $__env->make('pages.tasks.components.kanban.loadmore-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tasks/components/kanban/board.blade.php ENDPATH**/ ?>