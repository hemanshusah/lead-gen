<!--show calendar-->
<div class="calendar-show-container" id="calendar-show-container">

    <div class="modal-selector event-title p-l-40">
        {{ $event['title'] ?? '---' }}
    </div>

    <!--date-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="ti-calendar"></i> <span>@lang('lang.date')</span>
        </div>
        <div class="col-lg-9 event-info">
            {{ runtimeDate($event['extendedProps']['start_date']) }} <span class="calendar-show-date-to"> - </span>
            {{ runtimeDate($event['extendedProps']['end_date']) }}
        </div>
    </div>

    <!--time-->
    @if($event['extendedProps']['all_day'] == 'no')
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="sl-icon-clock"></i> <span>@lang('lang.time')</span>
        </div>
        <div class="col-lg-9 event-info">
            {{ runtimeSimpleTime($event['extendedProps']['start_time']) }} <span class="calendar-show-date-to"> -
            </span>
            {{ runtimeSimpleTime($event['extendedProps']['end_time']) }}
        </div>
    </div>
    @endif

    <!--creator-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="sl-icon-user-follow"></i> <span>@lang('lang.added_by')</span>
        </div>
        <div class="col-lg-9 event-info">
            @if(isset($event['extendedProps']['creator']->first_name))
            {{ $event['extendedProps']['creator']->first_name }} {{ $event['extendedProps']['creator']->last_name }}
            @else
            ---
            @endif
        </div>
    </div>

    <!--type-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="ti-bookmark"></i> <span>@lang('lang.type')</span>
        </div>
        <div class="col-lg-9 event-info">
            @if($event['extendedProps']['resource_type'] == 'project')
            <span class="label label-outline-success"><a
                    href="{{ url('/projects/'.$event['extendedProps']['resource_id']) }}">@lang('lang.project')</a></span>
            @endif

            @if($event['extendedProps']['resource_type'] == 'task')
            <span class="label label-outline-success"><a
                href="{{ url('/tasks/v/'.$event['extendedProps']['resource_id']) }}">@lang('lang.task')</a></span>
            @endif

            @if($event['extendedProps']['resource_type'] == 'calendarevent')
            <span class="label label-outline-success">@lang('lang.event')</span>
            @endif
        </div>
    </div>

    <!--[task] - status-->
    @if($event['extendedProps']['resource_type'] == 'task')
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="sl-icon-flag"></i> <span>@lang('lang.status')</span>
        </div>
        <div class="col-lg-9 event-info">
            <span
                class="label label-outline-{{ $event['extendedProps']['taskstatus_color'] }}">{{ runtimeLang($event['extendedProps']['taskstatus_title']) }}</span>
        </div>
    </div>
    @endif

    <!--[task] - project title-->
    @if($event['extendedProps']['resource_type'] == 'task')
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="ti-folder"></i> <span>@lang('lang.project')</span>
        </div>
        <div class="col-lg-9 event-info">
            <a
                href="{{ url('/projects/'.$event['extendedProps']['project_id']) }}">{{ $event['extendedProps']['project_title'] }}</a>
        </div>
    </div>
    @endif

    <!--[project] - status-->
    @if($event['extendedProps']['resource_type'] == 'project')
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="sl-icon-flag"></i> <span>@lang('lang.status')</span>
        </div>
        <div class="col-lg-9 event-info">
            <span
                class="label {{ runtimeProjectStatusColors($event['extendedProps']['project_status'], 'label') }}">{{ runtimeLang($event['extendedProps']['project_status']) }}</span>
        </div>
    </div>
    @endif

    <!--reminder-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="sl-icon-bell"></i> <span>@lang('lang.reminder')</span>
        </div>
        <div class="col-lg-9 event-info">
            @if($event['extendedProps']['reminder'] == 'yes')
            <span class="label label-outline-default">@lang('lang.email_notification')</span>
            @else
            ---
            @endif
        </div>
    </div>

    <!--users-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="sl-icon-people"></i> <span>@lang('lang.users')</span>
        </div>
        <div class="col-lg-9 event-info">
            <!--self-->
            @if($event['extendedProps']['sharing'] == 'myself')
            <div class="row">
                <div class="col-sm-12 col-lg-6 event-user m-b-20">
                    <img src="{{ getUsersAvatar(auth()->user()->avatar_directory, auth()->user()->avatar_filename) }}"
                        alt="user" class="img-circle avatar-xsmall">
                    {{ auth()->user()->first_name  }} {{ auth()->user()->last_name  }}
                </div>
            </div>
            @endif

            <!--whole team-->
            @if($event['extendedProps']['sharing'] == 'whole-team')
            <span class="label label-outline-info">@lang('lang.all_team_members')</span>
            @endif


            <!--selected users-->
            @if($event['extendedProps']['sharing'] == 'selected-users')
            @if(count($users) > 0)
            <div class="row">
                @foreach($users as $user)
                <div class="col-sm-12 col-lg-6 event-user m-b-20">
                    <img src="{{ getUsersAvatar($user['avatar_directory'], $user['avatar_filename']) }}" alt="user"
                        class="img-circle avatar-xsmall">
                    {{ $user['name']  }}
                </div>
                @endforeach
            </div>
            @else
            <span class="label label-outline-default">@lang('lang.no_users')</span>
            @endif
            @endif
        </div>
    </div>

    <!--location-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="sl-icon-location-pin"></i> <span>@lang('lang.location')</span>
        </div>
        <div class="col-lg-9 event-info">
            {{ $event['extendedProps']['location'] ?? '---' }}
        </div>
    </div>

    <!--details-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="ti-align-left"></i> <span>@lang('lang.details')</span>
        </div>
        <div class="col-lg-9 event-info">
            <div class="switch  text-left">
                <label>
                    <input type="checkbox" name="more_information" id="more_information"
                        class="js-switch-toggle-hidden-content" data-target="toogle_calendar_details">
                    <span class="lever switch-col-light-blue m-l-0"></span>
                </label>
            </div>
            <!--more information-->
            <div class="hidden p-t-10" id="toogle_calendar_details">
                {!! $event['extendedProps']['details'] ?? '---' !!}
            </div>
        </div>
    </div>

    <!--files-->
    <div class="row event-details">
        <div class="col-lg-3 event-icon">
            <i class="ti-clip"></i> <span>@lang('lang.files')</span>
        </div>
        <div class="col-lg-9 event-info file-attachments">
            @if(count($event['extendedProps']['files']) == 0)
            ---
            @endif
            <ul>
                @foreach($event['extendedProps']['files'] as $file)
                <li class="event_file_{{ $file['file_uniqueid'] }}">
                    <a class="label label-rounded label-default tag" href="{{ $file['file_url'] }}"
                        download>{{ $file['file_name'] }}</a>
                </li>
                @endforeach
            </ul>

        </div>
    </div>

    <div class="text-right p-t-10 p-b-30">
        <!--close-->
        <button type="button" class="btn btn-rounded-x btn-secondary waves-effect text-left"
            data-dismiss="modal">@lang('lang.close')</button>

        <!--delete project event-->
        @if($event['extendedProps']['resource_type'] == 'project' && $event['extendedProps']['delete_permission'])
        <a class="btn btn-danger data-toggle-action-tooltip confirm-action-danger"
            title="{{ cleanLang(__('lang.edit')) }}" data-confirm-title="@lang('lang.delete_project')"
            data-confirm-text="@lang('lang.calendar_delete_project')" data-ajax-type="DELETE"
            data-url="{{ url('/calendar/'.$event['id'].'?resource_type=project') }}">
            @lang('lang.delete_project')
        </a>
        @endif

        <!--delete task event-->
        @if($event['extendedProps']['resource_type'] == 'task' && $event['extendedProps']['delete_permission'])
        <a class="btn btn-danger data-toggle-action-tooltip confirm-action-danger"
            title="{{ cleanLang(__('lang.edit')) }}" data-confirm-title="@lang('lang.delete_project')"
            data-confirm-text="@lang('lang.calendar_delete_task')" data-ajax-type="DELETE"
            data-url="{{ url('/calendar/'.$event['id'].'?resource_type=task') }}">
            @lang('lang.delete_task')
        </a>
        @endif

        <!--delete calendar event-->
        @if($event['extendedProps']['resource_type'] == 'calendarevent' && $event['extendedProps']['delete_permission'])
        <a class="btn btn-danger data-toggle-action-tooltip confirm-action-danger"
            title="{{ cleanLang(__('lang.edit')) }}" data-confirm-title="@lang('lang.delete_event')"
            data-confirm-text="@lang('lang.are_you_sure')" data-ajax-type="DELETE"
            data-url="{{ url('/calendar/'.$event['id'].'?resource_type=calendarevent') }}">
            @lang('lang.delete_event')
        </a>
        @endif

        <!--edit-->
        @if($event['extendedProps']['edit_permission'])
        <a type="submit" class="btn btn-rounded-x btn-info waves-effect text-left ajax-request"
            id="calendar-edit-event-button" data-ajax-type="GET" data-form-id="commonModalBody">@lang('lang.edit')</a>
        @endif

    </div>
</div>


<!--edit calendar-->
@if($event['extendedProps']['edit_permission'])
<div class="calendar-edit-container hidden" id="calendar-edit-container">
    @include('pages.calendar.components.modals.add-edit-inc')

    <div class="text-right p-t-10 p-b-30">

        <!--close-->
        <button type="button" class="btn btn-rounded-x btn-secondary waves-effect text-left"
            id="calendar-cancel-edit-event-button">@lang('lang.cancel_editing')</button>

        <!--save-->
        <button type="submit" class="btn btn-rounded-x btn-danger waves-effect text-left ajax-request"
            data-url="{{ url('/calendar/'.$event['id']) }}" data-loading-target="commonModalBody" data-ajax-type="PUT"
            data-on-start-submit-button="disable"
            data-form-id="calendar-edit-container">@lang('lang.save_changes')</button>
    </div>
</div>
@endif