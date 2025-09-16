    <!--automation_default_status-->
    <div class="form-group row p-b-10">
        <label class="col-sm-12 col-lg-4 text-left control-label col-form-label">@lang('lang.automation')</label>
        <div class="col-sm-12 col-lg-8">
            <select class="select2-basic form-control form-control-sm select2-preselected"
                id="proposal_automation_status" name="proposal_automation_status"
                data-preselected="{{ $automation['proposal_automation_default_status'] }}">
                <option></option>
                <option value="enabled">@lang('lang.enabled')</option>
                <option value="disabled">@lang('lang.disabled')</option>
            </select>
        </div>
    </div>



    <!--automation settings-->
    <div class="p-t-10 client-selector {{ proposalAutomationVisibility($automation['proposal_automation_default_status']) }}"
        id="automation-options-container">

        <!--[automation option]-->
        <div class="alert alert-info m-b-20 m-t-25">
            <h6>@lang('lang.automation_option')</h6> @lang('lang.proposal_automation_info_1'): <span
                class="align-middle text-info font-16" data-toggle="tooltip" title="@lang('lang.proposal_automation_info_2')"
                data-placement="top"><i class="ti-info-alt"></i></span>
        </div>

        <!--automation_create_project-->
        <div class="form-group form-group-checkbox row">
            <div class="col-12">
                <label class="text-left control-label col-form-label required p-r-3">@lang('lang.automation_create_project')</label>
                <span class="text-right p-l-5">
                    <input type="checkbox" id="proposal_automation_create_project"
                        name="proposal_automation_create_project" class="filled-in chk-col-light-blue"
                        {{ runtimePrechecked($automation['proposal_automation_create_project']) }}>
                    <label class="display-inline" for="proposal_automation_create_project"></label>
                </span>
            </div>
        </div>

        <!--project creation options-->
        <div class="card-contrast-panel m-l-30 {{ proposalAutomationVisibility($automation['proposal_automation_create_project']) }}"
            id="proposal_automation_create_project_options">

            <!--automation_project_title-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label">@lang('lang.project_title')</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="proposal_automation_project_title"
                        name="proposal_automation_project_title"
                        value="{{ $automation['proposal_automation_project_title'] }}">
                </div>
            </div>

            <!--automation_project_status-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-6 text-left control-label col-form-label">@lang('lang.automation_create_project_status')</label>
                <div class="col-sm-12 col-lg-6">
                    <select class="select2-basic form-control form-control-sm select2-preselected"
                        id="proposal_automation_project_status" name="proposal_automation_project_status"
                        data-preselected="{{ $automation['proposal_automation_project_status'] }}">
                        <option></option>
                        <option value="not_started">@lang('lang.not_started')</option>
                        <option value="in_progress">@lang('lang.in_progress')</option>
                        <option value="on_hold">@lang('lang.on_hold')</option>
                    </select>
                </div>
            </div>

            <!--proposal_automation_assigned_users-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-6 text-left control-label col-form-label">@lang('lang.automation_assign_project')</label>
                <div class="col-sm-12 col-lg-6">
                    <select name="proposal_automation_assigned_users" id="proposal_automation_assigned_users"
                        class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">
                        @foreach(config('system.team_members') as $user)
                        <option value="{{ $user->id }}"
                            {{ runtimePreselectedInArray($user->id ?? '', $assigned ?? []) }}>{{
                                $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!--automation_create_tasks-->
            <div class="form-group form-group-checkbox row">
                <label
                    class="col-sm-12 col-lg-6 col-form-label text-left">@lang('lang.automation_create_tasks_from_line_item')</label>
                <div class="col-sm-12 col-lg-6 text-left p-t-5">
                    <input type="checkbox" id="proposal_automation_create_tasks"
                        {{ runtimePrechecked($automation['proposal_automation_create_tasks'] ) }}
                        name="proposal_automation_create_tasks" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="proposal_automation_create_tasks"></label>
                </div>
            </div>

            <!--automation_project_email_client-->
            <div class="form-group form-group-checkbox row">
                <label class="col-sm-12 col-lg-6 col-form-label text-left">@lang('lang.automation_email_client')
                    <span class="align-middle text-info font-16" data-toggle="tooltip"
                        title="@lang('lang.automation_email_client_project_info')" data-placement="top"><i class="ti-info-alt"></i></span></label>
                <div class="col-sm-12 col-lg-6 text-left p-t-5">
                    <input type="checkbox" id="proposal_automation_project_email_client"
                        {{ runtimePrechecked($automation['proposal_automation_project_email_client'] ) }}
                        name="proposal_automation_project_email_client" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="proposal_automation_project_email_client"></label>
                </div>
            </div>


        </div>

        <!--[automation option]-->
        <div class="alert alert-info m-b-20 m-t-50">
            <h6>@lang('lang.automation_option')</h6> @lang('lang.proposal_automation_info_1'): <span
                class="align-middle text-info font-16" data-toggle="tooltip" title="@lang('lang.proposal_automation_info_2')"
                data-placement="top"><i class="ti-info-alt"></i></span>
        </div>

        <!--automation_create_invoice-->
        <div class="form-group form-group-checkbox row">
            <div class="col-12">
                <label class="text-left control-label col-form-label required p-r-3">@lang('lang.automation_create_invoice')</label>
                <span class="text-right p-l-5">
                    <input type="checkbox" id="proposal_automation_create_invoice"
                        name="proposal_automation_create_invoice" class="filled-in chk-col-light-blue"
                        {{ runtimePrechecked($automation['proposal_automation_create_invoice'] ) }}>
                    <label class="display-inline" for="proposal_automation_create_invoice"></label>
                </span>
            </div>
        </div>

        <!--invoice creation options-->
        <div class="card-contrast-panel m-l-30 {{ proposalAutomationVisibility($automation['proposal_automation_create_invoice']) }}"
            id="proposal_automation_create_invoice_options">

            <!--item-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-6 text-left control-label col-form-label">@lang('lang.automation_invoice_due_date')</label>
                <div class="col-sm-12 col-lg-6">
                    <input type="text" class="form-control form-control-sm" id="proposal_automation_invoice_due_date"
                        name="proposal_automation_invoice_due_date"
                        value="{{ $automation['proposal_automation_invoice_due_date'] }}">
                </div>
            </div>

            <!--automation_invoice_email_client-->
            <div class="form-group form-group-checkbox row">
                <label class="col-sm-12 col-lg-6 col-form-label text-left">@lang('lang.automation_email_client')
                    <span class="align-middle text-info font-16" data-toggle="tooltip"
                        title="@lang('lang.automation_email_client_invoice_info')" data-placement="top"><i class="ti-info-alt"></i></span></label>
                <div class="col-sm-12 col-lg-6 text-left p-t-5">
                    <input type="checkbox" id="proposal_automation_invoice_email_client"
                        {{ runtimePrechecked($automation['proposal_automation_invoice_email_client'] ) }}
                        name="proposal_automation_invoice_email_client" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="proposal_automation_invoice_email_client"></label>
                </div>
            </div>

        </div>

    </div>