@extends('pages.settings.ajaxwrapper')
@section('settings-page')

<!--tabs menu-->
@include('pages.settings.sections.formbuilder.misc.tabs')

<div id="webform-builder-wraper" class="p-t-40">

    <!--settings-->
    <form class="form" id="webform-builder-settings">


        <!--title-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label">@lang('lang.form_name')</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="webform_title" name="webform_title"
                    value="{{ $webform->webform_title ?? '' }}">
            </div>
        </div>


        <!--thank you message-->
        <div class="form-group row">
            <label class="col-12 text-left control-label col-form-label">@lang('lang.thank_you_message')</label>
            <div class="col-12">
                <textarea class="form-control form-control-sm tinymce-textarea-extended" rows="5"
                    name="webform_thankyou_message" id="webform_thankyou_message">
                    {!! $webform->webform_thankyou_message ?? '' !!}
                </textarea>
            </div>
        </div>


        <!--notify admin-->
        <div class="form-group row">
            <label
                class="col-12 text-left control-label col-form-label">@lang('lang.send_admin_email_notification')</label>
            <div class="col-12">
                <select class="select2-basic form-control form-control-sm select2-preselected" id="webform_notify_admin"
                    name="webform_notify_admin" data-preselected="{{ $webform->webform_notify_admin ?? ''}}">
                    <option value="no">@lang('lang.no')</option>
                    <option value="yes">@lang('lang.yes')</option>
                </select>
            </div>
        </div>

        <!--lead title-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label">@lang('lang.lead_title')</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="webform_lead_title"
                    name="webform_lead_title" value="{{ $webform->webform_lead_title ?? $webform->webform_title }}">
            </div>
        </div>

        <!--lead status-->
        <div class="form-group row">
            <label
                class="col-12 text-left control-label col-form-label">{{ cleanLang(__('lang.new_lead_status')) }}</label>
            <div class="col-12">
                <select class="select2-basic form-control form-control-sm" id="webform_lead_status"
                    name="webform_lead_status">
                    @foreach($statuses as $status)
                    <option value="{{ $status->leadstatus_id }}"
                        {{ runtimePreselected($webform->webform_lead_status ?? '', $status->leadstatus_id) }}>
                        {{ $status->leadstatus_title }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <!--webform_recaptcha-->
        <div class="form-group row">
            <label class="col-12 text-left control-label col-form-label required">reCAPTCHA <span
                    class="align-middle text-info font-16" data-toggle="tooltip"
                    title="@lang('lang.webform_recaptcha_info')" data-placement="top"><i
                        class="ti-info-alt"></i></span></label>
            <div class="col-12 m-b-20">
                <select class="select2-basic form-control form-control-sm select2-preselected" id="webform_recaptcha"
                    name="webform_recaptcha" data-preselected="{{ $webform->webform_recaptcha ?? ''}}">
                    <option></option>
                    <option value="enabled">@lang('lang.enabled')</option>
                    <option value="disabled">@lang('lang.disabled')</option>
                </select>
            </div>
            <div class="col-12 m-b-30">
                <div class="alert alert-info m-b-0">@lang('lang.recaptcha_complete_settings')</div>
            </div>
        </div>

        <!--submit button text-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label">@lang('lang.submit_button_text')</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="webform_submit_button_text"
                    name="webform_submit_button_text" value="{{ $webform->webform_submit_button_text ?? '' }}">
            </div>
        </div>

        <!--buttons-->
        <div class="text-right" id="webform-builder-settings-buttons">
            <button type="submit" id="commonModalSubmitButton"
                class="btn btn-rounded-x btn-danger waves-effect text-left js-ajax-ux-request"
                data-url="{{ url('settings/formbuilder/'.$webform->webform_id.'/settings') }}" data-type="form"
                data-form-id="webform-builder-settings" data-ajax-type="post"
                data-loading-target="webform-builder-settings-buttons">{{ cleanLang(__('lang.save_changes')) }}</button>
        </div>
    </form>

</div>

@endsection