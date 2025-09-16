<!--heading section with sorting dropdown-->
<div
    class="p-t-10 p-b-10 p-r-10 p-l-10 bg-contrast border-radius-5 m-b-50 d-flex align-items-center justify-content-between">

    <!--heading-->
    <span class="font-weight-400 font-16 position-relative"><span
            class="display-inline-block m-r-8 vertical-align-middle"><i class="ti-notepad"></i></span>
        <span class="display-inline-block">@lang('lang.notes')</span></span>

    <!--sort by dropdown-->
    <div class="dropdown">
        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="starredSortDropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('lang.sort_by'):
            <span id="starred-sort-text">
                @if(request('orderby') == 'last_updated')
                @lang('lang.last_updated')
                @else
                @lang('lang.note_title')
                @endif
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="starredSortDropdown">
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/notes?orderby=note_title&sortorder=asc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.note_title')" data-progress-bar='hidden'>@lang('lang.note_title')</a>
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/notes?orderby=note_updated&sortorder=desc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.last_updated')" data-progress-bar='hidden'>@lang('lang.last_updated')</a>
        </div>
    </div>

</div>


@if(isset($notes) && count($notes) > 0)
@foreach($notes as $note)
<div class="card m-b-2 bg-contrast border-radius-8 m-b-30 starred-feed-item"
    id="starred-item-{{ $note->starred_uniqueid ?? '' }}">
    <div class="card-body p-t-10 p-b-10">
        <div class="d-flex justify-content-between align-items-start">
            <div class="flex-grow-1 show-modal-button ajax-request" style="cursor: pointer;" data-toggle="modal"
                data-target="#plainModal" data-url="{{ url('/notes/'.$note->note_id) }}"
                data-loading-target="plainModalBody" data-modal-title=" ">
                <span class="">@lang('lang.title'): </span><span
                    class="font-weight-500">{{ str_limit($note->note_title ?? $note->note_description ?? '---', 50) }}</span>
                <div class="m-t-5">
                    <span class="font-12">
                        @if($note->noteresource_type == 'project')
                        @lang('lang.project'): <span
                            class="font-weight-500">{{ $note->project->project_title ?? '' }}</span>
                        @elseif($note->noteresource_type == 'user')
                        @lang('lang.user'): <span class="font-weight-500">{{ $note->user->first_name ?? '' }}</span>
                        @elseif($note->noteresource_type == 'client')
                        @lang('lang.client'): <span
                            class="font-weight-500">{{ $note->client->client_company_name ?? '' }}</span>
                        @endif
                    </span>
                </div>
            </div>
            <!--options dropdown-->
            <div class="dropdown">
                <button class="btn btn-sm p-0 border-0 bg-transparent" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="sl-icon-options-vertical text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!--remove from list-->
                    <a class="dropdown-item js-ajax-ux-request js-starred-remove-item" href="javascript:void(0)"
                        data-url="{{ url('/starred/remove/'.($note->starred_uniqueid ?? '')) }}"
                        data-item-id="starred-item-{{ $note->starred_uniqueid ?? '' }}" data-ajax-type="DELETE"
                        data-progress-bar='hidden'>@lang('lang.remove_from_list')</a>

                    @if($note->noteresource_type == 'project')
                    <!--open project-->
                    <a class="dropdown-item" href="{{ url('/projects/'.$note->project->project_id) }}"
                        target="_self">@lang('lang.open_project')</a>
                    <!--open client-->
                    <a class="dropdown-item" href="{{ url('/clients/'.$note->project->project_clientid) }}"
                        target="_self">@lang('lang.open_client')</a>
                    @endif

                    @if($note->noteresource_type == 'client')
                    <!--open client-->
                    <a class="dropdown-item" href="{{ url('/clients/'.$note->client->client_id) }}"
                        target="_self">@lang('lang.open_client')</a>
                    @endif

                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between m-t-10 show-modal-button ajax-request"
            style="cursor: pointer;" data-toggle="modal" data-target="#plainModal"
            data-url="{{ url('/notes/'.$note->note_id) }}" data-loading-target="plainModalBody" data-modal-title=" ">
            <!--note type label-->
            <div>
                @if($note->noteresource_type == 'user')
                <span class="label label-outline-warning">@lang('lang.user') @lang('lang.note')</span>
                @elseif($note->noteresource_type == 'project')
                <span class="label label-outline-info">@lang('lang.project') @lang('lang.note')</span>
                @elseif($note->noteresource_type == 'client')
                <span class="label label-outline-success">@lang('lang.client') @lang('lang.note')</span>
                @endif
            </div>
            <div class="font-12">
                <span class="font-weight-500">@lang('lang.last_updated'):</span>
                {{ $note->creator->first_name ?? '' }}
                <div class="text-right m-t-5">
                    <span class="label label-light-info">{{ runtimeDateAgo($note->note_updated) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<div class="text-center p-t-40 p-b-40">
    <img src="{{ url('/') }}/public/images/no-results-found.png" alt="@lang('lang.no_results_found')" height="80">
    <h4 class="m-t-20">@lang('lang.no_results_found')</h4>
</div>
@endif