<div class="row">
    <div class="col-lg-12">
        <!--title-->
        <div class="form-group row">
            <label
                class="col-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.role_name'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="role_name" name="role_name"
                    value="<?php echo e($role->role_name ?? ''); ?>">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered w-99">
                <thead>
                    <tr>
                        <th><?php echo e(cleanLang(__('lang.resource'))); ?></th>
                        <th id="fx-settings-roles-th-1">
                            <?php echo e(cleanLang(__('lang.permissions'))); ?>

                            <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                                title="<?php echo e(cleanLang(__('lang.edit_delete_permission_only_for_user'))); ?>"
                                data-placement="top"><i class="ti-info-alt"></i></span>
                        </th>
                        <th class="text-center"><?php echo e(cleanLang(__('lang.global'))); ?> <span
                                class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                                title="<?php echo e(cleanLang(__('lang.roles_scope_info'))); ?>" data-placement="top"><i
                                    class="ti-info-alt"></i></span></th>
                    </tr>
                </thead>
                <tbody>

                    <!--projects-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.projects'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_projects"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_projects ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_projects ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_projects ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_projects ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_projects_scope" name="role_projects_scope"
                                        class="filled-in chk-col-light-blue"
                                        <?php echo e(runtimePrechecked($role->role_projects_scope ?? '')); ?>>
                                    <label for="role_projects_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!--projects templates-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.project_templates'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_templates_projects" data-allow-clear="false">
                                        <option value="0"
                                            <?php echo e(runtimePreselected($role->role_templates_projects ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1"
                                            <?php echo e(runtimePreselected($role->role_templates_projects ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2"
                                            <?php echo e(runtimePreselected($role->role_templates_projects ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3"
                                            <?php echo e(runtimePreselected($role->role_templates_projects ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_projects_scope" name="role_templates_projects_scope"
                                        class="filled-in chk-col-light-blue" checked disabled>
                                    <label for="role_templates_projects_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--project billing-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.project_billing_info'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_projects_billing" data-allow-clear="false">
                                        <option value="0"
                                            <?php echo e(runtimePreselected($role->role_projects_billing ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1"
                                            <?php echo e(runtimePreselected($role->role_projects_billing ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2"
                                            <?php echo e(runtimePreselected($role->role_projects_billing ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_projects_scope" name="role_projects_billing_scope"
                                        class="filled-in chk-col-light-blue" checked disabled>
                                    <label for="role_projects_billing_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--team-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.team'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_team"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_team ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_team ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_team ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_team_scope" name="role_team_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_team_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <!--leads-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.leads'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_leads"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_leads ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_leads ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_leads ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_leads ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_leads_scope" name="role_leads_scope"
                                        class="filled-in chk-col-light-blue"
                                        <?php echo e(runtimePrechecked($role->role_leads_scope ?? '')); ?>>
                                    <label for="role_leads_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--tasks-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.tasks'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_tasks"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_tasks ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_tasks ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_tasks ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_tasks ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_tasks_scope" name="role_tasks_scope"
                                        class="filled-in chk-col-light-blue"
                                        <?php echo e(runtimePrechecked($role->role_tasks_scope ?? '')); ?>>
                                    <label for="role_tasks_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--expenses-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.expenses'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_expenses"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_expenses ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_expenses ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_expenses ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_expenses ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_expenses_scope" name="role_expenses_scope"
                                        class="filled-in chk-col-light-blue"
                                        <?php echo e(runtimePrechecked($role->role_expenses_scope ?? '')); ?>>
                                    <label for="role_expenses_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--timesheets-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.time_sheets'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_timesheets"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_timesheets ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_timesheets ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_timesheets ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_timesheets ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_timesheets_scope" name="role_timesheets_scope"
                                        class="filled-in chk-col-light-blue"
                                        <?php echo e(runtimePrechecked($role->role_timesheets_scope ?? '')); ?>>
                                    <label for="role_timesheets_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--Invoices-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.invoices'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_invoices"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_invoices ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_invoices ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_invoices ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_invoices ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_invoices_scope" name="role_invoices_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_invoices_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!--Payments-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.payments'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_payments"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_payments ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_payments ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_payments ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_payments ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_payments_scope" name="role_payments_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_payments_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!--Products-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.products'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_items"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_items ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_items ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_items ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_items ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_items_scope" name="role_items_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_items_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--Estimates-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.estimates'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_estimates"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_estimates ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_estimates ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_estimates ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_estimates ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_estimates_scope" name="role_estimates_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_estimates_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>



                    <!--Proposals-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.proposals'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_proposals"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_proposals ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_proposals ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_proposals ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_proposals ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_proposals_scope" name="role_proposals_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_proposals_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--proposals templates-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.proposal_templates'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_templates_proposals" data-allow-clear="false">
                                        <option value="0"
                                            <?php echo e(runtimePreselected($role->role_templates_proposals ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1"
                                            <?php echo e(runtimePreselected($role->role_templates_proposals ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2"
                                            <?php echo e(runtimePreselected($role->role_templates_proposals ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3"
                                            <?php echo e(runtimePreselected($role->role_templates_proposals ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_proposals_scope"
                                        name="role_templates_proposals_scope" class="filled-in chk-col-light-blue"
                                        checked disabled>
                                    <label for="role_templates_proposals_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--Contracts-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.contracts'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_contracts"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_contracts ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_contracts ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_contracts ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_contracts ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_contracts_scope" name="role_contracts_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_contracts_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--contracts templates-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.contract_templates'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_templates_contracts" data-allow-clear="false">
                                        <option value="0"
                                            <?php echo e(runtimePreselected($role->role_templates_contracts ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1"
                                            <?php echo e(runtimePreselected($role->role_templates_contracts ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2"
                                            <?php echo e(runtimePreselected($role->role_templates_contracts ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3"
                                            <?php echo e(runtimePreselected($role->role_templates_contracts ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_contracts_scope"
                                        name="role_templates_contracts_scope" class="filled-in chk-col-light-blue"
                                        checked disabled>
                                    <label for="role_templates_contracts_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--Clients-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.clients'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_clients"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_clients ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_clients ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_clients ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_clients ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_clients_scope" name="role_clients_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_clients_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--Contacts-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.contacts'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_contacts"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_contacts ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_contacts ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_contacts ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_contacts ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0  w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_contacts_scope" name="role_contacts_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_contacts_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--tickets-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.tickets'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_tickets"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_tickets ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_tickets ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_tickets ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_tickets ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center  p-t-5">
                                    <input type="checkbox" id="role_tickets_scope" name="role_tickets_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_tickets_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--canned-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.manage_canned_publid'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_canned"
                                        data-allow-clear="false">
                                        <option value="no" <?php echo e(runtimePreselected($role->role_canned ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes" <?php echo e(runtimePreselected($role->role_canned ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_canned_scope" name="role_canned_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked"
                                        <?php echo e(runtimePrechecked($role->role_canned_scope ?? '')); ?>>
                                    <label for="role_canned_scope"></label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!--knowledge base-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.knowledgebase'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_knowledgebase"
                                        data-allow-clear="false">
                                        <option value="0" <?php echo e(runtimePreselected($role->role_knowledgebase ?? '', 0)); ?>>
                                            <?php echo e(cleanLang(__('lang.none'))); ?></option>
                                        <option value="1" <?php echo e(runtimePreselected($role->role_knowledgebase ?? '', 1)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?></option>
                                        <option value="2" <?php echo e(runtimePreselected($role->role_knowledgebase ?? '', 2)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?></option>
                                        <option value="3" <?php echo e(runtimePreselected($role->role_knowledgebase ?? '', 3)); ?>>
                                            <?php echo e(cleanLang(__('lang.view'))); ?> + <?php echo e(cleanLang(__('lang.add'))); ?> +
                                            <?php echo e(cleanLang(__('lang.edit'))); ?> +
                                            <?php echo e(cleanLang(__('lang.delete'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center  p-t-5">
                                    <input type="checkbox" id="role_knowledgebase_scope" name="role_knowledgebase_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_knowledgebase_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--messages-->
                    <tr>
                        <td><?php echo app('translator')->get('lang.messages'); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_messages"
                                        data-allow-clear="false">
                                        <option value="no" <?php echo e(runtimePreselected($role->role_messages ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes" <?php echo e(runtimePreselected($role->role_messages ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_messages_scope" name="role_messages_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_messages_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--reports-->
                    <tr>
                        <td><?php echo app('translator')->get('lang.reports'); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_reports"
                                        data-allow-clear="false">
                                        <option value=no" <?php echo e(runtimePreselected($role->role_reports ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes" <?php echo e(runtimePreselected($role->role_reports ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="reports" name="reports"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="reports" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--assigned projects-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.assign_projects'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_assign_projects" data-allow-clear="false">
                                        <option value=no"
                                            <?php echo e(runtimePreselected($role->role_assign_projects ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes"
                                            <?php echo e(runtimePreselected($role->role_assign_projects ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_assign_projects_scope"
                                        name="role_assign_projects_scope" class="filled-in chk-col-light-blue" disabled
                                        checked="checked">
                                    <label for="role_assign_projects_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--assign leads-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.assign_leads'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_assign_leads"
                                        data-allow-clear="false">
                                        <option value="no"
                                            <?php echo e(runtimePreselected($role->role_assign_leads ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes"
                                            <?php echo e(runtimePreselected($role->role_assign_leads ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>

                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_assign_leads_scope" name="role_assign_leads_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_assign_leads_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--assign tasks-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.assign_tasks'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm" name="role_assign_tasks"
                                        data-allow-clear="false">
                                        <option value="no"
                                            <?php echo e(runtimePreselected($role->role_assign_tasks ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes"
                                            <?php echo e(runtimePreselected($role->role_assign_tasks ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_assign_tasks_scope" name="role_assign_tasks_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_assign_tasks_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!--set project permissions-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.set_project_permissions'))); ?> <span
                                class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                                title="<?php echo e(cleanLang(__('lang.all_setting_permissions_when_adding_project'))); ?>"
                                data-placement="top"><i class="ti-info-alt"></i></span></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_set_project_permissions" data-allow-clear="false">
                                        <option value=no"
                                            <?php echo e(runtimePreselected($role->role_set_project_permissions ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes"
                                            <?php echo e(runtimePreselected($role->role_set_project_permissions ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_set_project_permissions_scope"
                                        name="role_set_project_permissions_scope" class="filled-in chk-col-light-blue"
                                        disabled checked="checked">
                                    <label for="role_set_project_permissions_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!--manage categories - knowledgebase-->
                    <tr>
                        <td><?php echo e(cleanLang(__('lang.manage_knowledgebase'))); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_manage_knowledgebase_categories" data-allow-clear="false">
                                        <option value="no"
                                            <?php echo e(runtimePreselected($role->role_manage_knowledgebase_categories ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes"
                                            <?php echo e(runtimePreselected($role->role_manage_knowledgebase_categories ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_manage_knowledgebase_categories_scope"
                                        name="role_manage_knowledgebase_categories_scope"
                                        class="filled-in chk-col-light-blue" disabled checked="checked">
                                    <label for="role_manage_knowledgebase_categories_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!--import content-->
                    <tr>
                        <td><?php echo app('translator')->get('lang.import_content'); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_content_import" data-allow-clear="false">
                                        <option value="no"
                                            <?php echo e(runtimePreselected($role->role_content_import ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes"
                                            <?php echo e(runtimePreselected($role->role_content_import ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_content_import_scope"
                                        name="role_content_import_scope" class="filled-in chk-col-light-blue" disabled
                                        checked="checked">
                                    <label for="role_content_import_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!--export content-->
                    <tr>
                        <td><?php echo app('translator')->get('lang.export_content'); ?></td>
                        <td>
                            <div class="form-group row m-0">
                                <div class="col-12 text-center">
                                    <select class="select2-basic form-control form-control-sm"
                                        name="role_content_export" data-allow-clear="false">
                                        <option value="no"
                                            <?php echo e(runtimePreselected($role->role_content_export ?? '', 'no')); ?>>
                                            <?php echo e(cleanLang(__('lang.no'))); ?></option>
                                        <option value="yes"
                                            <?php echo e(runtimePreselected($role->role_content_export ?? '', 'yes')); ?>>
                                            <?php echo e(cleanLang(__('lang.yes'))); ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group form-group-checkbox row m-0 w-98">
                                <div class="col-12 text-center p-t-5">
                                    <input type="checkbox" id="role_content_export_scope"
                                        name="role_content_export_scope" class="filled-in chk-col-light-blue" disabled
                                        checked="checked">
                                    <label for="role_content_export_scope" data-toggle="tooltip"
                                        title="<?php echo e(cleanLang(__('lang.can_only_be_set_as_global'))); ?>"></label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!--[modules] permissions-->
        <?php if(config('response.mode') == 'edit'): ?>
        <div class="row m-t-30">
            <div class="col-12">
                <div class="modal-selector m-l-0 m-r-10">
                    <h4><?php echo app('translator')->get('lang.modules'); ?></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered w-99">
                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($module['module_alias']); ?></td>
                                <td class="w-px-250">
                                    <input type="hidden" name="modules[<?php echo e($index); ?>][module_name]"
                                        value="<?php echo e($module['module_name']); ?>">
                                    <input type="hidden" name="modules[<?php echo e($index); ?>][module_alias]"
                                        value="<?php echo e($module['module_alias']); ?>">
                                    <select class="select2-basic form-control form-control-sm select2-preselected"
                                        name="modules[<?php echo e($index); ?>][module_permission]"
                                        data-preselected="<?php echo e($module['module_permission'] ?? ''); ?>">
                                        <option></option>
                                        <option value="none"><?php echo app('translator')->get('lang.none'); ?></option>
                                        <option value="view"><?php echo app('translator')->get('lang.view'); ?></option>
                                        <option value="manage"><?php echo app('translator')->get('lang.manage'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!--[modules] permissions-->
        <?php if(config('response.mode') == 'create'): ?>
        <div class="alert alert-info">
            <?php echo app('translator')->get('lang.permission_for_modules_info'); ?>
        </div>
        <?php endif; ?>
    </div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/roles/modals/add-edit-inc.blade.php ENDPATH**/ ?>