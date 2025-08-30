<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-calender-settings">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i>@lang('lang.calendar_settings')
                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-calender-settings"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--events_display_date-->
                <div class="filter-block m-b-30">
                    <div class="title">
                        @lang('lang.events_display_date')
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm select2-preselected"
                                    id="pref_calendar_dates_events" name="pref_calendar_dates_events"
                                    data-preselected="{{ auth()->user()->pref_calendar_dates_events }}">
                                    <option value="start">@lang('lang.start_date')</option>
                                    <option value="due">@lang('lang.end_date_due')</option>
                                    <option value="start_due">@lang('lang.start_and_due_date')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--tasks_display_date-->
                <div class="filter-block m-b-30">
                    <div class="title">
                        @lang('lang.tasks_display_date')
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm select2-preselected"
                                    id="pref_calendar_dates_tasks" name="pref_calendar_dates_tasks"
                                    data-preselected="{{ auth()->user()->pref_calendar_dates_tasks }}">
                                    <option value="start">@lang('lang.start_date')</option>
                                    <option value="due">@lang('lang.end_date_due')</option>
                                    <option value="start_due">@lang('lang.start_and_due_date')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <!--projects_display_date-->
                <div class="filter-block m-b-30">
                    <div class="title">
                        @lang('lang.projects_display_date')
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm select2-preselected"
                                    id="pref_calendar_dates_projects" name="pref_calendar_dates_projects"
                                    data-preselected="{{ auth()->user()->pref_calendar_dates_projects }}">
                                    <option value="start">@lang('lang.start_date')</option>
                                    <option value="due">@lang('lang.end_date_due')</option>
                                    <option value="start_due">@lang('lang.start_and_due_date')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                @if(auth()->user()->is_admin)
                <!--projects_display_date-->
                <div class="filter-block m-b-30">
                    <div class="title">
                        @lang('lang.projects_and_taks')
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="select2-basic form-control form-control-sm select2-preselected"
                                    id="pref_calendar_view" name="pref_calendar_view"
                                    data-preselected="{{ auth()->user()->pref_calendar_view }}">
                                    <option value="own">@lang('lang.only_mine')</option>
                                    <option value="all">@lang('lang.display_all')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif



                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="{{ urlResource('/calendar?calendar_action=user-preferences') }}" data-type="form"
                        data-ajax-type="GET">{{ cleanLang(__('lang.apply_changes')) }}</button>
                </div>

                <div class="line"></div>

                <div class="alert alert-info">@lang('lang.calender_not_seeing_items') <span
                        class="align-middle text-info font-16" data-toggle="tooltip" title="@lang('lang.calender_not_seeing_info')"
                        data-placement="top"><i class="ti-info-alt"></i></span></div>

            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar-->