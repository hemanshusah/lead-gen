<!-- right-sidebar -->
<div class="right-sidebar" id="table-config-leads">
    <form id="table-config-form">
        <div class="slimscrollright">
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i><?php echo e(cleanLang(__('lang.table_settings'))); ?>

                <span>
                    <i class="ti-close js-close-side-panels" data-target="table-config-leads"></i>
                </span>
            </div>

            <!--set ajax url on parent container-->
            <div class="r-panel-body table-config-ajax" data-url="<?php echo e(url('preferences/tables')); ?>" data-type="form"
                data-form-id="table-config-form" data-ajax-type="post" data-progress-bar="hidden">

                <!--tableconfig_column_1 [lead_firstname]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_1" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_1'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.contact_name'); ?></span>
                    </label>
                </div>


                <!--tableconfig_column_2 [lead_title]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_2" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_2'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.title'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_3 [lead_created]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_3" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_3'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.created'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_4 [lead_value]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_4" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_4'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.value'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_5 [lead_status]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_5" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_5'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.status'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_6 [lead_assigned]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_6" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_6'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.assigned'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_7 [lead_category_name]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_7" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_7'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.category'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_8 [lead_company_name]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_8" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_8'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.company'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_9 [lead_email]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_9" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_9'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.email'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_10 [lead_phone]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_10" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_10'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.phone'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_11 [lead_job_position]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_11" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_11'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.position'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_12 [lead_city]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_12" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_12'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.city'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_13 [lead_state]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_13" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_13'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.state'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_14 [lead_zip]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_14" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_14'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.zipcode'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_15 [lead_country]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_15" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_15'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.country'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_16 [lead_last_contacted]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_16" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_16'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.last_contacted'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_17 [lead_converted_by_userid]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_17" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_17'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.converted_by'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_18 [lead_converted_date]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_18" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_18'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.date_converted'); ?></span>
                    </label>
                </div>

                <!--tableconfig_column_19 [lead_source]-->
                <div class="p-b-5">
                    <label class="custom-control custom-checkbox table-config-checkbox-container">
                        <input name="tableconfig_column_19" type="checkbox"
                            class="custom-control-input table-config-checkbox cursor-pointer"
                            <?php echo e(runtimePrechecked(config('table.tableconfig_column_19'))); ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"><?php echo app('translator')->get('lang.source'); ?></span>
                    </label>
                </div>

                <!--table name-->
                <input type="hidden" name="tableconfig_table_name" value="leads">

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1" class="btn btn-rounded-x btn-secondary js-close-side-panels"
                        data-target="table-config-leads"><?php echo e(cleanLang(__('lang.close'))); ?></button>
                    <input type="hidden" name="action" value="search">
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/leads/components/misc/table-config.blade.php ENDPATH**/ ?>