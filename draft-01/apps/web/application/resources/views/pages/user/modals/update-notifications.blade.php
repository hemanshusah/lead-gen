<div class="splash-image" id="updatePasswordSplash">
    <img src="{{ url('/') }}/public/images/notifications.png" alt="404 - Not found" />
</div>
<div class="splash-text">
    @lang('lang.notify_me_about_these_events')
</div>
<div class="splash-subtext">
    @lang('lang.events_such_as')
</div>

<!--notifications_new_assignement-->
@if(auth()->user()->is_team)
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.new_assignment')</label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_new_assignement"
            data-allow-clear="false" name="notifications_new_assignement">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_new_assignement) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_new_assignement) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_new_assignement) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>
@endif


<!--notifications_billing_activity-->
@if(auth()->user()->is_team)
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.billing')</label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_billing_activity"
            data-allow-clear="false" name="notifications_billing_activity">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_billing_activity) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_billing_activity) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_billing_activity) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>
@endif


<!--notifications_new_project-->
@if(auth()->user()->is_client)
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.new_project')</label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_new_project"
            data-allow-clear="false" name="notifications_new_project">
            <option value="yes_email" {{ runtimePreselected('yes_email', auth()->user()->notifications_new_project) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_new_project) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>
@endif

<!--notifications_projects_activity-->
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.projects') <span
        class="align-middle text-info font-16 hidden" data-toggle="tooltip" title="@lang('lang.info_general_activity')"
        data-placement="top"><i class="ti-info-alt"></i></span></label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_projects_activity"
            data-allow-clear="false" name="notifications_projects_activity">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_projects_activity) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_projects_activity) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_projects_activity) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>


<!--[future] notifications_projects_comments-->
<div class="form-group form-group-checkbox row hidden">
    <label class="col-5 col-form-label text-left">@lang('lang.projects_comments')</label>
           <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_projects_comments"
            data-allow-clear="false" name="notifications_projects_comments">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_projects_comments) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_mentions" {{ runtimePreselected('yes_mentions', auth()->user()->notifications_projects_comments) }}>
                @lang('lang.notification_only') (@lang('lang.mentions_only'))</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_projects_comments) }}>
                @lang('lang.notification_and_email')</option>
            <option value="yes_email_mentions"
                {{ runtimePreselected('yes_email_mentions', auth()->user()->notifications_projects_comments) }}>
                @lang('lang.notification_and_email') (@lang('lang.mentions_only'))</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_projects_comments) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>



@if(auth()->user()->is_team)
<!--notifications_leads_activity-->
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.leads_activity') <span
        class="align-middle text-info font-16 hidden" data-toggle="tooltip" title="@lang('lang.info_general_activity')"
        data-placement="top"><i class="ti-info-alt"></i></span></label>
            <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_leads_activity"
            data-allow-clear="false" name="notifications_leads_activity">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_leads_activity) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_leads_activity) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_leads_activity) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>

<!--[future] notifications_leads_comments-->
<div class="form-group form-group-checkbox row hidden">
    <label class="col-5 col-form-label text-left">@lang('lang.leads_comments')</label>
           <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_leads_comments"
            data-allow-clear="false" name="notifications_leads_comments">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_leads_comments) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_mentions" {{ runtimePreselected('yes_mentions', auth()->user()->notifications_leads_comments) }}>
                @lang('lang.notification_only') (@lang('lang.mentions_only'))</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_leads_comments) }}>
                @lang('lang.notification_and_email')</option>
            <option value="yes_email_mentions"
                {{ runtimePreselected('yes_email_mentions', auth()->user()->notifications_leads_comments) }}>
                @lang('lang.notification_and_email') (@lang('lang.mentions_only'))</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_leads_comments) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>
@endif

<!--notifications_tasks_activity-->
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.tasks_activity') <span
            class="align-middle text-info font-16 hidden" data-toggle="tooltip" title="@lang('lang.info_general_activity')"
            data-placement="top"><i class="ti-info-alt"></i></span></label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_tasks_activity"
            data-allow-clear="false" name="notifications_tasks_activity">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_tasks_activity) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_tasks_activity) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_tasks_activity) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>

<!--[future] notifications_tasks_comments-->
<div class="form-group form-group-checkbox row hidden">
    <label class="col-5 col-form-label text-left">@lang('lang.tasks_comments')</label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_tasks_comments"
            data-allow-clear="false" name="notifications_tasks_comments">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_tasks_comments) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_mentions" {{ runtimePreselected('yes_mentions', auth()->user()->notifications_tasks_comments) }}>
                @lang('lang.notification_only') (@lang('lang.mentions_only'))</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_tasks_comments) }}>
                @lang('lang.notification_and_email')</option>
            <option value="yes_email_mentions"
                {{ runtimePreselected('yes_email_mentions', auth()->user()->notifications_tasks_comments) }}>
                @lang('lang.notification_and_email') (@lang('lang.mentions_only'))</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_tasks_comments) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>

<!--notifications_tickets_activity-->
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.support_tickets')</label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_tickets_activity"
            data-allow-clear="false" name="notifications_tickets_activity">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_tickets_activity) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_email"
                {{ runtimePreselected('yes_email', auth()->user()->notifications_tickets_activity) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_tickets_activity) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>

<!--notifications_reminders-->
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.reminders')</label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_reminders"
            data-allow-clear="false" name="notifications_reminders">
            <option value="email" {{ runtimePreselected('email', auth()->user()->notifications_reminders) }}>
                @lang('lang.email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_reminders) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>


<!--notifications_system-->
<div class="form-group form-group-checkbox row">
    <label class="col-5 col-form-label text-left">@lang('lang.system_notifications')</label>
    <div class="col-7 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_system"
            data-allow-clear="false" name="notifications_system">
            <option value="yes" {{ runtimePreselected('yes', auth()->user()->notifications_system) }}>
                @lang('lang.notification_only')</option>
            <option value="yes_email" {{ runtimePreselected('yes_email', auth()->user()->notifications_system) }}>
                @lang('lang.notification_and_email')</option>
            <option value="no" {{ runtimePreselected('no', auth()->user()->notifications_system) }}>
                @lang('lang.nothing')</option>
        </select>
    </div>
</div>