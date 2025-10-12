<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul data-modular-id="reports_tabs_menu" class="nav nav-tabs profile-tab reports-top-nav list-pages-crumbs"
            role="tablist">

            
            <!--[MODULES] - dynamic menu-->
            {!! config('modules.menus.reports.parent1') !!}

            <!--invoices-->
            <li class="nav-item dropdown {{ $page['reports_tabs_productivty'] ?? '' }}">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_invoices" aria-expanded="false">
                    <span class="hidden-xs-down">{{ cleanLang(__('lang.invoices')) }}</span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/invoices/overview') }}"
                        data-url="{{ url('/report/invoices/overview') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.overview')</a>
                    <!--[monthly]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/invoices/month') }}"
                        data-url="{{ url('/report/invoices/month') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.monthly')</a>
                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/invoices/client') }}"
                        data-url="{{ url('/report/invoices/client') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.client_invoices')</a>
                    <!--[project-category]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/invoices/category') }}"
                        data-url="{{ url('/report/invoices/category') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.invoice_category')</a>

                    <!--[MODULES] - dynamic menu-->
                    {!! config('modules.menus.reports.invoices') !!}
                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            {!! config('modules.menus.reports.parent2') !!}

            <!--estimates-->
            <li class="nav-item dropdown {{ $page['reports_tabs_productivty'] ?? '' }}">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_estimates" aria-expanded="false">
                    <span class="hidden-xs-down">{{ cleanLang(__('lang.estimates')) }}</span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/estimates/overview') }}"
                        data-url="{{ url('/report/estimates/overview') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.overview')</a>
                    <!--[monthly]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/estimates/month') }}"
                        data-url="{{ url('/report/estimates/month') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.monthly')</a>
                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/estimates/client') }}"
                        data-url="{{ url('/report/estimates/client') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.client_estimates')</a>
                    <!--[project-category]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/estimates/category') }}"
                        data-url="{{ url('/report/estimates/category') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.estimate_category')</a>
                    <!--[MODULES] - dynamic menu-->
                    {!! config('modules.menus.reports.estimates') !!}
                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            {!! config('modules.menus.reports.parent3') !!}

            <!--projects-->
            <li class="nav-item dropdown {{ $page['reports_tabs_productivty'] ?? '' }}">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_projects" aria-expanded="false">
                    <span class="hidden-xs-down">{{ cleanLang(__('lang.projects')) }}</span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/projects/overview') }}"
                        data-url="{{ url('/report/projects/overview') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.overview')</a>
                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/projects/client') }}"
                        data-url="{{ url('/report/projects/client') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.client_projects')</a>
                    <!--[project-category]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/projects/category') }}"
                        data-url="{{ url('/report/projects/category') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.project_category')</a>
                    <!--[MODULES] - dynamic menu-->
                    {!! config('modules.menus.reports.projects') !!}
                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            {!! config('modules.menus.reports.parent4') !!}

            <!--clients-->
            <li class="nav-item dropdown {{ $page['reports_tabs_productivty'] ?? '' }}">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_clients" aria-expanded="false">
                    <span class="hidden-xs-down">{{ cleanLang(__('lang.clients')) }}</span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[overview]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/clients/overview') }}"
                        data-url="{{ url('/report/clients/overview') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.overview')</a>
                    <!--[MODULES] - dynamic menu-->
                    {!! config('modules.menus.reports.clients') !!}
                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            {!! config('modules.menus.reports.parent5') !!}

            <!--timesheets-->
            <li class="nav-item dropdown {{ $page['reports_tabs_productivty'] ?? '' }}">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_timesheets" aria-expanded="false">
                    <span class="hidden-xs-down">{{ cleanLang(__('lang.timesheets')) }}</span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[team_member]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/timesheets/team') }}"
                        data-url="{{ url('/report/timesheets/team') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.team_member')</a>

                    <!--[client]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/timesheets/client') }}"
                        data-url="{{ url('/report/timesheets/client') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.client')</a>

                    <!--[project]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/timesheets/project') }}"
                        data-url="{{ url('/report/timesheets/project') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.project')</a>
                    <!--[MODULES] - dynamic menu-->
                    {!! config('modules.menus.reports.timesheets') !!}
                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            {!! config('modules.menus.reports.parent6') !!}

            <!--financial-->
            <li class="nav-item dropdown {{ $page['reports_tabs_productivty'] ?? '' }}">
                <a class="nav-link dropdown-toggle  tabs-menu-item" data-loading-class="loading-tabs"
                    data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true"
                    id="reports_tabs_financial" aria-expanded="false">
                    <span class="hidden-xs-down">{{ cleanLang(__('lang.financial')) }}</span>
                </a>
                <div class="dropdown-menu" x-placement="bottom-start" id="fx-topnav-dropdown">
                    <!--[profit and loss]-->
                    <a class="dropdown-item js-dynamic-url js-ajax-ux-request" data-toggle="tab"
                        data-loading-class="loading-tabs" data-loading-target="embed-content-container"
                        data-dynamic-url="{{ url('/reports/financial/income-expenses') }}"
                        data-url="{{ url('/report/financial/income-expenses') }}" href="javascript:void(0);"
                        role="tab">@lang('lang.income_vs_expenses')</a>
                    <!--[MODULES] - dynamic menu-->
                    {!! config('modules.menus.reports.financial') !!}
                </div>
            </li>

            <!--[MODULES] - dynamic menu-->
            {!! config('modules.menus.reports.parent7') !!}

        </ul>
        <!-- Tab panes -->
    </div>
</div>