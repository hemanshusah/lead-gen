<div class="card" id="comments-wrapper">
    @php $unique_comment_id = str_random(10) ; @endphp

    <div class="comments card-body" id="js-trigger-comments" data-payload="{{ $unique_comment_id }}">

        <!--star/unstar buttons-->
        @if(request('commentresource_type') == 'project' && request('commentresource_id') && isset($project) &&
        request('source') != 'starred')
        <div class="text-right m-b-20">
            <!--star button-->
            <button type="button"
                class="btn btn-sm btn-outline-default ajax-request {{ $project->is_comment_starred ? 'hidden' : '' }}"
                id="starred-star-button"
                data-url="{{ url('/starred/togglestatus?action=star&resource_type=project-comments&resource_id='.$project->project_id) }}"
                data-loading-target="starred-star-button" data-ajax-type="POST" data-on-start-submit-button="disable">
                <i class="ti-star"></i> @lang('lang.star_project_comments')
            </button>

            <!--unstar button-->
            <button type="button"
                class="btn btn-sm btn-warning ajax-request {{ !$project->is_comment_starred ? 'hidden' : '' }}"
                id="starred-unstar-button"
                data-url="{{ url('/starred/togglestatus?action=unstar&resource_type=project-comments&resource_id='.$project->project_id) }}"
                data-loading-target="starred-unstar-button" data-ajax-type="POST" data-on-start-submit-button="disable">
                <i class="ti-star"></i> @lang('lang.unstar_project_comments')
            </button>
        </div>
        @endif

        <!--complete commenting form-->
        @if(config('visibility.post_new_comment_form'))
        <div class="post-comment display-flex flex-row" id="form-{{ $unique_comment_id }}">
            <div class="x-avatar">
                <img src="{{ auth()->user()->avatar }}" class="img-circle" alt="user" width="40">
            </div>
            <!--placeholder textbox-->
            <div class="form-group row x-message-field x-message-field-placeholder js-toggle-placeholder-element"
                id="placeholder-container-{{ $unique_comment_id }}"
                data-show-element-container="editor-container-{{ $unique_comment_id }}">
                <textarea class="form-control form-control-sm w-100"
                    rows="1">{{ cleanLang(__('lang.post_a_comment')) }}...</textarea>
            </div>
            <!--rich text editor-->
            <div class="form-group row x-message-field hidden" id="editor-container-{{ $unique_comment_id }}">
                <!--tinymce editor-->
                <textarea class="form-control form-control-sm w-100 tinymce-textarea" rows="2"
                    id="editor-{{ $unique_comment_id }}" name="comment_text" id="comment_text"></textarea>
                <!--close button-->
                <a class="x-close-button  js-toggle-close-button" href="JavaScript:void(0);"
                    data-hide-element-container="editor-container-{{ $unique_comment_id }}"
                    data-show-element-container="placeholder-container-{{ $unique_comment_id }}">
                    <i class="ti-close"></i>
                </a>
                <!--submit button-->
                <button type="button" class="btn btn-danger btn-icon-circle js-ajax-ux-request x-submit-button"
                    data-url="{{ urlResource('/comments') }}" data-type="form" data-ajax-type="post"
                    data-form-id="form-{{ $unique_comment_id }}" data-loading-target="comments-container">
                    <i class="sl-icon-paper-plane"></i>
                </button>
                <!--meta-->
                <input type="hidden" name="placeholder-container"
                    value="placeholder-container-{{ $unique_comment_id }}">
                <input type="hidden" name="editor-container" value="editor-container-{{ $unique_comment_id }}">
                <input type="hidden" name="editor" value="editor-{{ $unique_comment_id }}">
            </div>
        </div>
        @endif
        <!--/#complete commenting form-->

        <!--ajax content here-->
        <div class="comment-widgets comments-container" id="comments-container">
            <!--nothing found-->
            @if (@count($comments ?? []) == 0) @include('notifications.no-results-found') @endif
            <!--nothing found-->
            @include('pages.comments.components.ajax')
        </div>
        <!--ajax content here-->

        <!--load more button-->
        @include('misc.load-more-button')
        <!--load more button-->

    </div>
</div>