@extends('pages.settings.ajaxwrapper')
@section('settings-page')
<!--settings-->
<form class="form" id="settingsFormInvoices">
    <!--form text tem-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label">{{ cleanLang(__('lang.invoice_prefix')) }}</label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_invoices_prefix"
                name="settings_invoices_prefix" value="{{ $settings->settings_invoices_prefix ?? '' }}">
        </div>
    </div>


    <!--next id-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label">@lang('lang.next_id_number_invoice') (@lang('lang.optional'))
            <!--info tooltip-->
            <span class="align-middle text-themecontrast" data-toggle="tooltip"
                title="@lang('lang.next_id_number_info')" data-placement="top"><i
                    class="ti-info-alt"></i></span></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="next_id" name="next_id" value="{{ $next_id }}">
            <input type="hidden" name="next_id_current" value="{{ $next_id }}">
        </div>
    </div>

    <!--form text tem-->
    <div class="form-group row">
        <label
            class="col-12 control-label col-form-label font-16">{{ cleanLang(__('lang.bill_recurring_grace_period')) }}
            <span class="align-middle text-themecontrast" data-toggle="tooltip"
                title="{{ cleanLang(__('lang.bill_recurring_grace_period_info')) }}" data-placement="top"><i
                    class="ti-info-alt"></i></span></label>
        <div class="col-12">
            <input type="number" class="form-control form-control-sm" id="settings_invoices_recurring_grace_period"
                name="settings_invoices_recurring_grace_period"
                value="{{ $settings->settings_invoices_recurring_grace_period ?? '' }}">
        </div>
    </div>

    <!--item-->
    <div class="form-group row">
        <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.pdf_font')</label>
        <div class="col-sm-12">
            <select class="select2-basic form-control form-control-sm select2-preselected" id="settings2_dompdf_fonts"
                name="settings2_dompdf_fonts" data-preselected="{{ $settings2->settings2_dompdf_fonts ?? ''}}">
                <option></option>
                <option value="default">@lang('lang.default')</option>
                <option value="dejavu">@lang('lang.language_support_1')</option>
                <option value="chinese-simplified">@lang('lang.language_support_2')</option>
                <option value="chinese-traditional">@lang('lang.language_support_3')</option>
                <option value="japanese">@lang('lang.language_support_4')</option>
                <option value="korean">@lang('lang.language_support_5')</option>
            </select>
        </div>
        <div class="col-sm-12 p-t-20">
            <div class="alert alert-danger">
                @lang('lang.language_support_help')
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 col-form-label">{{ cleanLang(__('lang.terms_and_conditions')) }}</label>
        <div class="col-12 p-t-5">
            <textarea class="form-control form-control-sm tinymce-textarea" rows="5"
                name="settings_invoices_default_terms_conditions" id="settings_invoices_default_terms_conditions">
                    {{ $settings->settings_invoices_default_terms_conditions ?? '' }}
                </textarea>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-12 col-form-label">{{ cleanLang(__('lang.pdf_custom_css')) }} <span
                class="align-middle text-info font-16" data-toggle="tooltip" title="@lang('lang.pdf_custom_css_info')"
                data-placement="top"><i class="ti-info-alt"></i></span></label>
        <div class="col-12 p-t-5">
            <textarea class="form-control form-control-sm" rows="10" name="settings2_bills_pdf_css"
                id="settings2_bills_pdf_css">{{ $settings2->settings2_bills_pdf_css ?? '' }}</textarea>
        </div>
    </div>

    <!--show_project_title_on_invoice-->
    <div class="form-group form-group-checkbox row">
        <div class="col-12 p-t-5">
            <input type="checkbox" id="settings_invoices_show_project_on_invoice"
                name="settings_invoices_show_project_on_invoice" class="filled-in chk-col-light-blue"
                {{ runtimePrechecked($settings['settings_invoices_show_project_on_invoice'] ?? '') }}>
            <label for="settings_invoices_show_project_on_invoice">@lang('lang.show_project_title_on_invoice')</label>
        </div>
    </div>

    <!--show_if_client_has_opened-->
    <div class="form-group form-group-checkbox row">
        <div class="col-12 p-t-5">
            <input type="checkbox" id="settings_invoices_show_view_status" name="settings_invoices_show_view_status"
                class="filled-in chk-col-light-blue"
                {{ runtimePrechecked($settings['settings_invoices_show_view_status'] ?? '') }}>
            <label
                for="settings_invoices_show_view_status">{{ cleanLang(__('lang.show_if_client_has_opened')) }}</label>
        </div>
    </div>

    @if(config('system.settings_type') == 'standalone')
    <!--[standalone] - settings documentation help-->
    @endif

    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton" class="btn btn-rounded-x btn-danger waves-effect text-left"
            data-url="/settings/invoices" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable">{{ cleanLang(__('lang.save_changes')) }}</button>
    </div>
</form>
@endsection