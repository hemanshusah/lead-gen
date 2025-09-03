<!--importing results-->
<div class="importing-step-3" id="importing-step-3">
    <div class="x-splash-image"><img src="{{ url('public/images/import-results-nothing.svg') }}"
            alt="importing completed" /></div>
    <div class="x-splash-text">
        <h3>@lang('lang.no_data_rows_were_found')</h3>
    </div>
    <div class="x-splash-subtext p-b-15">
        <span class="label label-rounded label-danger p-r-16 p-l-16"><strong>0</strong>
            @lang('lang.records_imported')</span>
            <span class="label label-rounded label-default p-r-16 p-l-16"><strong>{{ $skipped ?? 0 }}</strong> @lang('lang.duplicates_skipped')</span>

    </div>

    <!--samples-->
    @include('pages.import.common.samples')

</div>