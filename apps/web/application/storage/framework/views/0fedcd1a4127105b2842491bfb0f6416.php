<!--modal-->
<div class="modal search-modal" role="dialog" aria-labelledby="searchModal" id="searchModal" <?php echo clean(runtimeAllowCloseModalOptions()); ?>>
    <div class="modal-dialog modal-xxl" id="searchModalContainer">
        <div class="modal-content">
            <div class="modal-header">

                <div class="x-search-field">
                    <div class="form-group row">
                        <div class="col-12 x-search-field-container" id="global-search-form">
                            <i class="sl-icon-magnifier"></i>
                            <input type="text" class="form-control form-control-sm" id="global-search-field"
                                data-url="<?php echo e(url('search?search_type=all')); ?>" data-type="form"
                                data-form-id="global-search-form" data-ajax-type="post"
                                data-loading-target="global-search-form" name="search_query"
                                placeholder="<?php echo app('translator')->get('lang.search'); ?>">
                        </div>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="ti-close"></i>
                </button>
            </div>

            <!--content body-->
            <div class="modal-body min-h-400 search-modal-container" id="searchModalBody">





            </div>
        </div>
    </div>
</div>

<!--start-->
<div class="hidden" id="search-start-content">
    <?php echo $__env->make('pages.search.modal.start', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/search/modal/search.blade.php ENDPATH**/ ?>