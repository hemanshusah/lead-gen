<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-items">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i><?php echo app('translator')->get('lang.export_products'); ?>
                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-items"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body p-l-35 p-r-35">

                <!--standard fields-->
                <div class="">
                    <h5><?php echo app('translator')->get('lang.standard_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">

                    <!--item_created-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[item_created]"
                                    name="standard_field[item_created]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[item_created]"><?php echo app('translator')->get('lang.date_created'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--item_description-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[item_description]"
                                    name="standard_field[item_description]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[item_description]"><?php echo app('translator')->get('lang.description'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--item_rate-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[item_rate]"
                                    name="standard_field[item_rate]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[item_rate]"><?php echo app('translator')->get('lang.rate'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--item_category-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[item_category]"
                                    name="standard_field[item_category]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[item_category]"><?php echo app('translator')->get('lang.category'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--item_notes_estimatation-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[item_notes_estimatation]"
                                    name="standard_field[item_notes_estimatation]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[item_notes_estimatation]"><?php echo app('translator')->get('lang.estimation_notes'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--count_sold-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[count_sold]"
                                    name="standard_field[count_sold]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[count_sold]"><?php echo app('translator')->get('lang.number_sold'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--sum_sold-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[sum_sold]"
                                    name="standard_field[sum_sold]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[sum_sold]"><?php echo app('translator')->get('lang.amount_sold'); ?></label>
                            </div>
                        </div>
                    </div>

                </div>

                <!--buttons-->
                <div class="buttons-block">

                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/export/items?')); ?>" data-type="form" data-ajax-type="POST"
                        data-button-loading-annimation="yes"><?php echo app('translator')->get('lang.export'); ?></button>
                </div>
            </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/export/items/export.blade.php ENDPATH**/ ?>