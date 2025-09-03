<div class="col-lg-8  col-md-12" id="dashboard-admin-invoice-vs-expenses">
    <div class="card">
        <div class="card-body">
            <div class="d-flex m-b-30">
                <h5 class="card-title m-b-0 align-self-center">@lang('lang.income_vs_expense')</h5>
                <div class="ml-auto align-self-center">
                    <ul class="list-inline font-12">
                        <li><span class="label label-success label-rounded"><i class="fa fa-circle"></i>
                                @lang('lang.income')</span></li>
                        <li><span class="label label-info label-rounded"><i class="fa fa-circle text-info"></i>
                                @lang('lang.expense')</span></li>
                        <li class="m-r-0">
                            <select name="income_expenses_year" id="income_expenses_year"
                                class="form-control form-control-sm select2-basic ajax-request" data-ajax-type="POST"
                                data-url="{{ url('home/update-stats') }}" data-type="form"
                                data-form-id="dashboard-admin-invoice-vs-expenses"
                                data-loading-target="dashboard-admin-invoice-vs-expenses">
                                @if(isset($payload['available_years']))
                                @foreach($payload['available_years'] as $year)
                                <option value="{{ $year }}"
                                    {{ ($year == $payload['income']['year']) ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                                @endforeach
                                @else
                                <option value="{{ $payload['income']['year'] }}" selected>
                                    {{ $payload['income']['year'] }}
                                </option>
                                @endif
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="incomeexpenses ct-charts" id="admin-dhasboard-income-vs-expenses"></div>
            <div class="row text-center">
                <div class="col-lg-4 col-md-4 m-t-20">
                    <h2 class="m-b-0 font-light">{{ $payload['income']['year'] }}</h2>
                    <small>@lang('lang.period')</small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20">
                    <h2 class="m-b-0 font-light">{{ runtimeMoneyFormat($payload['income']['total']) }}</h2>
                    <small>@lang('lang.income')</small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20">
                    <h2 class="m-b-0 font-light">{{ runtimeMoneyFormat($payload['expenses']['total']) }}</h2>
                    <small>@lang('lang.expenses')</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!--[DYNAMIC INLINE SCRIPT] - Backend Variables to Javascript Variables-->
<script>
    NX.admin_home_chart_income = JSON.parse('{!! json_encode(clean($payload["income"]["monthly"])) !!}', true);
    NX.admin_home_chart_expenses = JSON.parse('{!! json_encode(clean($payload["expenses"]["monthly"])) !!}', true);

    //call the chart function
    $(document).ready(function () {
        dashboardChartIncomeExpenses();
    });
</script>