    <!--title-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-2 text-left control-label col-form-label required">@lang('lang.title')</label>
        <div class="col-sm-12 col-lg-10">
            <input type="text" class="form-control form-control-sm" id="calendar_event_title"
                name="calendar_event_title" value="{{ $event['title'] ?? '' }}">
        </div>
    </div>

    <div class="modal-selector m-t-15">
        <div class="form-group form-group-checkbox row m-b-10">
            <!--all day-->
            <div class="col-6 p-t-5">
                <input type="checkbox" id="calendar_event_all_day" name="calendar_event_all_day"
                    class="filled-in chk-col-light-blue"
                    {{ runtimePrechecked($event['extendedProps']['all_day'] ?? 'yes') }}
                    {{ runtimeDisabledCalenderAllDayCheckbox($event['extendedProps']['resource_type'] ?? '') }}>
                <label class="p-l-30" for="calendar_event_all_day">@lang('lang.all_day_event') 
                    <span
                        class="align-middle text-info font-16 {{ runtimeDisabledCalenderAllDayTooltip($event['extendedProps']['resource_type'] ?? '') }}" data-toggle="tooltip" title="@lang('lang.event_can_only_be_all_day')"
                        data-placement="top"><i class="ti-info-alt"></i></span>
                    </label>
            </div>
            <!--reminder-->
            <div class="col-6 p-t-5">
                <input type="checkbox" id="calendar_event_reminder" name="calendar_event_reminder"
                    class="filled-in chk-col-light-blue"
                    {{ runtimePrechecked($event['extendedProps']['reminder'] ?? 'no') }}>
                <label class="p-l-30" for="calendar_event_reminder">@lang('lang.reminder_email')</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <!--start_date-->
        <label
            class="col-sm-12 col-lg-2 text-left control-label col-form-label required">@lang('lang.start_date')</label>
        <div class="col-sm-12 col-lg-4">
            <input type="text" class="form-control form-control-sm pickadate" autocomplete="off"
                name="calendar_event_start_date"
                value="{{ runtimeDate($event['extendedProps']['start_date'] ?? '', '') }}">
            <input class="mysql-date" type="hidden" name="calendar_event_start_date" id="calendar_event_start_date"
                value="{{ $event['extendedProps']['start_date'] ?? '' }}">
        </div>
        <!--start_time-->
        <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required calendar_event_start_time">@lang('lang.start_time')</label>
        <div class="col-sm-12 col-lg-3 calendar_event_start_time">
            <input type="text" class="form-control form-control-sm timepicker" id="calendar_event_start_time"
                name="calendar_event_start_time" value="{{ $event['extendedProps']['start_time'] ?? '00:00' }}">
        </div>
    </div>

    <div class="form-group row">
        <!--end_date-->
        <label class="col-sm-12 col-lg-2 text-left control-label col-form-label required">@lang('lang.end_date')</label>
        <div class="col-sm-12 col-lg-4">
            <input type="text" class="form-control form-control-sm pickadate" autocomplete="off"
                name="calendar_event_end_date" value="{{ runtimeDate($event['extendedProps']['end_date'] ?? '', '') }}">
            <input class="mysql-date" type="hidden" name="calendar_event_end_date" id="calendar_event_end_date"
                value="{{ $event['extendedProps']['end_date'] ?? '' }}">
        </div>
        <!--end_time-->
        <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required calendar_event_end_time">@lang('lang.end_time')</label>
        <div class="col-sm-12 col-lg-3 calendar_event_end_time">
            <input type="text" class="form-control form-control-sm timepicker" id="calendar_event_end_time"
                name="calendar_event_end_time" value="{{ $event['extendedProps']['end_time'] ?? '00:00' }}">
        </div>
    </div>



    <!--description-->
    <div class="form-group row">
        <label class="col-sm-12 text-left control-label col-form-label required">@lang('lang.details')</label>
        <div class="col-sm-12">
            <textarea class="form-control form-control-sm tinymce-textarea" rows="5" name="calendar_event_description"
                id="calendar_event_description">{{ $event['extendedProps']['details'] ?? '' }}</textarea>
        </div>
    </div>

    <!--title-->
    <div class="form-group row">
        <label class="col-sm-12 col-lg-2 text-left control-label col-form-label required">@lang('lang.location')</label>
        <div class="col-sm-12 col-lg-10">
            <input type="text" class="form-control form-control-sm" id="calendar_event_location"
                name="calendar_event_location" value="{{ $event['extendedProps']['location'] ?? '' }}">
        </div>
    </div>

    <div class="line"></div>
    <!--sharing-->
    <div class="row">
        <div class="col-sm-12 col-lg-2">
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label required">@lang('lang.share_with')</label>
            </div>
        </div>
        <div class="col-sm-12 col-lg-10">
            @if((isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type'] ==
            'calendarevent') || config('response') == 'create')
            <!--myself-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_myself" name="share_with_myself"
                        class="filled-in chk-col-light-blue share-with"
                        {{ runtimePrechecked($event['extendedProps']['sharing'] ?? 'myself', 'myself') }}>
                    <label class="p-l-30" for="share_with_myself">@lang('lang.myself')</label>
                </div>
            </div>
            <!--whole team-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_whole_team" name="share_with_whole_team"
                        class="filled-in chk-col-light-blue share-with"
                        {{ runtimePrechecked($event['extendedProps']['sharing'] ?? 'myself', 'whole-team') }}>
                    <label class="p-l-30" for="share_with_whole_team">@lang('lang.whole_team')</label>
                </div>
            </div>
            <!--team members-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_team_members" name="share_with_team_members"
                        class="filled-in chk-col-light-blue share-with"
                        {{ runtimePrechecked($event['extendedProps']['sharing'] ?? 'myself', 'selected-users') }}>
                    <label class="p-l-30" for="share_with_team_members">@lang('lang.selected_team_members')</label>
                </div>
            </div>
            @else
            <!--team members-->
            <div class="form-group form-group-checkbox row">
                <div class="col-12 p-t-5">
                    <input type="checkbox" id="share_with_team_members" name="share_with_team_members"
                        class="filled-in chk-col-light-blue share-with" checked disabled>
                    <label class="p-l-30" for="share_with_team_members">@lang('lang.selected_team_members')

                        @if(isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type']
                        =='project')
                        <span class="align-middle text-info font-16" data-toggle="tooltip"
                            title="@lang('lang.calendar_assign_project_info')" data-placement="top"><i
                                class="ti-info-alt"></i></span>
                        @endif

                        @if(isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type']
                        =='task')
                        <span class="align-middle text-info font-16" data-toggle="tooltip"
                            title="@lang('lang.calendar_assign_project_info')" data-placement="top"><i
                                class="ti-info-alt"></i></span>
                        @endif

                    </label>

                </div>
            </div>
            @endif

            @if((isset($event['extendedProps']['resource_type']) && $event['extendedProps']['resource_type'] ==
            'calendarevent') || config('response') == 'create')
            <div class="form-group row {{ calendarSharing($event['extendedProps']['sharing'] ?? '') }}"
                id="share-with-users-container">
                <label
                    class="col-12 p-t-5 text-left control-label col-form-label required">@lang('lang.team_members')</label>
                <div class="col-12">
                    <select name="sharing_team_members" id="sharing_team_members"
                        class="form-control  form-control-sm select2-basic select2-multiple select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">
                        <!--array of assigned-->
                        @foreach($users as $user)
                        @php $assigned[] = $user['id']; @endphp
                        @endforeach
                        <!--/#array of assigned-->
                        <!--users list (excluding current user-->
                        @foreach(config('system.team_members') as $team)
                        @if($team->id == auth()->user()->id)
                        <option value="{{ $team->id }}" selected>
                            {{ $team->full_name }}</option>
                        @else
                        <option value="{{ $team->id }}"
                            {{ runtimePreselectedInArray($team->id ?? '', $assigned ?? []) }}>
                            {{ $team->full_name }}</option>
                        @endif
                        @endforeach
                        <!--/#users list-->
                    </select>
                </div>
            </div>
            @endif


        </div>
    </div>

    <div class="line"></div>

    <!--more information - toggle-->
    <div class="spacer row">
        <div class="col-sm-12 col-lg-8">
            <span class="title">@lang('lang.attach_files')</span>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="switch  text-right">
                <label>
                    <input type="checkbox" name="more_information" id="more_information"
                        class="js-switch-toggle-hidden-content" data-target="toogle_attach_files">
                    <span class="lever switch-col-light-blue"></span>
                </label>
            </div>
        </div>
    </div>
    <!--more information-->
    <div class="hidden p-t-10" id="toogle_attach_files">
        <!--attach files-->
        <div class="form-group row">
            <div class="col-12">
                <div class="dropzone dz-clickable" id="dropzone_upload_multiple_files">
                    <div class="dz-default dz-message">
                        <i class="icon-Upload-toCloud"></i>
                        <span>@lang('lang.drag_drop_file')</span>
                    </div>
                </div>
            </div>
        </div>

        <!--edit existing-->
        @if(config('response') == 'show' || config('response') == 'edit')
        <table class="table table-bordered">
            <tbody>
                @foreach($event['extendedProps']['files'] as $file)
                <tr class="event_file_{{ $file['file_uniqueid'] }}">
                    <td>{{ $file['file_name'] }} </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                            data-url="{{ url('/calendar/files/'.$file['file_uniqueid'].'?type='.$file['file_type']) }}">
                            <i class="sl-icon-trash"></i>
                        </button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>


    <!--resource type-->
    <input type="hidden" name="resource_type" value="{{ $event['extendedProps']['resource_type'] ?? 'calendarevent' }}">