<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" id="js-trigger-nav-team">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" id="main-scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" id="main-sidenav">
            <ul id="sidebarnav" data-modular-id="main_menu_team">

                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent1') !!}

                <!--home-->
                @if(auth()->user()->role->role_homepage == 'dashboard')
                <li data-modular-id="main_menu_team_home"
                    class="sidenav-menu-item {{ $page['mainmenu_home'] ?? '' }} menu-tooltip menu-with-tooltip"
                    title="{{ cleanLang(__('lang.home')) }}">
                    <a class="waves-effect waves-dark" href="/home" aria-expanded="false" target="_self">
                        <i class="ti-home"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.dashboard')) }}
                        </span>
                    </a>
                </li>
                <!--home-->
                @endif
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent2') !!}

                <!--users[done]-->
                @if(runtimeGroupMenuVibility([config('visibility.modules.clients'),
                config('visibility.modules.users')]))
                <li data-modular-id="main_menu_team_clients"
                    class="sidenav-menu-item {{ $page['mainmenu_customers'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="sl-icon-people"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.customers')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if(config('visibility.modules.clients'))
                        <li class="sidenav-submenu {{ $page['submenu_customers'] ?? '' }}" id="submenu_clients">
                            <a href="/clients"
                                class="{{ $page['submenu_customers'] ?? '' }}">{{ cleanLang(__('lang.clients')) }}</a>
                        </li>
                        @endif
                        @if(config('visibility.modules.users'))
                        <li class="sidenav-submenu {{ $page['submenu_contacts'] ?? '' }}" id="submenu_contacts">
                            <a href="/users"
                                class="{{ $page['submenu_contacts'] ?? '' }}">{{ cleanLang(__('lang.client_users')) }}</a>
                        </li>
                        @endif
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.clients') !!}
                    </ul>
                </li>
                @endif
                <!--customers-->
                                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent3') !!}

                <!--projects[done]-->
                @if(config('visibility.modules.projects'))
                <li data-modular-id="main_menu_team_projects"
                    class="sidenav-menu-item {{ $page['mainmenu_projects'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-folder"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.projects')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if(config('system.settings_projects_categories_main_menu') == 'yes')
                        @foreach(config('projects_categories') as $category)
                        <li class="sidenav-submenu" id="submenu_projects">
                            <a href="{{ _url('/projects?filter_category='.$category->category_id) }}"
                                class="{{ $page['submenu_projects_category_'.$category->category_id] ?? '' }}">{{ $category->category_name }}</a>
                        </li>
                        @endforeach
                        @else
                        <li class="sidenav-submenu {{ $page['submenu_projects'] ?? '' }}" id="submenu_projects">
                            <a href="{{ _url('/projects') }}"
                                class="{{ $page['submenu_projects'] ?? '' }}">{{ cleanLang(__('lang.projects')) }}</a>
                        </li>
                        @endif
                        <li class="sidenav-submenu {{ $page['submenu_templates'] ?? '' }}"
                            id="submenu_project_templates">
                            <a href="{{ _url('/templates/projects') }}"
                                class="{{ $page['submenu_templates'] ?? '' }}">{{ cleanLang(__('lang.templates')) }}</a>
                        </li>
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.projects') !!}
                    </ul>
                </li>
                @endif
               <!--projects-->
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent4') !!}

                <!--tasks[done]-->
                @if(config('visibility.modules.tasks'))
                <li data-modular-id="main_menu_team_tasks"
                    class="sidenav-menu-item {{ $page['mainmenu_tasks'] ?? '' }} menu-tooltip menu-with-tooltip"
                    title="{{ cleanLang(__('lang.tasks')) }}">
                    <a class="waves-effect waves-dark" href="/tasks" aria-expanded="false" target="_self">
                        <i class="ti-menu-alt"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.tasks')) }}
                        </span>
                    </a>
                </li>
                @endif
                <!--tasks-->
                                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent5') !!}

                <!--leads[done]-->
                @if(config('visibility.modules.leads'))
                <li data-modular-id="main_menu_team_leads"
                    class="sidenav-menu-item {{ $page['mainmenu_leads'] ?? '' }} menu-tooltip menu-with-tooltip"
                    title="{{ cleanLang(__('lang.leads')) }}">
                    <a class="waves-effect waves-dark" href="/leads" aria-expanded="false" target="_self">
                        <i class="sl-icon-call-in"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.leads')) }}
                        </span>
                    </a>
                </li>
                @endif
                <!--leads-->
                                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent6') !!}

                <!--sales-->
                @if(runtimeGroupMenuVibility([config('visibility.modules.invoices'),
                config('visibility.modules.payments'), config('visibility.modules.estimates'),
                config('visibility.modules.products'), config('visibility.modules.expenses'),
                config('visibility.modules.proposals')]))
                <li data-modular-id="main_menu_team_billing"
                    class="sidenav-menu-item {{ $page['mainmenu_sales'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-wallet"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.sales')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if(config('visibility.modules.invoices'))
                        <li class="sidenav-submenu {{ $page['submenu_invoices'] ?? '' }}" id="submenu_invoices">
                            <a href="/invoices"
                                class=" {{ $page['submenu_invoices'] ?? '' }}">{{ cleanLang(__('lang.invoices')) }}</a>
                        </li>
                        @endif
                        @if(config('visibility.modules.payments'))
                        <li class="sidenav-submenu {{ $page['submenu_payments'] ?? '' }}" id="submenu_payments">
                            <a href="/payments"
                                class=" {{ $page['submenu_payments'] ?? '' }}">{{ cleanLang(__('lang.payments')) }}</a>
                        </li>
                        @endif
                        @if(config('visibility.modules.estimates'))
                        <li class="sidenav-submenu {{ $page['submenu_estimates'] ?? '' }}" id="submenu_estimates">
                            <a href="/estimates"
                                class=" {{ $page['submenu_estimates'] ?? '' }}">{{ cleanLang(__('lang.estimates')) }}</a>
                        </li>
                        @endif
                        @if(config('visibility.modules.subscriptions'))
                        <li class="sidenav-submenu {{ $page['submenu_subscriptions'] ?? '' }}"
                            id="submenu_subscriptions">
                            <a href="/subscriptions"
                                class=" {{ $page['submenu_subscriptions'] ?? '' }}">{{ cleanLang(__('lang.subscriptions')) }}</a>
                        </li>
                        @endif
                        @if(config('visibility.modules.products'))
                        <li class="sidenav-submenu {{ $page['submenu_products'] ?? '' }}" id="submenu_products">
                            <a href="/products"
                                class=" {{ $page['submenu_products'] ?? '' }}">{{ cleanLang(__('lang.products')) }}</a>
                        </li>
                        @endif
                        @if(config('visibility.modules.expenses'))
                        <li class="sidenav-submenu {{ $page['submenu_expenses'] ?? '' }}" id="submenu_expenses">
                            <a href="/expenses"
                                class=" {{ $page['submenu_expenses'] ?? '' }}">{{ cleanLang(__('lang.expenses')) }}</a>
                        </li>
                        @endif
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.sales') !!}
                    </ul>
                </li>
                @endif
                <!--billing-->

                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent7') !!}

                <!--proposals [multiple]-->
                @if(config('visibility.modules.proposals') && auth()->user()->role->role_templates_proposals > 0)
                <!--multipl menu-->
                <li data-modular-id="main_menu_team_proposals"
                    class="sidenav-menu-item {{ $page['mainmenu_proposals'] ?? '' }}">
                    <!--multiple menu-->
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-bookmark-alt"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.proposals')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="sidenav-submenu {{ $page['submenu_proposals'] ?? '' }}" id="submenu_proposals">
                            <a href="{{ _url('/proposals') }}"
                                class="{{ $page['submenu_proposals'] ?? '' }}">{{ cleanLang(__('lang.proposals')) }}</a>
                        </li>
                        <li class="sidenav-submenu {{ $page['submenu_proposal_templates'] ?? '' }}"
                            id="submenu_proposal_templates">
                            <a href="{{ _url('/templates/proposals') }}"
                                class="{{ $page['submenu_templates'] ?? '' }}">{{ cleanLang(__('lang.templates')) }}</a>
                        </li>
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.proposals') !!}
                    </ul>
                </li>
                @endif
                <!--proposals-->
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent8') !!}

                <!--proposals [single]-->
                @if(config('visibility.modules.proposals') && auth()->user()->role->role_templates_proposals == 0)
                <li data-modular-id="main_menu_team_proposals"
                    class="sidenav-menu-item {{ $page['mainmenu_proposals'] ?? '' }} menu-tooltip menu-with-tooltip"
                    title="{{ cleanLang(__('lang.proposals')) }}">
                    <a class="waves-effect waves-dark p-r-20" href="/proposals" aria-expanded="false" target="_self">
                        <i class="ti-bookmark-alt"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.proposals')) }}
                        </span>
                    </a>
                </li>
                @endif
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent9') !!}

                <!--contracts [multiple]-->
                @if(config('visibility.modules.contracts') && auth()->user()->role->role_templates_contracts > 0)
                <!--multipl menu-->
                <li data-modular-id="main_menu_team_contracts"
                    class="sidenav-menu-item {{ $page['mainmenu_contracts'] ?? '' }}">
                    <!--multiple menu-->
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-write"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.contracts')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="sidenav-submenu {{ $page['submenu_contracts'] ?? '' }}" id="submenu_contracts">
                            <a href="{{ _url('/contracts') }}"
                                class="{{ $page['submenu_contracts'] ?? '' }}">{{ cleanLang(__('lang.contracts')) }}</a>
                        </li>
                        <li class="sidenav-submenu {{ $page['submenu_contract_templates'] ?? '' }}"
                            id="submenu_contract_templates">
                            <a href="{{ _url('/templates/contracts') }}"
                                class="{{ $page['submenu_contract_templates'] ?? '' }}">{{ cleanLang(__('lang.templates')) }}</a>
                        </li>
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.contracts') !!}
                    </ul>
                </li>
                @endif
                <!--contracts-->
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent10') !!}

                <!--contracts [single]-->
                @if(config('visibility.modules.contracts') && auth()->user()->role->role_templates_contracts == 0)
                <li data-modular-id="main_menu_team_contracts"
                    class="sidenav-menu-item {{ $page['mainmenu_contracts'] ?? '' }} menu-tooltip menu-with-tooltip"
                    title="{{ cleanLang(__('lang.contracts')) }}">
                    <a class="waves-effect waves-dark p-r-20" href="/contracts" aria-expanded="false" target="_self">
                        <i class="ti-write"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.contracts')) }}
                        </span>
                    </a>
                </li>
                @endif


                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent11') !!}

                <!--spaces-->
                @if(config('visibility.modules.spaces'))
                <li data-modular-id="main_menu_team_spaces hidden"
                    class="sidenav-menu-item {{ $page['mainmenu_spaces'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-layers"></i>
                        <span class="hide-menu">@lang('lang.spaces')
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if(config('system.settings2_spaces_user_space_status') == 'enabled')
                        <li class="sidenav-submenu {{ $page['submenu_spaces_my'] ?? '' }}" id="submenu_spaces_my">
                            <a href="{{ _url('/spaces/'.auth()->user()->space_uniqueid) }}"
                                class="{{ $page['submenu_spaces_my'] ?? '' }}">
                                {{ config('system.settings2_spaces_user_space_menu_name') }}
                            </a>
                        </li>
                        @endif
                        @if(config('system.settings2_spaces_team_space_status') == 'enabled')
                        <li class="sidenav-submenu {{ $page['submenu_spaces_team'] ?? '' }}" id="submenu_spaces_team">
                            <a href="{{ _url('/spaces/'.config('system.settings2_spaces_team_space_id')) }}"
                                class="{{ $page['submenu_spaces_team'] ?? '' }}">
                                {{ config('system.settings2_spaces_team_space_menu_name') }}
                            </a>
                        </li>
                        @endif
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.spaces') !!}
                    </ul>
                </li>
                @endif
                <!--spaces-->


                <!--support-->
                <li data-modular-id="main_menu_team_support"
                    class="sidenav-menu-item {{ $page['mainmenu_support'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-comments"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.support')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <!--tickets-->
                        @if(config('visibility.modules.tickets'))
                        <li class="sidenav-submenu {{ $page['submenu_tickets'] ?? '' }}" id="submenu_tickets">
                            <a href="{{ _url('/tickets') }}"
                                class="{{ $page['submenu_tickets'] ?? '' }}">{{ cleanLang(__('lang.tickets')) }}</a>
                        </li>
                        @endif
                        <!--canned-->
                        @if(auth()->user()->is_team)
                        <li class="sidenav-submenu {{ $page['submenu_canned'] ?? '' }}" id="submenu_canned">
                            <a href="{{ _url('/canned') }}"
                                class="{{ $page['submenu_canned'] ?? '' }}">{{ cleanLang(__('lang.canned')) }}</a>
                        </li>
                        @endif
                        <!--knowledgebase-->
                        @if(config('visibility.modules.knowledgebase'))
                        <li class="sidenav-submenu {{ $page['submenu_knowledgebase'] ?? '' }}"
                            id="submenu_knowledgebase">
                            <a href="{{ _url('/knowledgebase') }}"
                                class="{{ $page['submenu_knowledgebase'] ?? '' }}">{{ cleanLang(__('lang.knowledgebase')) }}</a>
                        </li>
                        @endif
                        <!--messaging-->
                        @if(config('visibility.modules.messages'))
                        <li class="sidenav-submenu {{ $page['submenu_messages'] ?? '' }}" id="submenu_messages">
                            <a href="{{ _url('/messages') }}"
                                class="{{ $page['submenu_messages'] ?? '' }}">{{ cleanLang(__('lang.messages')) }}</a>
                        </li>
                        @endif
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.support') !!}
                    </ul>
                </li>
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent12') !!}

                <!--team-->
                @if(auth()->user()->is_team)
                <li data-modular-id="main_menu_team_team"
                    class="sidenav-menu-item {{ $page['mainmenu_settings'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="sl-icon-user"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.team')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="position-top collapse">
                        @if(config('visibility.modules.team'))
                        <li class="sidenav-submenu mainmenu_team {{ $page['submenu_team'] ?? '' }}" id="submenu_team">
                            <a href="/team"
                                class="{{ $page['submenu_team'] ?? '' }}">{{ cleanLang(__('lang.team_members')) }}</a>
                        </li>
                        @endif
                        @if(config('visibility.modules.timesheets'))
                        <li class="sidenav-submenu mainmenu_timesheets {{ $page['submenu_timesheets'] ?? '' }}"
                            id="submenu_timesheets">
                            <a href="/timesheets"
                                class="{{ $page['submenu_timesheets'] ?? '' }}">{{ cleanLang(__('lang.time_sheets')) }}</a>
                        </li>
                        @endif
                        <!--[MODULES] - dynamic menu-->
                        {!! config('modules.menus.main.team') !!}
                    </ul>
                </li>
                @endif
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent13') !!}

                <!--reports-->
                @if(config('visibility.modules.reports'))
                <li data-modular-id="main_menu_reports"
                    class="sidenav-menu-item {{ $page['mainmenu_reports'] ?? '' }} menu-tooltip menu-with-tooltip"
                    title="{{ cleanLang(__('lang.reports')) }}">
                    <a class="waves-effect waves-dark p-r-20" href="/reports" aria-expanded="false" target="_self">
                        <i class="sl-icon-chart"></i>
                        <span class="hide-menu">@lang('lang.reports')
                        </span>
                    </a>
                </li>
                @endif
                
                <!--[MODULES] - dynamic menu-->
                {!! config('modules.menus.main.parent14') !!}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>