<!--heading section with sorting dropdown-->
<div
    class="p-t-10 p-b-10 p-r-10 p-l-10 bg-contrast border-radius-5 m-b-50 d-flex align-items-center justify-content-between">

    <!--heading-->
    <span class="font-weight-400 font-16 position-relative"><span class="display-inline-block m-r-8 vertical-align-middle"><i class="ti-comments"></i></span>
        <span class="display-inline-block">@lang('lang.project_comments')</span></span>

    <!--sort by dropdown-->
    <div class="dropdown">
        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="starredSortDropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('lang.sort_by'):
            <span id="starred-sort-text">
                @if(request('orderby') == 'recent_activity')
                @lang('lang.recent_activity')
                @else
                @lang('lang.project_title')
                @endif
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="starredSortDropdown">
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/project-comments?orderby=project_title&sortorder=asc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.project_title')" data-progress-bar='hidden'>@lang('lang.project_title')</a>
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/project-comments?orderby=recent_activity&sortorder=desc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.recent_activity')"
                data-progress-bar='hidden'>@lang('lang.recent_activity')</a>
        </div>
    </div>

</div>

@if(isset($projects) && count($projects) > 0)
@foreach($projects as $project)
<div class="card m-b-2 bg-contrast border-radius-8 m-b-30 starred-feed-item"
    id="starred-item-{{ $project->starred_uniqueid ?? '' }}">
    <div class="card-body p-t-10 p-b-10">
        <div class="d-flex justify-content-between align-items-start">
            <div class="flex-grow-1 ajax-request" style="cursor: pointer;"
                data-url="{{ url('/comments?source=starred&loading_target=sidepanel-starred-container&commentresource_type=project&commentresource_id='.$project->project_id) }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-progress-bar='hidden'>
                <span class="text-muted">@lang('lang.project'): </span><span
                    class="font-weight-500">{{ $project->project_title }}</span>
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
                        data-url="{{ url('/starred/remove/'.($project->starred_uniqueid ?? '')) }}"
                        data-item-id="starred-item-{{ $project->starred_uniqueid ?? '' }}" data-ajax-type="DELETE"
                        data-progress-bar="hidden">@lang('lang.remove_from_list')</a>
                    <!--open project-->
                    <a class="dropdown-item" href="{{ url('/projects/'.$project->project_id) }}"
                        target="_self">@lang('lang.open_project')</a>
                    <!--open client-->
                    <a class="dropdown-item" href="{{ url('/clients/'.$project->project_clientid) }}"
                        target="_self">@lang('lang.open_client')</a>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center ajax-request" style="cursor: pointer;"
            data-url="{{ url('/comments?source=starred&loading_target=sidepanel-starred-container&commentresource_type=project&commentresource_id='.$project->project_id) }}"
            data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
            data-progress-bar='hidden'>
            <span class="text-muted">@lang('lang.client'):</span>
            <span class="label label-outline-info m-l-5">{{ $project->client->client_company_name ?? '' }}</span>
        </div>
        <div class="d-flex align-items-center justify-content-between m-t-10 ajax-request" style="cursor: pointer;"
            data-url="{{ url('/comments?source=starred&loading_target=sidepanel-starred-container&commentresource_type=project&commentresource_id='.$project->project_id) }}"
            data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
            data-progress-bar='hidden'>
            <!--list of users - avatars-->
            <div class="avatar-group">
                @foreach($project->users()->take(3) as $user)
                <img src="{{ $user->avatar }}" class="avatar avatar-xs rounded-circle" data-toggle="tooltip"
                    data-placement="top" title="{{ $user->first_name }} {{ $user->last_name }}">
                @endforeach
                @if($project->users()->count() > 3)
                <span class="avatar avatar-xs rounded-circle bg-light text-muted" data-toggle="tooltip"
                    data-placement="top" title="{{ $project->users()->count() - 3 }} @lang('lang.more')">
                    +{{ $project->users()->count() - 3 }}
                </span>
                @endif
            </div>
            <div class="font-12">
                @if($project->comments->count() > 0 && $project->comments->first())
                <span class="font-weight-500">@lang('lang.latest_activity'):</span>
                {{ $project->comments->first()->creator->first_name ?? '' }}
                <div class="text-right m-t-5">
                    <span
                        class="label label-light-info">{{ runtimeDateAgo($project->comments->first()->comment_created) }}</span>
                </div>
                @else
                @lang('lang.latest_activity'): ---
                @endif
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