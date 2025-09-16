@if(isset($checklist->comments) && $checklist->comments->count() > 0)
@foreach($checklist->comments as $comment)
<div class="display-flex flex-row comment-row" id="checklist_comment_{{ $comment->comment_id }}">
    <div class="p-2 comment-avatar">
        <img src="{{ getUsersAvatar($comment->creator->avatar_directory ?? '', $comment->creator->avatar_filename ?? '') }}"
            class="img-circle" alt="{{ $comment->creator->first_name ?? runtimeUnkownUser() }}" width="40">
    </div>
    <div class="comment-text w-100 js-hover-actions">
        <div class="row">
            <div class="col-sm-6 x-name">{{ $comment->creator->first_name ?? runtimeUnkownUser() }}
                {{ $comment->creator->last_name ?? '' }}</div>
            <div class="col-sm-6 text-right">
                <small class="text-muted">{{ runtimeDate($comment->comment_created) }}</small>
                @if(auth()->user()->is_admin || $comment->comment_creatorid == auth()->id())
                <span class="x-action-button p-l-10 display-inline-block">
                    <a href="javascript:void(0)" class="text-danger confirm-action-danger" title="@lang('lang.edit')"
                        data-confirm-title="@lang('lang.delete_item')" data-confirm-text="@lang('lang.are_you_sure')"
                        data-ajax-type="DELETE"
                        data-url="{{ url('/checklists/delete-checklist-comment/'.$comment->comment_id) }}">
                        <small>@lang('lang.delete')</small>
                    </a>
                </span>
                @endif
            </div>
        </div>
        <div class="p-t-4" class="checklist_comment_body">{!! clean($comment->comment_text) !!}</div>
    </div>
</div>
@endforeach
@endif