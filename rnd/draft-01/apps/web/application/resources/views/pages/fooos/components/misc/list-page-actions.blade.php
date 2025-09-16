<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right" id="list-page-actions-container">
    <div id="list-page-actions">

        <!--[template] search box-->
        @if( config('visibility.actions_buttons_search'))
        <div class="header-search" id="header-search">
            <i class="sl-icon-magnifier"></i>
            <input type="text" class="form-control search-records list-actions-search"
                data-url="{{ url('fooos/search?action=search') }}" data-type="form" data-ajax-type="post"
                data-form-id="header-search" id="search_query" name="search_query"
                placeholder="@lang('lang.search')">
        </div>
        @endif

        <!--[template] open filter panel button-->
        @if(config('visibility.actions_buttons_filter'))
        <button type="button" data-toggle="tooltip" title="@lang('lang.filter')}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="sidepanel-filter-fooos">
            <i class="mdi mdi-filter-outline"></i>
        </button>
        @endif

        <!--[template] add new fooo button-->
        @if(config('visibility.actions_buttons_add'))
        <button type="button"
            class="btn btn-danger btn-add-circle edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" 
            data-target="#commonModal"
            data-url="{{ url('fooos/create')) }}"
            data-loading-target="commonModalBody" 
            data-modal-title="@lang('lang.add_fooo')"
            data-action-url="{{ url('fooos')) }}"
            data-action-method="POST" 
            data-modal-size="modal-lg" 
            data-action-ajax-loading-target="commonModalBody">
            <i class="ti-plus"></i>
        </button>
        @endif
    </div>
</div>