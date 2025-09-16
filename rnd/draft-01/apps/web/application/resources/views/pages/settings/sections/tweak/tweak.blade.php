@extends('pages.settings.ajaxwrapper')
@section('settings-page')
<!--settings-->
<form class="form" id="settingsFormGeneral">

    <!--[reports] - truncate long title-->
    <div class="form-group form-group-checkbox row">
        <div class="col-12">
            <label class="text-left control-label col-form-label p-r-3 required">@lang('lang.reports') -
                @lang('lang.truncate_long_text')</label>
            <span class="text-right p-l-15">
                <input type="checkbox" id="settings2_tweak_reports_truncate_long_text"
                    name="settings2_tweak_reports_truncate_long_text" class="filled-in chk-col-light-blue"
                    {{ runtimePrechecked($settings->settings2_tweak_reports_truncate_long_text ?? '') }}>
                <label for="settings2_tweak_reports_truncate_long_text" class="display-inline"></label>
            </span>
        </div>
    </div>

    <!--[imap] - reset email processing queue-->
    <div class="form-group form-group-checkbox row">
        <div class="col-12">
            <label class="text-left control-label col-form-label p-r-3 required">@lang('lang.reset_email_processing_queue')</label>
            <span class="text-right p-l-15">
                <input type="checkbox" id="settings2_tweak_reports_truncate_long_text"
                    name="settings2_tweak_reports_truncate_long_text" class="filled-in chk-col-light-blue"
                    {{ runtimePrechecked($settings->settings2_tweak_reports_truncate_long_text ?? '') }}>
                <label for="settings2_tweak_reports_truncate_long_text" class="display-inline"></label>
            </span>
        </div>
    </div>

    <!--[imap] - import limits-->
    <div class="form-group row">
        <label class="col-12 text-left control-label col-form-label required">@lang('lang.imap_fetch_limits')
            (@lang('lang.tickets'))</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings2_tweak_imap_tickets_import_limit"
                name="settings2_tweak_imap_tickets_import_limit"
                value="{{ $settings->settings2_tweak_imap_tickets_import_limit ?? '' }}">
        </div>
    </div>

    <!--[imap] - connection timeout-->
    <div class="form-group row">
        <label class="col-12 text-left control-label col-form-label required">@lang('lang.imap_connection_timeout')
            (@lang('lang.seconds'))</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings2_tweak_imap_connection_timeout"
                name="settings2_tweak_imap_connection_timeout"
                value="{{ $settings->settings2_tweak_imap_connection_timeout ?? '' }}">
        </div>
    </div>

    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton" class="btn btn-rounded-x btn-danger waves-effect text-left"
            data-url="/settings/tweak" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable">{{ cleanLang(__('lang.save_changes')) }}</button>
    </div>
</form>
@endsection