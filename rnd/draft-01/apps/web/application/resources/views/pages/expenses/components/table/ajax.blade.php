@foreach($expenses as $expense)
<!--each row-->
<tr id="expense_{{ $expense->expense_id }}" class="{{ $expense->pinned_status ?? '' }}">
    @if(config('visibility.expenses_col_checkboxes'))
    <td class="expenses_col_checkbox checkitem" id="expenses_col_checkbox_{{ $expense->expense_id }}">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-expenses-{{ $expense->expense_id }}"
                name="ids[{{ $expense->expense_id }}]"
                class="listcheckbox listcheckbox-expenses filled-in chk-col-light-blue expenses-checkbox"
                data-actions-container-class="expenses-checkbox-actions-container"
                data-expense-id="{{ $expense->expense_id }}" data-unit="{{ cleanLang(__('lang.item')) }}"
                data-quantity="1" data-description="{{ $expense->expense_description }}"
                data-rate="{{ $expense->expense_amount }}">
            <label for="listcheckbox-expenses-{{ $expense->expense_id }}"></label>
        </span>
    </td>
    @endif
    <td class="expenses_col_id">
        <span class="display-inline-block">{{ $expense->expense_id }}</span>
        <!--recurring-->
        @if($expense->expense_recurring == 'yes')
        <span class="sl-icon-refresh text-danger display-inline-block p-l-5 vertical-align-middle" data-toggle="tooltip"
            title="@lang('lang.recurring_expense')"></span>
        @endif
        <!--child expense-->
        @if($expense->expense_recurring_child == 'yes')
        <span class="ti-back-right text-success display-inline-block p-l-5 vertical-align-middle" data-toggle="tooltip"
            title="@lang('lang.expense_automatically_created_from_recurring') (#{{ $expense->expense_recurring_parent_id }})"></span>
        @endif
    </td>
    @if(config('visibility.expenses_col_date'))
    <td class="expenses_col_date">
        {{ runtimeDate($expense->expense_date) }}
    </td>
    @endif
    @if(config('visibility.expenses_col_description'))
    <td class="expenses_col_description">
        @if(config('settings.trimmed_title'))
        <span
            title="{{ $expense->expense_description }}">{{ str_limit($expense->expense_description ?? '---', 15) }}</span>
        @else
        <span
            title="{{ $expense->expense_description }}">{{ str_limit($expense->expense_description ?? '---', 35) }}</span>
        @endif
    </td>
    @endif
    <!--column visibility-->
    @if(config('visibility.expenses_col_user'))
    <td class="expenses_col_user">
        <span class="printing_hidden">
        <img src="{{ getUsersAvatar($expense->avatar_directory, $expense->avatar_filename) }}" alt="user"
            class="img-circle avatar-xsmall"> {{ str_limit($expense->first_name ?? runtimeUnkownUser(), 8) }}
        </span>

        <!--print view-->
        <span class="hidden printing_visible">
            {{ $expense->first_name ?? runtimeUnkownUser() }} {{ $expense->last_name ?? '' }}
        </span>
    </td>
    @endif
    <!--column visibility-->
    @if(config('visibility.expenses_col_client'))
    <td class="expenses_col_client">
        <a
            href="/clients/{{ $expense->expense_clientid }}">{{ str_limit($expense->client_company_name ?? '---', 12) }}</a>
    </td>
    @endif
    <!--column visibility-->
    @if(config('visibility.expenses_col_project'))
    <td class="expenses_col_project">
        <a href="/projects/{{ $expense->expense_projectid }}">{{ str_limit($expense->project_title ?? '---', 12) }}</a>
    </td>
    @endif
    @if(config('visibility.expenses_col_amount'))
    <td class="expenses_col_amount">
        {{ runtimeMoneyFormat($expense->expense_amount) }}
    </td>
    @endif
    @if(config('visibility.expenses_col_status'))
    <td class="expenses_col_status">

        @if($expense->expense_billable == 'billable')
        @if($expense->expense_billing_status == 'invoiced')
        <span class="table-icons printing_hidden">
            <a href="{{ url('/invoices/'.$expense->expense_billable_invoiceid) }}">
                <i class="mdi mdi-credit-card-plus text-danger" data-toggle="tooltip"
                    title="{{ cleanLang(__('lang.invoiced')) }} : {{ runtimeInvoiceIdFormat($expense->expense_billable_invoiceid) }}"></i>
            </a>
        </span>
        <!--printing-->
        <span class="hidden printing_visible">@lang('lang.invoiced')</span>
        @else
        <span class="table-icons printing_hidden">
            <i class="mdi mdi-credit-card-plus text-success" data-toggle="tooltip"
                title="{{ cleanLang(__('lang.billable')) }} - {{ cleanLang(__('lang.not_invoiced')) }}"></i>
        </span>
        <!--printing-->
        <span class="hidden printing_visible">@lang('lang.billable') - @lang('lang.not_invoiced')</span>
        @endif
        @else
        <span class="table-icons printing_hidden">
            <i class="mdi mdi-credit-card-off text-disabled" data-toggle="tooltip"
                title="{{ cleanLang(__('lang.not_billable')) }}"></i>
        </span>
        <!--printing-->
        <span class="hidden printing_visible">@lang('lang.not_billable')</span>
        @endif
    </td>
    @endif
    @if(config('visibility.expenses_col_action'))
    <td class="expenses_col_action actions_column" id="expenses_col_action_{{ $expense->expense_id }}">
        <!--action button-->
        <span class="list-table-action font-size-inherit">
            <!--delete-->
            @if(config('visibility.action_buttons_delete'))
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                data-url="{{ url('/') }}/expenses/{{ $expense->expense_id }}">
                <i class="sl-icon-trash"></i>
            </button>
            @endif
            <!--edit-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/expenses/'.$expense->expense_id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.edit_expense')) }}"
                data-action-url="{{ urlResource('/expenses/'.$expense->expense_id.'?ref=list') }}"
                data-action-method="PUT" data-action-ajax-class=""
                data-action-ajax-loading-target="expenses-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="{{ cleanLang(__('lang.expense_records')) }}"
                data-url="{{ url('/expenses/'.$expense->expense_id) }}">
                <i class="ti-new-window"></i>
            </button>

            <!--more button (team)-->
            @if(config('visibility.action_buttons_edit') == 'show')
            <span class="list-table-action dropdown font-size-inherit">
                <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" title="{{ cleanLang(__('lang.more')) }}"
                    class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                    <i class="ti-more"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="listTableAction">
                    @if($expense->expense_billing_status == 'not_invoiced')
                    <!--actions button - attach project -->
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                        data-modal-title=" {{ cleanLang(__('lang.attach_to_project')) }}"
                        data-url="{{ url('/expenses/' . $expense->expense_id .'/attach-dettach') }}"
                        data-action-url="{{ urlResource('/expenses/' . $expense->expense_id .'/attach-dettach') }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        {{ cleanLang(__('lang.attach_dettach')) }}</a>
                    @endif
                    <!--actions button - change category-->
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                        data-modal-title="{{ cleanLang(__('lang.change_category')) }}"
                        data-url="{{ url('/expenses/change-category') }}"
                        data-action-url="{{ urlResource('/expenses/change-category?id='.$expense->expense_id) }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        {{ cleanLang(__('lang.change_category')) }}</a>

                    <!--recurring settings-->
                    <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/expenses/'.$expense->expense_id.'/recurring-settings?source=list') }}"
                        data-loading-target="commonModalBody" data-modal-title="@lang('lang.recurring_settings')"
                        data-action-url="{{ url('/expenses/'.$expense->expense_id.'/recurring-settings?source=list') }}"
                        data-action-method="POST"
                        data-action-ajax-loading-target="invoices-td-container">@lang('lang.recurring_settings')</a>

                    <!--stop recurring -->
                    @if($expense->expense_recurring == 'yes')
                    <a class="dropdown-item confirm-action-info" href="javascript:void(0)"
                        data-confirm-title="{{ cleanLang(__('lang.stop_recurring')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                        data-url="{{ urlResource('/expenses/'.$expense->expense_id.'/stop-recurring') }}">
                        {{ cleanLang(__('lang.stop_recurring')) }}</a>
                    @endif

                    <!--clone expense-->
                    @if(auth()->user()->role->role_expenses > 1)
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                        href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                        data-modal-title="{{ cleanLang(__('lang.clone_expense')) }}"
                        data-url="{{ url('/expenses/'.$expense->expense_id.'/clone') }}"
                        data-action-ajax-class="ajax-request"
                        data-action-url="{{ url('/expenses/'.$expense->expense_id.'/clone?filter_category='.request('filter_category')) }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        {{ cleanLang(__('lang.clone_expense')) }}</a>
                    @endif

                </div>
            </span>
            @endif

            <!--pin-->
            <span class="list-table-action">
                <a href="javascript:void(0);" title="{{ cleanLang(__('lang.pinning')) }}"
                    data-parent="expense_{{ $expense->expense_id }}"
                    data-url="{{ url('/expenses/'.$expense->expense_id.'/pinning') }}"
                    class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm opacity-4 js-toggle-pinning">
                    <i class="ti-pin2"></i>
                </a>
            </span>
        </span>
        <!--action button-->

    </td>
    @endif
</tr>
@endforeach
<!--each row-->