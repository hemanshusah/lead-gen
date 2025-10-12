<!--modal-->
<div class="modal" role="dialog" aria-labelledby="plainModal" id="plainModal" <?php echo clean(runtimeAllowCloseModalOptions()); ?>>
    <div class="modal-dialog" id="plainModalContainer">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="plainModalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body min-h-200" id="plainModalBody">

                <!--dynamic content here-->
            </div>
        </div>
    </div>
</div>
<!--notes: see events.js for deails--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/modals/plain-modal-wrapper.blade.php ENDPATH**/ ?>