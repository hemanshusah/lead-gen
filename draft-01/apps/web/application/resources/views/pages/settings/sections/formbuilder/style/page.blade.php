@extends('pages.settings.ajaxwrapper')
@section('settings-page')

<!--tabs menu-->
@include('pages.settings.sections.formbuilder.misc.tabs')

<div id="webform-builder-wraper" class="p-t-40">

    <!--settings-->
    <form class="form" id="webform-builder-settings">

        <div class="m-b-30">
            <textarea id="css-editor-textarea" class="hidden" name="webform_style_css" data-crm-theme="{{ auth()->user()->pref_theme }}">{{  $webform->webform_style_css ?? '' }}</textarea>
        </div>

        <div class="alert alert-info">@lang('lang.custom_css_webform')</div>

        <!--buttons-->
        <div class="text-right" id="webform-builder-settings-buttons">
            <button type="submit" id="commonModalSubmitButton"
                class="btn btn-rounded-x btn-danger waves-effect text-left js-ajax-ux-request"
                data-url="{{ url('settings/formbuilder/'.$webform->webform_id.'/style') }}" data-type="form"
                data-form-id="webform-builder-settings" data-ajax-type="post"
                data-loading-target="webform-builder-settings-buttons">{{ cleanLang(__('lang.save_changes')) }}</button>
        </div>
    </form>

</div>
@endsection