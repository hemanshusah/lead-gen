<!--settings2_tickets_imap_status-->
<div class="form-group row p-b-10">
    <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.email_integration_status') (IMAP)<span
            class="align-middle text-info font-16" data-toggle="tooltip"
            title="@lang('lang.department_email_integration_info')" data-placement="top"><i
                class="ti-info-alt"></i></span></label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm select2-preselected" id="category_email_integration"
            name="category_email_integration" data-preselected="{{ $category->category_meta_4 ?? ''}}">
            <option></option>
            <option value="enabled">@lang('lang.enabled')</option>
            <option value="disabled">@lang('lang.disabled')</option>
        </select>
    </div>
</div>


<!--imap settings options container-->
<div class="card-contrast-panel m-l-30  p-l-40 p-r-40 {{ ticketsImapSettingsVisibility($category->category_meta_4 ?? '') }}"
    id="category_imap_settings_container">

    <h4>@lang('lang.department_email_imap')</h4>

    <div class="alert alert-info m-t-20 m-b-30">
        @lang('lang.department_email_integration_info')
    </div>

    <!--imap_email (category_meta_5)-->
    <div class="form-group row">
        <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.email_address') <span
            class="align-middle text-danger font-16" data-toggle="tooltip"
            title="@lang('lang.see_notice_below')" data-placement="top"><i
                class="ti-info-alt"></i></span></label>
        <div class="col-sm-12 col-lg-9">
            <input type="text" class="form-control form-control-sm" id="category_meta_5" name="category_meta_5"
                value="{{ $category->category_meta_5 ?? '' }}">
        </div>
    </div>

    <!--imap_username (category_meta_6)-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.user_name') <span
                class="align-middle text-info font-16" data-toggle="tooltip"
                title="@lang('lang.usually_same_as_email_address')" data-placement="top"><i
                    class="ti-info-alt"></i></span></label>
        <div class="col-sm-12 col-lg-9">
            <input type="text" class="form-control form-control-sm" id="category_meta_6" name="category_meta_6"
                value="{{ $category->category_meta_6 ?? '' }}">
        </div>
    </div>

    <!--imap_password (category_meta_7)-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.password')</label>
        <div class="col-sm-12 col-lg-9">
            <input type="text" class="form-control form-control-sm" id="category_meta_7" name="category_meta_7"
                value="{{ $category->category_meta_7 ?? '' }}">
        </div>
    </div>

    <!--imap_host (category_meta_8)-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.host')</label>
        <div class="col-sm-12 col-lg-9">
            <input type="text" class="form-control form-control-sm" id="category_meta_8" name="category_meta_8"
                value="{{ $category->category_meta_8 ?? '' }}">
        </div>
    </div>

    <!--imap_port (category_meta_9)-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.port')</label>
        <div class="col-sm-12 col-lg-9">
            <input type="text" class="form-control form-control-sm" id="category_meta_9" name="category_meta_9"
                value="{{ $category->category_meta_9 ?? '' }}">
        </div>
    </div>

    <!--imap_encryption (category_meta_10)-->
    <div class="form-group row">
        <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.encryption')</label>
        <div class="col-sm-12 col-lg-9">
            <select class="select2-basic form-control form-control-sm select2-preselected" id="category_meta_10"
                name="category_meta_10" data-preselected="{{ $category->category_meta_10 ?? ''}}">
                <option value="none">@lang('lang.none')</option>
                <option value="ssl">SSL</option>
                <option value="tls">TLS</option>
            </select>
        </div>
    </div>


    <div class="line"></div>

    <div class="alert alert-warning">
        <h5 class="text-danger"><i class="sl-icon-info"></i> @lang('lang.important_notice')</h5>@lang('lang.tickets_imap_warning')
    </div>


    <!--type-->
    <input type="hidden" name="test_imap_type" value="ticket-category">
    <input type="hidden" value="mark_as_read" name="category_meta_11">

    <!--form buttons-->
    <div class="text-right p-t-30">
        <button type="button" id="imap_test_connection_button"
            class="btn btn-rounded-x btn-info waves-effect text-left js-ajax-ux-request"
            data-button-disable-on-click="yes" data-button-loading-annimation="yes"
            data-form-id="category_imap_settings_container" data-url="/settings/tickets/emailintegration/test"
            data-loading-target="" data-ajax-type="post" data-type="form"
            data-on-start-submit-button="disable">{{ cleanLang(__('lang.test_imap_connection')) }}</button>
    </div>
</div>