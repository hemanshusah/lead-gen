<div class="row">
    <div class="col-lg-12">



        @if(auth()->user()->is_admin && !is_numeric(request('task_id')))
        <div class="modal-selector">
            <!--select team member-->
            <div class="form-group row">
                <div class="col-sm-12 m-b-0">
                    <select class="select2-basic form-control form-control-sm select2-preselected" id="timesheet_user"
                        data-base-url="{{ url('/feed/users-projects?user_id=') }}" name="timesheet_user"
                        data-preselected="{{ auth()->user()->id }}">
                        @foreach(config('system.team_members') as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @else
        <input type="hidden" name="timesheet_user" value="{{ auth()->user()->id }}">

        @endif


        <!--user's project and tasks-->
        @if(is_numeric(request('task_id')))
        <input type="hidden" name="my_assigned_tasks" value="{{ request('task_id') }}">
        <input type="hidden" name="source" value="tasks">
        @else
        <div class="form-group row m-b-12">
            <label
                class="col-12 text-left control-label col-form-label col-12 m-b-0 font-13 p-b-4">@lang('lang.my_projects')</label>
            <div class="col-12">
                <select name="my_assigned_projects" id="my_assigned_projects" placeholder="project" data-user-id="{{ auth()->user()->id }}"
                    class="projects_my_tasks_toggle form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                    data-task-dropdown="my_assigned_tasks"
                    data-ajax--url="{{ url('/feed/users-projects?user_id='.auth()->user()->id) }}"></select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-12 text-left control-label col-form-label col-12 m-b-0 font-13 p-b-4">@lang('lang.my_tasks')</label>
            <div class="col-12">
                <select class="select2-basic form-control form-control-sm" id="my_assigned_tasks"
                    name="my_assigned_tasks" disabled>
                    <!--dynamic tasks lists-->
                </select>
            </div>
        </div>
        <input type="hidden" name="source" value="timesheets">
        @endif

        <!--timer date-->
        <div class="form-group row">
            <label
                class="col-12 text-left control-label col-form-label col-12 m-b-0 font-13 p-b-4">@lang('lang.date')</label>
            <div class="col-12">
                <input type="text" class="form-control  form-control-sm pickadate" disabled autocomplete="off"
                    name="timer_created_edit" id="manual_timer_created"
                    value="{{ runtimeDatepickerDate($estimate->bill_date ?? '') }}" autocomplete="off">
                <input class="mysql-date" type="hidden" name="timer_created" id="timer_created_edit"
                    value="{{ $estimate->bill_date ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-6">
                <input type="number" class="form-control form-control-sm js-topnav-timer"
                    placeholder="@lang('lang.hrs')" name="manual_time_hours" id="manual_time_hours" disabled>
            </div>
            <div class="col-6">
                <input type="number" class="form-control form-control-sm js-topnav-timer"
                    placeholder="@lang('lang.mins')" name="manual_time_minutes" id="manual_time_minutes" disabled>
            </div>
        </div>

        <div class="form-group row dropdown-no-results-found hidden m-b-18" id="my_assigned_tasks_no_results">
            <div class="p-l-8 p-r-8">
                <!--info tooltip-->
                <span>@lang('lang.no_tasks_found')</span>
                <span class="align-middle p-l-5 font-16" data-toggle="tooltip"
                    title="@lang('lang.no_tasks_assigned_to_you')" data-placement="top"><i
                        class="ti-info-alt font-13"></i></span>
            </div>
        </div>
    </div>
</div>