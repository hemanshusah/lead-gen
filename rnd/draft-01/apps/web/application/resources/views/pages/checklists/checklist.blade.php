<!--each checklist-->
@foreach($checklists as $checklist)
<div class="checklist-item global-checklist-item clearfix d-flex align-items-start position-relative"
    id="checklist_container_{{ $checklist->checklist_id }}" data-id="{{ $checklist->checklist_id }}">

    <!--drag icon - first item on the left-->
    <div class="checklist-drag-container flex-shrink-0">
        <span class="mdi mdi-drag-vertical cursor-pointer drag-handle checklist-action-buttons hidden"></span>
    </div>

    <!--checkbox - next item on the left-->
    <div class="checklist-checkbox-container flex-shrink-0 mr-2">
        <input type="checkbox" class="filled-in chk-col-light-blue js-ajax-ux-request-default"
            name="card_checklist[{{ $checklist->checklist_id }}]" data-progress-bar='hidden'
            data-url="{{ urlResource('/checklists/toggle-checklist-status/'.$checklist->checklist_id) }}"
            data-ajax-type="post" data-type="form" data-form-id="checklist_container_{{ $checklist->checklist_id }}"
            data-notifications="disabled" id="checklist_{{ $checklist->checklist_id }}"
            {{ runtimeChecklistCheckbox($checklist->permission_edit_delete_checklist ?? false) }}
            {{ runtimePrechecked($checklist->checklist_status) }}>
        <label class="checklist-label" for="checklist_{{ $checklist->checklist_id }}"></label>
    </div>

    <!--checklist text - middle section with proper padding-->
    <div class="checklist-text-container flex-grow-1 pr-3"
        data-target="edit-checklist-text-container-{{ $checklist->checklist_id }}" data-parent="checklist_container_{{ $checklist->checklist_id }}">
        <span
            class="checklist-text {{ runtimePermissions('checklist-edit', $checklist->permission_edit_delete_checklist ?? false) }}"
            id="checklist-text-{{ $checklist->checklist_id }}" data-toggle="edit"
            data-id="{{ $checklist->checklist_id }}"
            data-action-url="{{ urlResource('/checklists/update-checklist/'.$checklist->checklist_id) }}">{{ $checklist->checklist_text}}</span>
    </div>

    <!--action icons - far right side-->
    @if($checklist->permission_edit_delete_checklist ?? false)
    <div class="checklist-actions-container flex-shrink-0 d-flex align-items-center">
        <!--button to toggle checklist comments wrapper-->
        <a href="javascript:void(0)"
            class="checklist-comments-wrapper-toggle-button text-default checklist-action-buttons hidden mr-2"
            data-checklist-comments-textarea-wrapper="checklist-comments-textarea-wrapper-{{ $checklist->checklist_id }}"
            title="@lang('lang.add_comment')">
            <i class="mdi mdi-comment-outline"></i>
        </a>

        <!--delete checklist button-->
        <a href="javascript:void(0)"
            class="x-action-delete checklist-item-delete checklist-action-buttons hidden js-delete-ux js-ajax-ux-request"
            data-ajax-type="DELETE" data-parent-container="checklist_container_{{ $checklist->checklist_id }}"
            data-progress-bar="hidden"
            data-url="{{ urlResource('/checklists/delete-checklist/'.$checklist->checklist_id) }}"><i
                class="mdi mdi-delete text-default"></i></a>
    </div>
    @endif

    <!--checklist comments wrapper - full width below the main checklist item-->
    <div class="checklist-comments-wrapper w-100" id="checklist-comments-wrapper-{{ $checklist->checklist_id }}">

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

                <!--submit new checklist comment button-->
                <button type="button"
                    class="btn btn-danger btn-xs x-submit-button checklist-comments-submit-button ajax-request"
                    data-url="{{ url('/checklists/post-checklist-comment') }}" data-type="form" data-ajax-type="post"
                    data-form-id="checklist-comments-textarea-wrapper-{{ $checklist->checklist_id }}"
                    data-tinymce-textarea-id="checklist-comments-textarea-{{ $checklist->checklist_id }}"
                    data-button-loading-annimation="yes" data-button-disable-on-click="yes"
                    data-checklist-comments-post-button="checklist-comments-post-button-{{ $checklist->checklist_id }}">
                    @lang('lang.post')
                </button>
            </div>
        </div>

        <!--display existing comments if any-->
        <div class="checklist-comments-list-wrapper hidden"
            id="checklist-comments-list-wrapper-{{ $checklist->checklist_id }}">
            @include('pages.checklists.checklist-comment')
        </div>
    </div>
</div>

<!--edit checklist form-->
<div class="hidden edit-checklist-text-container p-l-25 p-b-30"
    id="edit-checklist-text-container-{{ $checklist->checklist_id }}">
    <textarea class="form-control form-control-sm checklist_text" rows="3" name="checklist_text" id="update-checklist-textarea-{{ $checklist->checklist_id }}">{{ $checklist->checklist_text}}</textarea>
    <div class="text-right">


        <!--close button-->
        <button type="button" class="btn btn-default  btn-xs update-checklist-close-button" 
            data-toggle="close"
            data-checklist-wrapper-target="checklist_container_{{ $checklist->checklist_id }}"
            data-checklist-target="checklist-text-{{ $checklist->checklist_id }}"
            data-textarea-target="update-checklist-textarea-{{ $checklist->checklist_id }}"
            data-form-id="edit-checklist-text-container-{{ $checklist->checklist_id }}"
            href="JavaScript:void(0);">
            @lang('lang.close')
        </button>

        <!--submit new checklist button-->
        <button type="button" class="btn btn-danger  btn-xs x-submit-button update-checklist-submit-button"
            id="new-checklist-text-form-submit-button" data-url="{{ url('/checklists/'.$checklist->checklist_id) }}" data-type="form"
            data-ajax-type="put" 
            data-progress-bar="hidden"
            data-checklist-wrapper-target="checklist_container_{{ $checklist->checklist_id }}"
            data-checklist-target="checklist-text-{{ $checklist->checklist_id }}"
            data-form-id="edit-checklist-text-container-{{ $checklist->checklist_id }}"
            data-loading-target="edit-checklist-text-container-{{ $checklist->checklist_id }}">
            @lang('lang.update')
        </button>
    </div>
</div>

@endforeach