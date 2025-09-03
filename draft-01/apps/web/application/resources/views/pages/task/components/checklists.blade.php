<!--checklist container-->
<div class="card-checklist checklist-comments-visible" id="card-checklist">
    <div class="x-heading clearfix">
        <span class="pull-left"><i class="mdi mdi-checkbox-marked"></i>{{ cleanLang(__('lang.checklist')) }}</span>
        <span class="pull-right p-t-5" id="card-checklist-progress">{{ $progress['completed'] }}</span>
    </div>
    <div class="progress" id="card-checklist-progress-container">
        @include('pages.task.components.progressbar')
    </div>
    <div class="x-content" id="card-checklists-container" data-progress-bar="hidden" data-type="form"
        data-ajax-type="post" data-form-id="card-checklists-container"
        data-url="{{ url('/tasks/update-checklist-positions') }}">
        <!--dynamic content here-->
        @if(config('response.import'))
        @include('pages.task.components.checklist')
        @endif
    </div>
    @if($task->permission_edit_task)
    <div class="x-action p-b-20">
        <a href="javascript:void(0)" class="js-card-checklist-toggle" id="card-checklist-add-new"
            data-action-url="{{ urlResource('/tasks/'.$task->task_id.'/add-checklist') }}"
            data-toggle="new">{{ cleanLang(__('lang.add_new_item')) }}</a>

        <!-- Import Checklist Items Link -->
        <a href="javascript:void(0);" id="import-checklist-link" class="p-l-10">@lang('lang.import_checklist_items')</a>

        <!--Hide & Show checklist comments-->
        <a href="javascript:void(0);" class="p-l-10 checklist-comments-hide-button">@lang('lang.hide_checklist_comments')</a>
        <a href="javascript:void(0);" class="p-l-10 checklist-comments-show-button">@lang('lang.show_comments')</a>

    </div>

    <!-- Import Checklist Container -->
    <div class="hidden" id="import-checklist-container" 
        data-initial-url="{{ url('/fileupload') }}"
        data-url="{{ url('tasks/'.$task->task_id.'/import-checklists') }}" 
        data-type="form" 
        data-form-id="import-checklist-container" 
        data-ajax-type="post" 
        data-loading-target="import-checklist-file">
        <div class="x-content">
            <div class="dropzone dz-clickable" id="import-checklist-file">
                <div class="dz-default dz-message">
                    <i class="icon-Upload-toCloud"></i>
                    <span>@lang('lang.drag_drop_checklist_file')</span>
                    <small>Excel - CSV - TXT</small>

                </div>
            </div>
        </div>
        <!--dynamix file details-->
        <div id="import-checklist-file-payload"></div>
    </div>
    @endif
</div>