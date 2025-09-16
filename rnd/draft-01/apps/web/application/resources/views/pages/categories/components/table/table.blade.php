<div class="card count-{{ @count($categories ?? []) }}" id="categories-table-wrapper"
    data-payload="{{ request('filter_category_type') }}">
    <div class="card-body">
        <div class="table-responsive">
            @if (@count($categories ?? []) > 0)
            <table id="demo-foo-addrow" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <th class="categories_col_name">{{ cleanLang(__('lang.name')) }}</th>

                        @if(config('visibility.categories_col_created_by'))
                        <th class="categories_col_created_by">{{ cleanLang(__('lang.created_by')) }}</th>
                        @endif

                        @if(config('visibility.categories_col_date'))
                        <th class="categories_col_date">{{ cleanLang(__('lang.date_created')) }}</th>
                        @endif

                        @if(config('visibility.categories_col_date'))
                        <th class="categories_col_items">{{ cleanLang(__('lang.items')) }}</th>
                        @endif
                        <!--ticket email piping-->
                        @if(config('visibility.categories_col_email_piping'))
                        <th class="categories_col_email_piping">@lang('lang.email_integration') <span
                                class="align-middle text-info font-16" data-toggle="tooltip" title="@lang('lang.department_email_integration_info') (@lang('lang.this_feature_is_optional'))"
                                data-placement="top"><i class="ti-info-alt"></i></span></th>
                        <th class="categories_col_email_last_checked">@lang('lang.email_last_checked') <span
                                class="align-middle text-info font-16" data-toggle="tooltip"
                                title="@lang('lang.email_last_checked_info')" data-placement="top"><i
                                    class="ti-info-alt"></i></span></th>
                        <th class="categories_col_email_last_fetched_count">@lang('lang.email_last_fetched_count') <span
                                class="align-middle text-info font-16" data-toggle="tooltip"
                                title="@lang('lang.email_last_fetched_count_info')" data-placement="top"><i
                                    class="ti-info-alt"></i></span></th>
                        <th class="categories_col_email_total_count">@lang('lang.email_fetched_count') <span
                                class="align-middle text-info font-16" data-toggle="tooltip"
                                title="@lang('lang.email_fetched_count_info')" data-placement="top"><i
                                    class="ti-info-alt"></i></span></th>
                        @endif
                        @if(request('filter_category_type')=='project')
                        <th class="categories_col_users">{{ cleanLang(__('lang.team')) }}</th>
                        @endif
                        <th class="categories_col_action"><a
                                href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="categories-td-container">
                    <!--ajax content here-->
                    @include('pages.categories.components.table.ajax')
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif
            @if (@count($categories ?? []) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif

            <!--email integration is optional-->
            @if(config('visibility.categories_col_email_piping'))
            <div class="alert alert-info">@lang('lang.email_integration_optional')</div>
            @endif

            @if(config('system.settings_type') == 'standalone')
            <!--[standalone] - settings documentation help-->
            @endif

        </div>
    </div>
</div>