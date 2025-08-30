<!--heading section with sorting dropdown-->
<div class="p-t-10 p-b-10 p-r-10 p-l-10 bg-contrast border-radius-5 m-b-50 d-flex align-items-center justify-content-between">

    <!--heading-->
    <span class="font-weight-400 font-16 position-relative"><span
            class="display-inline-block m-r-8 vertical-align-middle"><i class="ti-check-box"></i></span>
        <span class="display-inline-block">@lang('lang.tasks')</span></span>

    <!--sort by dropdown-->
    <div class="dropdown">
        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="starredSortDropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('lang.sort_by'):
            <span id="starred-sort-text">
                @if(request('orderby') == 'latest_activity')
                @lang('lang.latest_activity')
                @else
                @lang('lang.task_title')
                @endif
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="starredSortDropdown">
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/tasks?orderby=task_title&sortorder=asc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.task_title')" data-progress-bar='hidden'>@lang('lang.task_title')</a>
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/tasks?orderby=latest_activity&sortorder=desc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.latest_activity')" data-progress-bar='hidden'>@lang('lang.latest_activity')</a>
        </div>
    </div>

</div>

@if(isset($tasks) && count($tasks) > 0)
@foreach($tasks as $task)
<div class="card m-b-2 bg-contrast border-radius-8 m-b-30 starred-feed-item"
    id="starred-item-{{ $task->starred_uniqueid ?? '' }}">
    <div class="card-body p-t-10 p-b-10">
        <div class="d-flex justify-content-between align-items-start">
            <div class="flex-grow-1 url-link" style="cursor: pointer;" data-url="{{ urlResource('/tasks/v/'.$task->task_id) }}">
                <span class="">@lang('lang.task'): </span><span
                    class="font-weight-500">{{ str_limit($task->task_title ?? '---', 50) }}</span>
                <div class="m-t-5">
                    <span class="font-12">
                        @lang('lang.project'): <span
                            class="font-weight-500">{{ str_limit($task->project->project_title ?? '---', 30) }}</span>
                    </span>
                </div>
                <div>
                    <span class="font-12">
                        @lang('lang.client'): <span class="label label-outline-info m-l-5">{{ str_limit($task->project->client->client_company_name ?? '---', 30) }}</span>
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
                        data-url="{{ url('/starred/remove/'.($task->starred_uniqueid ?? '')) }}"
                        data-item-id="starred-item-{{ $task->starred_uniqueid ?? '' }}" data-ajax-type="DELETE"
                        data-progress-bar='hidden'>@lang('lang.remove_from_list')</a>

                    <!--open project-->
                    @if($task->task_projectid)
                    <a class="dropdown-item" href="{{ url('/projects/'.$task->task_projectid) }}"
                        target="_self">@lang('lang.open_project')</a>
                    @endif

                    @if($task->task_clientid)
                    <!--open client-->
                    <a class="dropdown-item" href="{{ url('/clients/'.$task->task_clientid) }}"
                        target="_self">@lang('lang.open_client')</a>
                    @endif

                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between m-t-10 url-link"
            style="cursor: pointer;" data-url="{{ urlResource('/tasks/v/'.$task->task_id) }}">
            <!--assigned users avatars-->
            <div>
                @if($task->assigned && $task->assigned->count() > 0)
                @foreach($task->assigned->take(3) as $user)
                <img src="{{ getUsersAvatar($user->avatar_directory, $user->avatar_filename) }}" 
                    data-toggle="tooltip" title="{{ $user->first_name }} {{ $user->last_name }}" 
                    data-placement="top" alt="{{ $user->first_name }}" 
                    class="img-circle avatar-xsmall">
                @endforeach
                @if($task->assigned->count() > 3)
                <span class="more-users-text f-s-13 text-muted">+{{ $task->assigned->count() - 3 }}</span>
                @endif
                @endif
            </div>
            <div class="font-12">
                <span class="font-weight-500">@lang('lang.latest_activity'):</span>
                @if($task->latest_activity && $task->latest_activity->date != '0000-00-00 00:00:00' && $task->latest_activity->user)
                {{ $task->latest_activity->user->first_name ?? '' }}
                @else
                ---
                @endif
                <div class="text-right m-t-5">
                    @if($task->latest_activity && $task->latest_activity->date != '0000-00-00 00:00:00')
                    <span class="label label-light-info">{{ runtimeDateAgo($task->latest_activity->date) }}</span>
                    @else
                    <span class="text-muted">---</span>
                    @endif
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