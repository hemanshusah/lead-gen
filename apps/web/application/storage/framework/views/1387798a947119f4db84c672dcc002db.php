<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-leads">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i><?php echo e(cleanLang(__('lang.export_leads'))); ?>

                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-leads"></i>
                </span>
            </div>

            <!--body-->
            <div class="r-panel-body p-l-35 p-r-35">

                <!--standard fields-->
                <div class="">
                    <h5><?php echo app('translator')->get('lang.standard_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">

                    <!--title-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_title]" name="standard_field[lead_title]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_title]"><?php echo app('translator')->get('lang.title'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--firstname-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_firstname]"
                                    name="standard_field[lead_firstname]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_firstname]"><?php echo app('translator')->get('lang.first_name'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--lastname-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_lastname]"
                                    name="standard_field[lead_lastname]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_lastname]"><?php echo app('translator')->get('lang.last_name'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--created by-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_creator]"
                                    name="standard_field[lead_creator]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_creator]"><?php echo app('translator')->get('lang.created_by'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--email-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_email]" name="standard_field[lead_email]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_email]"><?php echo app('translator')->get('lang.email'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--phone-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_phone]" name="standard_field[lead_phone]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_phone]"><?php echo app('translator')->get('lang.phone'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--job position-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_job_position]"
                                    name="standard_field[lead_job_position]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_job_position]"><?php echo app('translator')->get('lang.job_title'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--website-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_website]"
                                    name="standard_field[lead_website]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_website]"><?php echo app('translator')->get('lang.website'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--street-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_street]"
                                    name="standard_field[lead_street]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_street]"><?php echo app('translator')->get('lang.street'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--city-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_city]" name="standard_field[lead_city]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_city]"><?php echo app('translator')->get('lang.city'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--state-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_state]" name="standard_field[lead_state]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_state]"><?php echo app('translator')->get('lang.state'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--zip-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_zip]" name="standard_field[lead_zip]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_zip]"><?php echo app('translator')->get('lang.zipcode'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--country-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_country]"
                                    name="standard_field[lead_country]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_country]"><?php echo app('translator')->get('lang.country'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--description-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_description]"
                                    name="standard_field[lead_description]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_description]"><?php echo app('translator')->get('lang.description'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--company name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_company_name]"
                                    name="standard_field[lead_company_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_company_name]"><?php echo app('translator')->get('lang.company_name'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--value-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_value]" name="standard_field[lead_value]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_value]"><?php echo app('translator')->get('lang.value'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--source-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_source]"
                                    name="standard_field[lead_source]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_source]"><?php echo app('translator')->get('lang.source'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--status-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_status]"
                                    name="standard_field[lead_status]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_status]"><?php echo app('translator')->get('lang.status'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--last contacted-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_last_contacted]"
                                    name="standard_field[lead_last_contacted]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_last_contacted]"><?php echo app('translator')->get('lang.last_contacted'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--converted-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_converted]"
                                    name="standard_field[lead_converted]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_converted]"><?php echo app('translator')->get('lang.converted'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--converted by-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_converted_by]"
                                    name="standard_field[lead_converted_by]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_converted_by]"><?php echo app('translator')->get('lang.converted_by'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--date converted-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_converted_date]"
                                    name="standard_field[lead_converted_date]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_converted_date]"><?php echo app('translator')->get('lang.date_converted'); ?></label>
                            </div>
                        </div>
                    </div>

                </div>

                <!--custon fields-->
                <div class="m-t-30">
                    <h5><?php echo app('translator')->get('lang.custom_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($field->customfields_title): ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[<?php echo e($field->customfields_name); ?>]"
                                    class="filled-in chk-col-light-blue toggle-all-checkbox"
                                    name="custom_field[<?php echo e($field->customfields_name); ?>]">
                                <label class="p-l-30"
                                    for="custom_field[<?php echo e($field->customfields_name); ?>]"><?php echo e($field->customfields_title); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        id="export-leads-button" data-url="<?php echo e(urlResource('/export/leads?')); ?>" data-type="form"
                        data-ajax-type="POST" data-button-loading-annimation="yes">
                        <?php echo app('translator')->get('lang.export'); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/export/leads/export.blade.php ENDPATH**/ ?>