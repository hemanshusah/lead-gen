@extends('pages.settings.ajaxwrapper')
@section('settings-page')
<!--settings-->
<form class="form">
    <!--allow registration-->
    <div class="form-group form-group-checkbox row">
        <label class="col-4 col-form-label">{{ cleanLang(__('lang.allow_customers_to_signup')) }}</label>
        <div class="col-8 p-t-5">
            <input type="checkbox" id="settings_clients_registration" name="settings_clients_registration"
                class="filled-in chk-col-light-blue"
                {{ runtimePrechecked($settings['settings_clients_registration'] ?? '') }}>
            <label for="settings_clients_registration"></label>
        </div>
    </div>

    <!--allow clients to login-->
    <div class="form-group form-group-checkbox row">
        <label class="col-4 col-form-label">{{ cleanLang(__('lang.allow_clients_to_login')) }}</label>
        <div class="col-8 p-t-5">
            <input type="checkbox" id="settings_clients_app_login" name="settings_clients_app_login"
                class="filled-in chk-col-light-blue"
                {{ runtimePrechecked($settings['settings_clients_app_login'] ?? '') }}>
            <label for="settings_clients_app_login"></label>
        </div>
    </div>


    <!--enable shipping address-->
    <div class="form-group form-group-checkbox row">
        <label class="col-4 col-form-label">{{ cleanLang(__('lang.enable_shipping_address')) }}</label>
        <div class="col-8 p-t-5">
            <input type="checkbox" id="settings_clients_shipping_address" name="settings_clients_shipping_address"
                class="filled-in chk-col-light-blue"
                {{ runtimePrechecked($settings['settings_clients_shipping_address'] ?? '') }}>
            <label for="settings_clients_shipping_address"></label>
        </div>
    </div>

    <!--disable emails-->
    <div class="form-group form-group-checkbox row">
        <label class="col-4 col-form-label">{{ cleanLang(__('lang.disable_all_client_emails')) }}</label>
        <div class="col-8 p-t-5">
            <input type="checkbox" id="settings_clients_disable_email_delivery"
                name="settings_clients_disable_email_delivery" class="filled-in chk-col-light-blue"
                {{ runtimePrechecked($settings['settings_clients_disable_email_delivery'] ?? '') }}>
            <label for="settings_clients_disable_email_delivery"></label>
        </div>
    </div>

    <!--importing settings-->
    <h5 class="p-t-20">{{ cleanLang(__('lang.importing_clients_settings')) }}</h5>
    <div class="line"></div>

    <div class="modal-selector m-t-5 m-l-0 m-r-0">
        
        <h6 class="m-b-20">@lang('lang.avoid_duplicates') <span class="align-middle text-info font-16"
                data-toggle="tooltip" title="@lang('lang.avoid_duplicates_info')" data-placement="top"><i
                    class="ti-info-alt"></i></span></h6>


        <!--settings2_importing_clients_duplicates_company-->
        <div class="form-group form-group-checkbox row">
            <label class="col-4 col-form-label text-left">@lang('lang.company_name')</label>
            <div class="col-8 text-left p-t-5">
                <input type="checkbox" id="settings2_importing_clients_duplicates_company"
                    name="settings2_importing_clients_duplicates_company" class="filled-in chk-col-light-blue"
                    {{ runtimePrechecked($settings2->settings2_importing_clients_duplicates_company ?? '') }}>
                <label class="p-l-30" for="settings2_importing_clients_duplicates_company"></label>
            </div>
        </div>


        <!--settings2_importing_clients_duplicates_email-->
        <div class="form-group form-group-checkbox row">
            <label class="col-4 col-form-label text-left">@lang('lang.email')</label>
            <div class="col-8 text-left p-t-5">
                <input type="checkbox" id="settings2_importing_clients_duplicates_email"
                    name="settings2_importing_clients_duplicates_email" class="filled-in chk-col-light-blue"
                    {{ runtimePrechecked($settings2->settings2_importing_clients_duplicates_email ?? '') }}>
                <label class="p-l-30" for="settings2_importing_clients_duplicates_email"></label>
            </div>
        </div>


        <!--settings2_importing_clients_duplicates_telephone-->
        <div class="form-group form-group-checkbox row">
            <label class="col-4 col-form-label text-left">@lang('lang.telephone')</label>
            <div class="col-8 text-left p-t-5">
                <input type="checkbox" id="settings2_importing_clients_duplicates_telephone"
                    name="settings2_importing_clients_duplicates_telephone" class="filled-in chk-col-light-blue"
                    {{ runtimePrechecked($settings2->settings2_importing_clients_duplicates_telephone ?? '') }}>
                <label class="p-l-30" for="settings2_importing_clients_duplicates_telephone"></label>
            </div>
        </div>

    </div>

    @if(config('system.settings_type') == 'standalone')
    <!--[standalone] - settings documentation help-->
    @endif

    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton"
            class="btn btn-rounded-x btn-danger waves-effect text-left js-ajax-ux-request" data-url="/settings/clients"
            data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable">{{ cleanLang(__('lang.save_changes')) }}</button>
    </div>
</form>
@endsection