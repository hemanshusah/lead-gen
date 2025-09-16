<!--each category-->
<div class="x-each-category {{ $knowledgebase['search_type'] ?? 'all'}}">

    <!--heading-->
    @if($knowledgebase['search_type'] == 'all')
    <div class="x-heading clearfix">
        <span class="pull-left x-title">
            @lang('lang.knowledgebase')
        </span>
        <span class="pull-right x-count">
            <a href="javascript:void(0);" class="ajax-request" data-url="{{ url('search?search_type=knowledgebase') }}"
                data-type="form" data-form-id="global-search-form" data-ajax-type="post"
                data-loading-target="global-search-form" name="search_query">@lang('lang.view_all')
                ({{ $knowledgebase['count'] }})</a>
        </span>
    </div>
    @endif

    <!--results-->
    <ul>

        <!-- each result -->
        @foreach($knowledgebase['results']->take(runtimeSearchDisplyLimit($knowledgebase['search_type'])) as $kb)
        <li class="knowledgebase">
            <a href="javascript:void(0);">
                <!--icon-->
                <span class="x-icon">
                    <i class="sl-icon-book-open"></i>
                </span>
                <!--title-->
                <span class="x-title">
                    <a href="{{ url('kb/article/'.$kb->knowledgebase_slug) }}">{{ $kb->knowledgebase_title }}</a>
                </span>
                <!--meta-->
                <span class="x-meta">
                    - #{{ $kb->knowledgebase_id }}
                </span>
            </a>
        </li>
        @endforeach

    </ul>
</div>