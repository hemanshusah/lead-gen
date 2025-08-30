<div class="display-flex flex-row comment-row" id="checklist_comment_{{ $comment->comment_id }}">
    <div class="p-2 comment-avatar">
        <img src="{{ getUsersAvatar($comment->creator->avatar_directory ?? '', $comment->creator->avatar_filename ?? '') }}"
            class="img-circle" alt="{{ $comment->creator->first_name ?? runtimeUnkownUser() }}" width="40">
    </div>
    <div class="comment-text w-100 js-hover-actions">
        <div class="row">
            <div class="col-sm-6 x-name">{{ $comment->creator->first_name ?? runtimeUnkownUser() }}</div>
            <div class="col-sm-6 x-meta text-right">
                <!--meta-->
                <span class="x-date"><small>{{ runtimeDateAgo($comment->comment_created) }}</small></span>
                <!--actions: delete-->
                @if($comment->comment_creatorid = auth()->id() || auth()->user()->role_id == 1)
                <span class="comment-actions"> |
                    <a href="javascript:void(0)" class="js-delete-ux-confirm confirm-action-danger text-danger"
                        data-confirm-title="@lang('lang.delete_item')" data-confirm-text="@lang('lang.are_you_sure')"
                        data-ajax-type="DELETE" data-parent-container="checklist_comment_{{ $comment->comment_id }}"
                        data-progress-bar="hidden"
                        data-url="{{ urlResource('/tasks/'.$comment->comment_id.'/delete-checklist-comment') }}">
                        <small>@lang('lang.delete')</small>
                    </a>
                </span>
                @endif
            </div>
        </div>
        <div class="p-t-4" class="checklist_comment_body">{!! clean($comment->comment_text) !!}</div>
    </div>
</div>