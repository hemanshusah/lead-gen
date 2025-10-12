<div class="card-comments" id="lead_log_container_{{ $log->lead_log_uniqueid }}">
    <div class="display-flex flex-row comment-row">
        <div class="p-2 comment-avatar">
            <img src="{{ getUsersAvatar($log->creator->avatar_directory ?? '', $log->creator->avatar_filename ?? '') }}"
                class="img-circle" alt="{{ $log->creator->first_name ?? runtimeUnkownUser() }}" width="40">
                <div class="m-t-8">
                    <!--type badge-->
                    @if($log->lead_log_type == 'call')
                    <span class="label label-md label-info ">@lang('lang.call')</span>
                    @elseif($log->lead_log_type == 'meeting')
                    <span class="label label-md label-success ">@lang('lang.meeting')</span>
                    @elseif($log->lead_log_type == 'email')
                    <span class="label label-md label-warning ">@lang('lang.email')</span>
                    @else
                    <span class="label label-md label-default ">@lang('lang.general')</span>
                    @endif

                </div>
        </div>
        <div class="comment-text w-100 js-hover-actions p-b-30">
            <div class="row">
                <div class="col-sm-6 x-name">{{ $log->creator->first_name ?? runtimeUnkownUser() }}
                    {{ $log->creator->last_name ?? '' }}

                </div>
                <div class="col-sm-6 x-meta text-right">
                    <!--meta-->
                    <span class="x-date"><small>{{ runtimeDateAgo($log->lead_log_created ?? '') }}</small></span>


                    <!--actions-->
                    @if(auth()->user()->is_admin || $log->lead_log_creatorid == auth()->id())
                    <span class="comment-actions"> |
                        <!--edit-->
                        <a href="javascript:void(0);" class="text-info ajax-request"
                            data-url="{{ url('/leads/'.$lead->lead_id.'/edit-log/'.$log->lead_log_uniqueid) }}"
                            data-loading-target="lead_log_container_{{ $log->lead_log_uniqueid }}">
                            <small>@lang('lang.edit')</small>
                        </a> |

                        <!--delete-->
                        <a href="javascript:void(0);" class="js-delete-ux-confirm confirm-action-danger text-danger"
                            data-confirm-title="@lang('lang.delete_log')" data-confirm-text="@lang('lang.are_you_sure')"
                            data-ajax-type="DELETE"
                            data-parent-container="lead_log_container_{{ $log->lead_log_uniqueid }}"
                            data-progress-bar="hidden"
                            data-url="{{ url('/leads/'.$lead->lead_id.'/delete-log/'.$log->lead_log_uniqueid) }}">
                            <small>@lang('lang.delete')</small>
                        </a>
                    </span>
                    @endif
                </div>
            </div>
            <div class="p-t-4">{!! clean($log->lead_log_text ?? '') !!}</div>
        </div>
    </div>
</div>