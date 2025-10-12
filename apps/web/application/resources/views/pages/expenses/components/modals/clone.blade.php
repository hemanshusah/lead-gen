<div class="row">
    <div class="col-lg-12">

        <!--user-->
        @if(auth()->user()->role->role_expenses_scope == 'global')
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.team_member')</label>
            <div class="col-sm-12 col-lg-9">
                <select name="expense_creatorid" id="expense_creatorid"
                    class="select2-basic form-control form-control-sm">
                    <option></option>
                    <!--users list-->
                    @foreach(config('system.team_members') as $user)
                    <option value="{{ $user->id }}"
                        {{ runtimePreselected($user->id, $expense->expense_creatorid ?? '') }}>{{
                            $user->full_name }}</option>
                    @endforeach
                    <!--/#users list-->
                </select>
            </div>
        </div>
        @endif


        <!--expense date-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.date')</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control  form-control-sm pickadate" name="expense_date"
                    autocomplete="off" value="{{ runtimeDatepickerDate($expense->expense_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="expense_date" id="expense_date"
                    value="{{ $expense->expense_date ?? '' }}">
            </div>
        </div>

        <!--client-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label  required">{{ cleanLang(__('lang.client')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="expense_clientid" id="expense_clientid"
                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                    data-projects-dropdown="expense_projectid" data-feed-request-type="clients_projects"
                    data-ajax--url="{{ url('/') }}/feed/company_names">
                </select>
            </div>
        </div>


        <!--projects-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.project')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm dynamic_expense_projectid"
                    data-allow-clear="true" id="expense_projectid" name="expense_projectid" disabled>
                </select>
            </div>
        </div>

        <!--/#tags-->
        <!--expense category-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label  required">{{ cleanLang(__('lang.category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="expense_categoryid"
                    name="expense_categoryid">
                    @foreach($categories as $category)
                    <option value="{{ $category->category_id }}"
                        {{ runtimePreselected($expense->expense_categoryid ?? '', $category->category_id) }}>{{
                                runtimeLang($category->category_name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--description-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea class="w-100" id="expense_description" rows="4"
                    name="expense_description">{{ $expense->expense_description ?? '' }}</textarea>
            </div>
        </div>


        <div class="line"></div>

        @if($expense->expense_recurring == 'yes')
        <div class="form-group form-group-checkbox row">
            <div class="col-12 p-t-5">
                <input type="checkbox" id="clone_recurring_settings" name="clone_recurring_settings"
                    class="filled-in chk-col-light-blue" checked>
                <label class="p-l-30" for="clone_recurring_settings">@lang('lang.clone_recurring_settings')</label>
            </div>
        </div>
        @endif


        <div class="form-group form-group-checkbox row">
            <div class="col-12 p-t-5">
                <input type="checkbox" id="clone_files" name="clone_files" class="filled-in chk-col-light-blue" checked>
                <label class="p-l-30" for="clone_files">@lang('lang.clone_files')</label>
            </div>
        </div>

    </div>
</div>