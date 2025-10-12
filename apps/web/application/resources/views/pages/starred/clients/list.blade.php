<!--heading section with sorting dropdown-->
<div
    class="p-t-10 p-b-10 p-r-10 p-l-10 bg-contrast border-radius-5 m-b-50 d-flex align-items-center justify-content-between">

    <!--heading-->
    <span class="font-weight-400 font-16 position-relative"><span
            class="display-inline-block m-r-8 vertical-align-middle"><i class="sl-icon-people"></i></span>
        <span class="display-inline-block">@lang('lang.clients')</span></span>

    <!--sort by dropdown-->
    <div class="dropdown">
        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="starredSortDropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('lang.sort_by'):
            <span id="starred-sort-text">
                @if(request('orderby') == 'last_seen')
                @lang('lang.last_seen')
                @else
                @lang('lang.client_name')
                @endif
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="starredSortDropdown">
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/clients?orderby=client_company_name&sortorder=asc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.client_name')" data-progress-bar='hidden'>@lang('lang.client_name')</a>
            <a class="dropdown-item js-ajax-ux-request js-starred-sorting" href="javascript:void(0)"
                data-url="{{ url('/starred/view/clients?orderby=last_seen&sortorder=desc') }}"
                data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                data-sort-text="@lang('lang.last_seen')" data-progress-bar='hidden'>@lang('lang.last_seen')</a>
        </div>
    </div>

</div>

@if(isset($clients) && count($clients) > 0)
@foreach($clients as $client)
<div class="card m-b-2 bg-contrast border-radius-8 m-b-30 starred-feed-item"
    id="starred-item-{{ $client->starred_uniqueid ?? '' }}">
    <div class="card-body p-t-10 p-b-10">
        <div class="d-flex align-items-center justify-content-between m-b-5">
            <div class="flex-grow-1 ajax-request url-link cursor-pointer" data-url="{{ url('/clients/'.$client->client_id) }}">
                <span class="text-muted">@lang('lang.client'): </span><span
                    class="font-weight-500">{{ $client->client_company_name }}</span>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm p-0 font-18 text-muted" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item js-ajax-ux-request js-starred-remove-item" href="javascript:void(0)"
                        data-url="{{ url('/starred/remove/'.$client->starred_uniqueid) }}" data-progress-bar='hidden'
                        data-item-id="starred-item-{{ $client->starred_uniqueid ?? '' }}" 
                        data-progress-bar="hidden"
                        data-type="delete" data-ajax-type="delete">@lang('lang.remove_from_list')</a>
                </div>
            </div>
        </div>
        @if($client->primary_user)
        <div class="d-flex align-items-center ajax-request url-link cursor-pointer"
            data-url="{{ url('/clients/'.$client->client_id) }}">
            <span class="text-muted">@lang('lang.owner'):</span>
            <span class="label label-outline-info m-l-5">{{ $client->primary_user->first_name ?? '---' }}</span>
        </div>

        @endif
        <a href="{{ url('/clients/'.$client->client_id) }}"
            class="d-flex align-items-center justify-content-between m-t-10 text-reset text-decoration-none">
            <!--list of users - avatars-->
            <div class="avatar-group">
                @foreach($client->users->take(3) as $user)
                <img src="{{ $user->avatar }}" class="avatar avatar-xs rounded-circle" data-toggle="tooltip"
                    data-placement="top" title="{{ $user->first_name }} {{ $user->last_name }}">
                @endforeach
                @if($client->users->count() > 3)
                <span class="avatar avatar-xs rounded-circle bg-light text-muted" data-toggle="tooltip"
                    data-placement="top" title="{{ $client->users->count() - 3 }} @lang('lang.more')">
                    +{{ $client->users->count() - 3 }}
                </span>
                @endif
            </div>
            <div class="font-12 text-right">
                @if($client->last_seen_user)
                <span class="font-weight-500">@lang('lang.latest_seen'):</span>
                <div class="m-t-5">
                    <span class="label label-light-info">{{ runtimeDateAgo($client->last_seen_user->last_seen) }}</span>
                </div>
                @else
                <span>@lang('lang.latest_seen'): ---</span>
                @endif
            </div>
        </a>
    </div>
</div>
@endforeach
@else
<div class="text-center p-t-40 p-b-40">
    <img src="{{ url('/') }}/public/images/no-results-found.png" alt="@lang('lang.no_results_found')" height="80">
    <h4 class="m-t-20">@lang('lang.no_results_found')</h4>
</div>
@endif