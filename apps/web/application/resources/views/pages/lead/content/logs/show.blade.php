<!--heading-->
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i>@lang('lang.lead_logs')</div>

<!--[create new log]-->
<div class="post-comment" id="post-card-comment-form">
    <!--placeholder textbox-->
    <div class="x-message-field x-message-field-placeholder m-b-10" id="card-coment-placeholder-input-container"
        data-show-element-container="card-comment-tinmyce-container">
        <textarea class="form-control form-control-sm w-100" rows="1"
            id="card-coment-placeholder-input">@lang('lang.record_a_log')...</textarea>
    </div>
    <!--rich text editor-->
    <div class="x-message-field hidden" id="card-comment-tinmyce-container">
        <!--tinymce editor-->
        <textarea class="form-control form-control-sm w-99 tinymce-textarea" rows="2" id="card-comment-tinmyce" name="lead_log_text"></textarea>

        <!--Log Type-->
        <div class="form-group row m-t-10">
            <label class="col-sm-12 text-left control-label col-form-label required">@lang('lang.log_type')*</label>
            <div class="col-sm-12">
                <select class="select2-basic form-control form-control-sm" id="lead_log_type" name="lead_log_type">
                    <option value="general">@lang('lang.general')</option>
                    <option value="call">@lang('lang.call')</option>
                    <option value="meeting">@lang('lang.meeting')</option>
                    <option value="email">@lang('lang.email')</option>
                </select>
            </div>
        </div>

        <!--close button-->
        <div class="x-button p-t-10 p-b-10 text-right">
            <button type="button" class="btn btn-default btn-sm" id="card-comment-close-button">
                @lang('lang.close')
            </button>
            <!--submit button-->
            <button type="button" class="btn btn-danger btn-sm x-submit-button ajax-request"
                data-url="{{ url('/leads/'.$lead->lead_id.'/store-log') }}" data-type="form" data-ajax-type="post"
                data-form-id="post-card-comment-form" data-loading-target="card-coment-placeholder-input-container">
                @lang('lang.post')
            </button>
        </div>
    </div>
</div>

<!--List of log entries-->
<div class="card-show-form-data" id="lead-logs-container">
    @if(count($logs ?? []) > 0)
        @include('pages.lead.content.logs.log')
    @else
    <div class="x-no-result">
        <img src="{{ url('/') }}/public/images/no-download-avialble.png" alt="404 - Not found" />
        <div class="p-t-20">
            <h4>@lang('lang.you_do_not_have_logs')</h4>
        </div>
    </div>
    @endif
</div>