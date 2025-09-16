@extends('pages.settings.ajaxwrapper')
@section('settings-page')

<!--settings-->
<div class="form">

    <!--system information table-->
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <!--crm version-->
                <tr>
                    <td class="w-40">@lang('lang.crm_version')</td>
                    <td>{{ config('system.settings_version') ?? '' }}</td>
                </tr>

                <!--database name-->
                <tr>
                    <td>@lang('lang.database_name')</td>
                    <td>{{ env('DB_DATABASE') }}</td>
                </tr>

                <!--email system-->
                <tr>
                    <td>@lang('lang.email_system')</td>
                    <td>
                        @if(config('system.settings_email_server_type') == 'smtp')
                        @lang('lang.smtp')
                        @else
                        @lang('lang.sendmail')
                        @endif
                    </td>
                </tr>

                <!--last cronjob run-->
                <tr>
                    <td>@lang('lang.last_cronjob_run')</td>
                    <td>
                        @if(config('system.settings_cronjob_last_run'))
                        {{ runtimeDate(config('system.settings_cronjob_last_run')) }}
                        @else
                        @lang('lang.never')
                        @endif
                    </td>
                </tr>

                <!--php version-->
                <tr>
                    <td>@lang('lang.php_version')</td>
                    <td>{{ $php_version }}</td>
                </tr>

                <!--memory limit-->
                <tr>
                    <td>@lang('lang.server_memory_limit')</td>
                    <td>{{ $memory_limit }}</td>
                </tr>

                <!--file upload limit-->
                <tr>
                    <td>@lang('lang.server_file_upload_limit')</td>
                    <td>{{ $upload_max_filesize }}</td>
                </tr>

                <!--files count-->
                <tr>
                    <td>@lang('lang.crm_files_count')</td>
                    <td>{{ $files_count }}</td>
                </tr>


                <!--disc usage-->
                <tr id="crm-hard-disk-usage" data-url="{{ url('/settings/system/disc-usage') }}">
                    <td>@lang('lang.crm_hard_drive_usage')</td>
                    <td>
                        <div id="system-info-disc-usage-loading">
                            <div class="loading-placeholder-container">
                                @lang('lang.calculating') <span class="loading-placeholder"></span>
                            </div>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="modal-selector hidden m-t-30 m-l-0 m-r-0" id="system-info-disc-usage">

    <table class="table table-sm m-b-0">
        <tr>
            <td class="p-l-0">@lang('lang.temp_folder'):</td>
            <td class="text-right font-weight-500" id="system-info-disc-usage-temp">0</td>
        </tr>
        <tr>
            <td class="p-l-0">@lang('lang.logs_folder'):</td>
            <td class="text-right font-weight-500" id="system-info-disc-usage-logs">0</td>
        </tr>
        <tr>
            <td class="p-l-0">@lang('lang.cache_folder'):</td>
            <td class="text-right font-weight-500" id="system-info-disc-usage-cache">0</td>
        </tr>
        <tr class="b-t">
            <td class="p-l-0 font-weight-600">@lang('lang.total'):</td>
            <td class="text-right font-weight-600" id="system-info-disc-usage-total">0</td>
        </tr>
    </table>

    <div class="alert alert-info"><h5 class="text-info"><i class="sl-icon-info"></i> @lang('lang.info')</h5>@lang('lang.cleanup_info')</div>

    <!--cleanup button-->
    <div class="m-t-20 text-right m-b-30">
        <button type="button" class="btn btn-sm btn-danger waves-effect text-left ajax-request"
            data-url="{{ url('/settings/system/cleanup') }}" data-type="form" data-form-id="cleanup-form"
            data-ajax-type="POST" data-loading-target="cleanup-form">
            @lang('lang.free_up_space')
        </button>
    </div>
</div>

<!--load disc usage on page load-->
<script>
    $(document).ready(function () {
        //load disc usage via ajax
        nxAjaxUxRequest($("#crm-hard-disk-usage"));

        //toggle cleanup options
        $("#cleanup-toggle-button").click(function () {
            $("#cleanup-options").toggleClass("hidden");
        });
    });
</script>

@endsection