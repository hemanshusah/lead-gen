<!--each checklist-->
@foreach($checklists as $checklist)
<div class="checklist-item clearfix" id="task_checklist_container_{{ $checklist->checklist_id }}"
    data-id="{{ $checklist->checklist_id }}">
    <!--drag icon-->
    <span class="mdi mdi-drag-vertical cursor-pointer drag-handle position-absolute left-3 top-4 hidden"></span>
    <!--checkbox-->
    <input type="checkbox" class="filled-in chk-col-light-blue js-ajax-ux-request-default"
        name="card_checklist[{{ $checklist->checklist_id }}]" data-progress-bar='hidden'
        data-url="{{ urlResource('/tasks/toggle-checklist-status/'.$checklist->checklist_id) }}" data-ajax-type="post"
        data-type="form" data-form-id="task_checklist_container_{{ $checklist->checklist_id }}"
        data-notifications="disabled" id="task_checklist_{{ $checklist->checklist_id }}"
        {{ runtimeChecklistCheckbox($checklist->permission_edit_delete_checklist) }}
        {{ runtimePrechecked($checklist->checklist_status) }}>
    <label class="checklist-label" for="task_checklist_{{ $checklist->checklist_id }}"></label>
    <span
        class="checklist-text {{ runtimePermissions('task-edit-checklist', $checklist->permission_edit_delete_checklist) }}"
        data-toggle="edit" data-id="{{ $checklist->checklist_id }}"
        data-action-url="{{ urlResource('/tasks/update-checklist/'.$checklist->checklist_id) }}">{{ $checklist->checklist_text}}</span>
    @if($checklist->permission_edit_delete_checklist)

    <!--button to toggle checklist comments wrapper-->
    <a href="javascript:void(0)"
        class="checklist-comments-wrapper-toggle-button text-info checklist-action-buttons hidden"
        data-checklist-comments-textarea-wrapper="checklist-comments-textarea-wrapper-{{ $checklist->checklist_id }}"
        title="@lang('lang.add_comment')">
        <i class="mdi mdi-comment-outline"></i>
    </a>

    <!--delete action-->
    <a href="javascript:void(0)"
        class="x-action-delete checklist-item-delete checklist-action-buttons hidden m-r-5 js-delete-ux js-ajax-ux-request"
        data-ajax-type="DELETE" data-parent-container="task_checklist_container_{{ $checklist->checklist_id }}"
        data-progress-bar="hidden" data-url="{{ urlResource('/tasks/delete-checklist/'.$checklist->checklist_id) }}"><i
            class="mdi mdi-delete text-danger"></i></a>
    @endif


    <!--checklist comments wrapper-->
    <div class="checklist-comments-wrapper" id="checklist-comments-wrapper-{{ $checklist->checklist_id }}">

        <!--post comment textarea wrapper; hidden by default-->
        <div class="checklist-comments-textarea-wrapper hidden"
            id="checklist-comments-textarea-wrapper-{{ $checklist->checklist_id }}">

            <!--tinymce textarea-->
            <textarea class="form-control form-control-sm" rows="4" name="checklist-comment"
                id="checklist-comments-textarea-{{ $checklist->checklist_id }}"></textarea>

            <!--checklist id hidden field-->
            <input type="hidden" name="checklist-comments-checklist-id" value="{{ $checklist->checklist_id }}">

            <!--cancel button-->
            <div class="text-right">
                <button type="button" class="btn btn-default btn-xs checklist-comments-close-button"
                    data-tinymce-textarea-id="checklist-comments-textarea-{{ $checklist->checklist_id }}"
                    data-textarea-wrapper="checklist-comments-textarea-wrapper-{{ $checklist->checklist_id }}"
                    data-checklist-comments-post-button="checklist-comments-post-button-{{ $checklist->checklist_id }}">
                    @lang('lang.close')
                </button>

                <!--submit button-->
                <button type="button" class="btn btn-danger btn-xs x-submit-button checklist-comments-submit-button ajax-request"
                    data-url="{{ url('/tasks/'.$checklist->checklistresource_id.'/post-checklist-comment') }}"
                    data-type="form" data-ajax-type="post"
                    data-form-id="checklist-comments-textarea-wrapper-{{ $checklist->checklist_id }}"
                    data-tinymce-textarea-id="checklist-comments-textarea-{{ $checklist->checklist_id }}"
                    data-button-loading-annimation="yes"
                    data-button-disable-on-click="yes"
                    data-checklist-comments-post-button="checklist-comments-post-button-{{ $checklist->checklist_id }}">
                    @lang('lang.post')
                </button>
            </div>
        </div>

        <!--display existing comments if any-->
        <div class="checklist-comments-list-wrapper hidden"
            id="checklist-comments-list-wrapper-{{ $checklist->checklist_id }}">
            @if($checklist->comments && $checklist->comments->count() > 0)
            @foreach($checklist->comments as $comment)
            @include('pages.task.components.checklist-comment')
            @endforeach
            @endif
        </div>
    </div>
</div>

@endforeach