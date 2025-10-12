<!--title-->
<?php echo $__env->make('pages.lead.components.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!--description-->
<?php echo $__env->make('pages.lead.components.description', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!--[todo] checklist-->
<div id="checklist-wrapper">
    <?php echo $__env->make('pages.lead.components.checklists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<!--attachments-->
<?php echo $__env->make('pages.lead.components.attachments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<!--comments-->
<div class="card-comments" id="card-comments">
    <div class="x-heading"><i class="mdi mdi-message-text"></i>Comments</div>
    <div class="x-content">
        <?php echo $__env->make('pages.lead.components.post-comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--comments-->
        <div id="card-comments-container">
            <!--dynamic content here-->
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/leftpanel.blade.php ENDPATH**/ ?>