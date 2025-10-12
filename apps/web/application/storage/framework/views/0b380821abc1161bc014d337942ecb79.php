<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-payments">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i><?php echo e(cleanLang(__('lang.export_payments'))); ?>

                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-payments"></i>
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


                    <!--payment_date-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_date]"
                                    name="standard_field[payment_date]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[payment_date]"><?php echo app('translator')->get('lang.date'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_id-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_id]" name="standard_field[payment_id]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[payment_id]"><?php echo app('translator')->get('lang.payment_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_transaction_id-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_transaction_id]"
                                    name="standard_field[payment_transaction_id]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[payment_transaction_id]"><?php echo app('translator')->get('lang.transaction_id'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--payment_amount-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_amount]"
                                    name="standard_field[payment_amount]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[payment_amount]"><?php echo app('translator')->get('lang.amount'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_invoiceid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_invoiceid]"
                                    name="standard_field[payment_invoiceid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[payment_invoiceid]"><?php echo app('translator')->get('lang.invoice_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_client_name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_client_name]"
                                    name="standard_field[payment_client_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[payment_client_name]"><?php echo app('translator')->get('lang.client'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_clientid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_clientid]"
                                    name="standard_field[payment_clientid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[payment_clientid]"><?php echo app('translator')->get('lang.client_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_projectid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_projectid]"
                                    name="standard_field[payment_projectid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[payment_projectid]"><?php echo app('translator')->get('lang.project_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_project_title-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_project_title]"
                                    name="standard_field[payment_project_title]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[payment_project_title]"><?php echo app('translator')->get('lang.project_title'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_gateway-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_gateway]"
                                    name="standard_field[payment_gateway]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[payment_gateway]"><?php echo app('translator')->get('lang.payment_gateway'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--payment_notes-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[payment_notes]"
                                    name="standard_field[payment_notes]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[payment_notes]"><?php echo app('translator')->get('lang.notes'); ?></label>
                            </div>
                        </div>
                    </div>

                </div>

                <!--buttons-->
                <div class="buttons-block">

                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button" id="export-payments-button"
                        data-url="<?php echo e(urlResource('/export/payments?')); ?>" data-type="form" data-ajax-type="POST"
                        data-button-loading-annimation="yes"><?php echo app('translator')->get('lang.export'); ?></button>
                </div>
            </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/export/payments/export.blade.php ENDPATH**/ ?>