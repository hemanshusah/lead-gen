
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<div class="table-responsive">
    <form>
        <table id="demo-foo-addrow" class="table m-t-0 m-b-0 table-hover no-wrap app-modules" data-page-size="10">
            <thead>
                <tr>
                    <th class=""><?php echo app('translator')->get('lang.module'); ?></th>
                    <th class="w-px-100"><?php echo app('translator')->get('lang.enabled'); ?></th>
                </tr>
            </thead>
            <tbody>

                <!--projects-->
                <tr>
                    <td><?php echo app('translator')->get('lang.projects'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_projects" name="settings_modules_projects"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_projects)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_projects"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--tasks-->
                <tr>
                    <td><?php echo app('translator')->get('lang.tasks'); ?> - <small>(<?php echo app('translator')->get('lang.linked_to_projects'); ?>)</small></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_tasks" name="settings_modules_tasks"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_tasks)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_tasks"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--invoices-->
                <tr>
                    <td><?php echo app('translator')->get('lang.invoices'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_invoices" name="settings_modules_invoices"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_invoices)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_invoices"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--payments-->
                <tr>
                    <td><?php echo app('translator')->get('lang.payments'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_payments" name="settings_modules_payments"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_payments)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_payments"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--leads-->
                <tr>
                    <td><?php echo app('translator')->get('lang.leads'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_leads" name="settings_modules_leads"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_leads)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_leads"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--knowledgebase-->
                <tr>
                    <td><?php echo app('translator')->get('lang.knowledgebase'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_knowledgebase"
                                    name="settings_modules_knowledgebase"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_knowledgebase)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_knowledgebase"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--estimates-->
                <tr>
                    <td><?php echo app('translator')->get('lang.estimates'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_estimates" name="settings_modules_estimates"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_estimates)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_estimates"></label>
                            </div>
                        </div>
                    </td>
                </tr>


                <!--proposals-->
                <tr>
                    <td><?php echo app('translator')->get('lang.proposals'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_proposals" name="settings_modules_proposals"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_proposals)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_proposals"></label>
                            </div>
                        </div>
                    </td>
                </tr>


                <!--contracts-->
                <tr>
                    <td><?php echo app('translator')->get('lang.contracts'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_contracts" name="settings_modules_contracts"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_contracts)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_contracts"></label>
                            </div>
                        </div>
                    </td>
                </tr>



                <!--expenses-->
                <tr>
                    <td><?php echo app('translator')->get('lang.expenses'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_expenses" name="settings_modules_expenses"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_expenses)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_expenses"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--subscriptions-->
                <tr>
                    <td><?php echo app('translator')->get('lang.subscriptions'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_subscriptions"
                                    name="settings_modules_subscriptions"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_subscriptions)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_subscriptions"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--tickets-->
                <tr>
                    <td><?php echo app('translator')->get('lang.tickets'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_tickets" name="settings_modules_tickets"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_tickets)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_tickets"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--messages-->
                <tr>
                    <td><?php echo app('translator')->get('lang.messages'); ?> (<?php echo app('translator')->get('lang.instant_messaging'); ?>)</td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_messages" name="settings_modules_messages"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_messages)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_messages"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--time_tracking-->
                <tr>
                    <td><?php echo app('translator')->get('lang.time_tracking'); ?> - <small>(<?php echo app('translator')->get('lang.linked_to_tasks'); ?>)</small></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_timetracking"
                                    name="settings_modules_timetracking"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_timetracking)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_timetracking"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--spaces-- [FUTURE] also enable in SettingsRepository
                <tr>
                    <td><?php echo app('translator')->get('lang.spaces'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_spaces" name="settings_modules_spaces"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_spaces)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_spaces"></label>
                            </div>
                        </div>
                    </td>
                </tr>
            -->

                <!--reminders-->
                <tr>
                    <td><?php echo app('translator')->get('lang.reminders'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_reminders" name="settings_modules_reminders"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_reminders)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_reminders"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--calendar-->
                <tr>
                    <td><?php echo app('translator')->get('lang.calendar'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_calendar" name="settings_modules_calendar"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_calendar)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_calendar"></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--reports-->
                <tr>
                    <td><?php echo app('translator')->get('lang.reports'); ?></td>
                    <td>
                        <div class="form-group form-group-checkbox m-0 p-0">
                            <div class="col-2 text-right m-0 p-0">
                                <input type="checkbox" id="settings_modules_reports" name="settings_modules_reports"
                                    <?php echo e(runtimePrechecked($settings->settings_modules_reports)); ?>

                                    class="filled-in chk-col-light-blue">
                                <label class="m-0 p-0" for="settings_modules_reports"></label>
                            </div>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

        <?php if(config('system.settings_type') == 'standalone'): ?>
        <!--[standalone] - settings documentation help-->
        <?php endif; ?>

        <div class="text-right">
            <button type="submit" id="commonModalSubmitButton"
                class="btn btn-rounded-x btn-danger waves-effect text-left ajax-request"
                data-url="<?php echo e(url('/settings/modules')); ?>" data-loading-target="" data-ajax-type="PUT" data-type="form"
                data-on-start-submit-button="disable"><?php echo app('translator')->get('lang.save_changes'); ?></button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/modules/page.blade.php ENDPATH**/ ?>