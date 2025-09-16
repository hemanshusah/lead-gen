@extends('pages.settings.ajaxwrapper')
@section('settings-page')
<!--settings-->
<form class="form" id="settingsFormTimesheets">

    <!--item-->
    <div class="form-group row">
        <label class="col-sm-12 text-left control-label col-form-label required">@lang('lang.show_trimesheet_recorded_by')</label>
        <div class="col-sm-12">
            <select class="select2-basic form-control form-control-sm select2-preselected" id="settings2_timesheets_show_recorded_by"
                name="settings2_timesheets_show_recorded_by" data-preselected="{{ $settings->settings2_timesheets_show_recorded_by ?? ''}}">
                <option></option>
                <option value="yes">@lang('lang.yes')</option>
                <option value="no">@lang('lang.no')</option>
            </select>
        </div>
    </div>

    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="settingsFormTimesheetsButton" class="btn btn-rounded-x btn-danger waves-effect text-left ajax-request"
            data-url="/settings/timesheets" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable">{{ cleanLang(__('lang.save_changes')) }}</button>
    </div>
</form>
@endsection