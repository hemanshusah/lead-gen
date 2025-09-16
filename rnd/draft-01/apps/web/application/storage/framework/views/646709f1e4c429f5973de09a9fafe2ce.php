<div class="col-lg-8  col-md-12" id="dashboard-admin-invoice-vs-expenses">
    <div class="card">
        <div class="card-body">
            <div class="d-flex m-b-30">
                <h5 class="card-title m-b-0 align-self-center"><?php echo app('translator')->get('lang.income_vs_expense'); ?></h5>
                <div class="ml-auto align-self-center">
                    <ul class="list-inline font-12">
                        <li><span class="label label-success label-rounded"><i class="fa fa-circle"></i>
                                <?php echo app('translator')->get('lang.income'); ?></span></li>
                        <li><span class="label label-info label-rounded"><i class="fa fa-circle text-info"></i>
                                <?php echo app('translator')->get('lang.expense'); ?></span></li>
                        <li class="m-r-0">
                            <select name="income_expenses_year" id="income_expenses_year"
                                class="form-control form-control-sm select2-basic ajax-request" data-ajax-type="POST"
                                data-url="<?php echo e(url('home/update-stats')); ?>" data-type="form"
                                data-form-id="dashboard-admin-invoice-vs-expenses"
                                data-loading-target="dashboard-admin-invoice-vs-expenses">
                                <?php if(isset($payload['available_years'])): ?>
                                <?php $__currentLoopData = $payload['available_years']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($year); ?>"
                                    <?php echo e(($year == $payload['income']['year']) ? 'selected' : ''); ?>>
                                    <?php echo e($year); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <option value="<?php echo e($payload['income']['year']); ?>" selected>
                                    <?php echo e($payload['income']['year']); ?>

                                </option>
                                <?php endif; ?>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="incomeexpenses ct-charts" id="admin-dhasboard-income-vs-expenses"></div>
            <div class="row text-center">
                <div class="col-lg-4 col-md-4 m-t-20">
                    <h2 class="m-b-0 font-light"><?php echo e($payload['income']['year']); ?></h2>
                    <small><?php echo app('translator')->get('lang.period'); ?></small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20">
                    <h2 class="m-b-0 font-light"><?php echo e(runtimeMoneyFormat($payload['income']['total'])); ?></h2>
                    <small><?php echo app('translator')->get('lang.income'); ?></small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20">
                    <h2 class="m-b-0 font-light"><?php echo e(runtimeMoneyFormat($payload['expenses']['total'])); ?></h2>
                    <small><?php echo app('translator')->get('lang.expenses'); ?></small>
                </div>
            </div>
        </div>
    </div>
</div>

<!--[DYNAMIC INLINE SCRIPT] - Backend Variables to Javascript Variables-->
<script>
    NX.admin_home_chart_income = JSON.parse('<?php echo json_encode(clean($payload["income"]["monthly"])); ?>', true);
    NX.admin_home_chart_expenses = JSON.parse('<?php echo json_encode(clean($payload["expenses"]["monthly"])); ?>', true);

    //call the chart function
    $(document).ready(function () {
        dashboardChartIncomeExpenses();
    });
</script><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/home/admin/widgets/second-row/income.blade.php ENDPATH**/ ?>