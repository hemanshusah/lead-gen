<!--each reply-->
@foreach($replies as $reply)
<!--do not show [notes] to client users-->
@if((auth()->user()->is_client && $reply->ticketreply_type == 'reply') || auth()->user()->is_team)
<div class="comment-widgets ticket_reply_type_{{ $reply->ticketreply_type }}"
    id="ticket_reply_{{ $reply->ticketreply_id }}">
    <div class="d-flex flex-row comment-rowp-b-0">
        <div class="p-2"><span class="round"><img
                    src="{{ getUsersAvatar($reply->avatar_directory, $reply->avatar_filename)  }}" width="50"></span>
        </div>
        <div class="comment-text w-100">

            <!--note icon-->
            <span class="label label-default label-sm hidden ticket_reply_note_icon">ticket note</span>

            <h5 class="m-b-0">

                @if(config('visibility.show_contact_profile'))
                <a href="javascript:void(0);"
                    class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form user_profile_name_{{ $reply->id }}"
                    data-toggle="modal" data-target="#commonModal" data-url="{{ url('contacts/'.$reply->id) }}"
                    data-loading-target="commonModalBody" data-modal-title="" data-modal-size="modal-md"
                    data-header-close-icon="hidden" data-header-extra-close-icon="visible"
                    data-footer-visibility="hidden"
                    data-action-ajax-loading-target="commonModalBody">{{ $reply->first_name ?? runtimeUnkownUser() }}
                    {{ $reply->last_name ?? ''}}
                </a>
                @else
                {{ $reply->first_name ?? runtimeUnkownUser() }} {{ $reply->last_name ?? ''}}
                @endif

            </h5>

            <div class="text-muted m-b-5"><small class="text-muted">
                    {{ runtimeDate($reply->ticketreply_created) }} -
                    ({{ runtimeDateAgo($reply->ticketreply_created) }})</small>

            </div>

            <div id="ticket_reply_text_{{ $reply->ticketreply_id }}">
                {!! $reply->ticketreply_text !!}
            </div>

            <div id="ticket_edit_reply_container_{{ $reply->ticketreply_id }}">
                <!--dynamic content-->
            </div>

            <!--action buttons [edit & delete]-->
            @if(permissionEditTicketReply($reply))
            <div class="text-right">
                <!--edit reply-->
                <small><a class="text-muted ajax-request"
                        data-loading-target="ticket_reply_text_{{ $reply->ticketreply_id }}" href="javascript:void(0);"
                        data-url="{{ url('tickets/'.$reply->ticketreply_id.'/edit-reply') }}">@lang('lang.edit')</a></small>
                |
                <!--delete reply-->
                <small><a class="text-muted confirm-action-danger" href="javascript:void(0);"
                        data-confirm-title="@lang('lang.delete_reply')" data-confirm-text="@lang('lang.are_you_sure')"
                        data-ajax-type="DELETE"
                        data-url="{{ url('tickets/'.$reply->ticketreply_id.'/delete-reply') }}">@lang('lang.delete')</a></small>
            </div>
            @endif
        </div>
    </div>

    <!--ticket attachements-->
    @if($reply->attachments_count > 0)
    <div class="x-attachements">
        <!--attachments container-->
        <div class="row">
            <!--attachments-->
            @foreach($reply->attachments as $attachment)
            @include('pages.ticket.components.attachments')
            @endforeach
        </div>
    </div>
    @endif
</div>
@endif
@endforeach