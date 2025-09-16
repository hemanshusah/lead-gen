<!-- viewing a foooso-->

<!--name-->
<div class="row m-b-30">
    <div class="col-sm-12 col-lg-3 text-left">
        @lang('lang.name')
    </div>
    <div class="col-sm-12 col-lg-9">
        {{ $foooso->fooo_example_name ?? '---' }}
    </div>
</div>


<!--date-->
<div class="row m-b-30">
    <div class="col-sm-12 col-lg-3 text-left">
        @lang('lang.name')
    </div>
    <div class="col-sm-12 col-lg-9">
        {{ runtimeDate($fooo->fooo_example_date) }}
    </div>
</div>



<!--mone-->
<div class="row m-b-30">
    <div class="col-sm-12 col-lg-3 text-left">
        @lang('lang.amount')
    </div>
    <div class="col-sm-12 col-lg-9">
        {{ runtimeMoneyFormat($foooso->foooso_name) }}
    </div>
</div>


<!--description-->
<div class="row m-b-30">
    <div class="col-sm-12 col-lg-3 text-left">
        @lang('lang.name')
    </div>
    <div class="col-sm-12 col-lg-9">
        {!! clean($foooso->foooso_name ?? '---') !!}
    </div>
</div>


<!--status-->
<div class="row m-b-30">
    <div class="col-sm-12 col-lg-3 text-left">
        @lang('lang.status')
    </div>
    <div class="col-sm-12 col-lg-9">
        @if ($fooo->fooo_example_status === 'enabled')
        <span class="label label-outline-success">@lang('lang.enabled')</span>
        @elseif ($fooo->fooo_example_status === 'disabled')
        <span class="label label-outline-warning">@lang('lang.disabled')</span>
        @elseif ($fooo->fooo_example_status === 'bar')
        <span class="label label-outline-warning">@lang('lang.bar')</span>
        @endif
    </div>
</div>