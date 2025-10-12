<div id="lead_log_editing_wrapper_{{ $log->lead_log_uniqueid }}">
    <!--content-->
    <div class="x-content">
        <form id="lead_log_edit_form_{{ $log->lead_log_uniqueid }}">

            <!--tinymce editor-->
            <textarea class="form-control form-control-sm tinymce-textarea" rows="4"
                id="lead_log_text_editor_{{ $log->lead_log_uniqueid }}"
                name="lead_log_text">{{ $log->lead_log_text ?? '' }}</textarea>

            <!--Log Type-->
            <div class="form-group row m-t-10">
                <label class="col-sm-12 text-left control-label col-form-label">@lang('lang.log_type')</label>
                <div class="col-sm-12">
                    <select class="select2-basic form-control form-control-sm" name="lead_log_type">
                        <option value="general" @if($log->lead_log_type == 'general') selected
                            @endif>@lang('lang.general')</option>
                        <option value="call" @if($log->lead_log_type == 'call') selected @endif>@lang('lang.call')
                        </option>
                        <option value="meeting" @if($log->lead_log_type == 'meeting') selected
                            @endif>@lang('lang.meeting')</option>
                        <option value="email" @if($log->lead_log_type == 'email') selected @endif>@lang('lang.email')
                        </option>
                    </select>
                </div>
            </div>

            <!--hidden id-->
            <input type="hidden" name="lead_log_uniqueid" value="{{ $log->lead_log_uniqueid ?? '' }}">

            <!--buttons-->
            <div class="text-right p-t-10 p-b-30">

                <!--close button-->
                <button type="button" class="btn btn-default btn-sm lead_log_edit_clode_button"
                    data-log-id="{{ $log->lead_log_uniqueid }}"
                    id="lead_log_edit_close_{{ $log->lead_log_uniqueid }}">
                    @lang('lang.close')
                </button>

                <!--update button-->
                <button type="button" class="btn btn-info btn-sm ajax-request"
                    data-url="{{ url('/leads/'.$lead->lead_id.'/update-log/'.$log->lead_log_uniqueid) }}"
                    data-type="form" data-form-id="lead_log_edit_form_{{ $log->lead_log_uniqueid }}"
                    data-ajax-type="PUT" data-loading-target="lead_log_editing_wrapper_{{ $log->lead_log_uniqueid }}">
                    @lang('lang.update')
                </button>
            </div>

        </form>
    </div>
</div>