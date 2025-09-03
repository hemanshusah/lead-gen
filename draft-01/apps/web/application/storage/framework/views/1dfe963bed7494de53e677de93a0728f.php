<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-tickets">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i><?php echo e(cleanLang(__('lang.export_ticket'))); ?>

                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-tickets"></i>
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
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[ticket_id]" name="standard_field[ticket_id]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[ticket_id]"><?php echo app('translator')->get('lang.id'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[client_company_name]"
                                    name="standard_field[client_company_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[client_company_name]"><?php echo app('translator')->get('lang.client_name'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[created_by_name]"
                                    name="standard_field[created_by_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[created_by_name]"><?php echo app('translator')->get('lang.created_by_name'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[created_by_email]"
                                    name="standard_field[created_by_email]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[created_by_email]"><?php echo app('translator')->get('lang.created_by_email'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[ticket_subject]"
                                    name="standard_field[ticket_subject]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[ticket_subject]"><?php echo app('translator')->get('lang.subject'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[ticket_message]"
                                    name="standard_field[ticket_message]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[ticket_message]"><?php echo app('translator')->get('lang.message'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[category_name]" name="standard_field[category_name]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[category_name]"><?php echo app('translator')->get('lang.department'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[ticket_created]"
                                    name="standard_field[ticket_created]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[ticket_created]"><?php echo app('translator')->get('lang.date_created'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[ticket_priority]"
                                    name="standard_field[ticket_priority]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[ticket_priority]"><?php echo app('translator')->get('lang.priority'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[ticket_last_updated]"
                                    name="standard_field[ticket_last_updated]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[ticket_last_updated]"><?php echo app('translator')->get('lang.activity'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[ticket_status]"
                                    name="standard_field[ticket_status]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[ticket_status]"><?php echo app('translator')->get('lang.status'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[replies]"
                                    name="standard_field[replies]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[replies]"><?php echo app('translator')->get('lang.replies'); ?></label>
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
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[<?php echo e($field->customfields_name); ?>]"
                                    name="custom_field[<?php echo e($field->customfields_name); ?>]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="custom_field[<?php echo e($field->customfields_name); ?>]"><?php echo e($field->customfields_title); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>


                <!--buttons-->
                <div class="buttons-block">

                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="<?php echo e(urlResource('/export/tickets?')); ?>" data-type="form"
                        data-ajax-type="POST"
                        data-button-loading-annimation="yes"><?php echo app('translator')->get('lang.export'); ?></button>
                </div>
            </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/export/tickets/export.blade.php ENDPATH**/ ?>