<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-proposals">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo app('translator')->get('lang.filter_proposals'); ?>
                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-proposals"></i>
                </span>
            </div>

            <!--body-->
            <div class="r-panel-body">


                <!--client-->
                <?php if(config('visibility.filter_panel_client')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.client_name'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_doc_client_id" id="filter_doc_client_id"
                                    class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/company_names"></select>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


                <!--lead-->
                <?php if(config('visibility.filter_panel_lead')): ?>
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.lead'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_doc_lead_id" id="filter_doc_lead_id"
                                    class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                                    data-ajax--url="<?php echo e(url('/')); ?>/feed/leadnames?ref=general"></select>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!--categorgies-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.category'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="filter_proposal_categoryid" id="filter_proposal_categoryid"
                                    class="form-control form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                                    multiple="multiple" tabindex="-1" aria-hidden="true">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->category_id); ?>">
                                        <?php echo e($category->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <!--proposal_date-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.proposal_date'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_start_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_start_start"
                                    name="filter_doc_date_start_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_start_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_start_end"
                                    name="filter_doc_date_start_end" value="">
                            </div>
                        </div>
                    </div>
                </div>


                <!--valid_until-->
                <div class="filter-block">
                    <div class="title">
                        <?php echo e(cleanLang(__('lang.valid_until'))); ?>

                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_end_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.start'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_end_start"
                                    name="filter_doc_date_end_start" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="filter_doc_date_end_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="<?php echo e(cleanLang(__('lang.end'))); ?>">
                                <input class="mysql-date" type="hidden" id="filter_doc_date_end_end"
                                    name="filter_doc_date_end_end" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel"><?php echo e(cleanLang(__('lang.reset'))); ?></button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="<?php echo e($page['source_for_filter_panels'] ?? ''); ?>">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/proposals/search')); ?>" data-type="form"
                        data-ajax-type="GET"><?php echo e(cleanLang(__('lang.apply_filter'))); ?></button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/proposals/components/misc/filter-proposals.blade.php ENDPATH**/ ?>