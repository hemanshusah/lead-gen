@foreach($invoices as $invoice)
<!--each row-->
<tr id="invoice_{{ $invoice->bill_invoiceid  }}" class="{{ $invoice->pinned_status ?? '' }}">
    @if(config('visibility.invoices_col_checkboxes'))
    <td class="invoices_col_checkbox checkitem" id="invoices_col_checkbox_{{ $invoice->bill_invoiceid }}">
        <!--list checkbo-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-invoices-{{ $invoice->bill_invoiceid }}"
                name="ids[{{ $invoice->bill_invoiceid }}]"
                class="listcheckbox listcheckbox-invoices filled-in chk-col-light-blue"
                data-actions-container-class="invoices-checkbox-actions-container">
            <label for="listcheckbox-invoices-{{ $invoice->bill_invoiceid }}"></label>
        </span>
    </td>
    @endif

    <!--tableconfig_column_1 [id]-->
    <td class="invoices_col_tableconfig_column_1 {{ config('table.tableconfig_column_1') }} tableconfig_column_1"
        id="invoices_col_id_{{ $invoice->bill_invoiceid }}">
        <a href="/invoices/{{ $invoice->bill_invoiceid }}">
            {{ $invoice->formatted_bill_invoiceid }} </a>
        <!--recurring-->
        @if(auth()->user()->is_team && $invoice->bill_recurring == 'yes')
        <span class="sl-icon-refresh text-danger p-l-5" data-toggle="tooltip"
            title="@lang('lang.recurring_invoice')"></span>
        @endif
        <!--child invoice-->
        @if(auth()->user()->is_team && $invoice->bill_recurring_child == 'yes')
        <a href="{{ url('invoices/'.$invoice->bill_recurring_parent_id) }}">
            <i class="ti-back-right text-success p-l-5" data-toggle="tooltip" data-html="true"
                title="{{ cleanLang(__('lang.invoice_automatically_created_from_recurring')) }} <br>(#{{ runtimeInvoiceIdFormat($invoice->bill_recurring_parent_id) }})"></i>
        </a>
        @endif
    </td>


    <!--tableconfig_column_2 [parent id] -->
    <td class="invoices_col_tableconfig_column_2 {{ config('table.tableconfig_column_2') }} tableconfig_column_2"
        id="invoices_col_tableconfig_column_2{{ $invoice->bill_invoiceid }}">
        {{ $invoice->bill_recurring_parent_id ?? '---' }}
    </td>


    <!--tableconfig_column_3 [date]-->
    <td class="invoices_col_tableconfig_column_3 {{ config('table.tableconfig_column_3') }} tableconfig_column_3"
        id="invoices_col_date_{{ $invoice->bill_invoiceid }}">
        {{ runtimeDate($invoice->bill_date) }}
    </td>

    <!--tableconfig_column_4 [due]-->
    <td class="invoices_col_tableconfig_column_4 {{ config('table.tableconfig_column_4') }} tableconfig_column_4"
        id="invoices_col_tableconfig_column_4_{{ $invoice->bill_invoiceid }}">
        {{ runtimeDate($invoice->bill_due_date ?? '') }}
    </td>

    <!--tableconfig_column_5 [company name]-->
    <td class="invoices_col_tableconfig_column_5 {{ config('table.tableconfig_column_5') }} tableconfig_column_5"
        id="invoices_col_company_{{ $invoice->bill_invoiceid }}">
        <a href="/clients/{{ $invoice->bill_clientid }}">{{ str_limit($invoice->client_company_name ?? '---', 22) }}</a>
    </td>

    <!--tableconfig_column_6 [client contact] -->
    <td class="invoices_col_tableconfig_column_6 {{ config('table.tableconfig_column_6') }} tableconfig_column_6"
        id="invoices_col_tableconfig_column_6_{{ $invoice->bill_invoiceid }}">
        @if(isset($invoice->contact_name) && $invoice->contact_name != '')
        <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal" data-url="{{ url('contacts/'.$invoice->contact_id) }}"
            data-loading-target="commonModalBody" data-modal-title="" data-modal-size="modal-md"
            data-header-close-icon="hidden" data-header-extra-close-icon="visible" data-footer-visibility="hidden"
            data-action-ajax-loading-target="commonModalBody">{{ $invoice->contact_name }}
        </a>
        @else
        <span>---</span>
        @endif
    </td>

    <!--tableconfig_column_7 [created by] -->
    <td class="invoices_col_tableconfig_column_7 {{ config('table.tableconfig_column_7') }} tableconfig_column_7"
        id="invoices_col_tableconfig_column_7_{{ $invoice->bill_invoiceid }}">
        <span class="printing_hidden">
            <img src="{{ getUsersAvatar($invoice->avatar_directory, $invoice->avatar_filename, $invoice->bill_creatorid) }}"
                alt="user" class="img-circle avatar-xsmall printing_hidden">
            <span
                class="user-profile-first-name">{{ checkUsersName($invoice->first_name, $invoice->bill_creatorid)  }}</span>
        </span>

        <!--print view-->
        <span class="hidden printing_visible">
            {{ $invoice->first_name ?? runtimeUnkownUser() }} {{ $invoice->last_name ?? '' }}
        </span>
    </td>

    <!--tableconfig_column_8 [project] -->
    <td class="invoices_col_tableconfig_column_8 {{ config('table.tableconfig_column_8') }} tableconfig_column_8"
        id="invoices_col_tableconfig_column_8_{{ $invoice->bill_invoiceid }}">
        {{ $invoice->bill_projectid ?? '---' }}
    </td>

    <!--tableconfig_column_9 [project_title] -->
    <td class="invoices_col_tableconfig_column_9 {{ config('table.tableconfig_column_9') }} tableconfig_column_9"
        id="invoices_col_project_{{ $invoice->bill_invoiceid }}">
        <a href="/projects/{{ $invoice->bill_projectid }}">{{ str_limit($invoice->project_title ?? '---', 20) }}</a>
    </td>

    <!--tableconfig_column_10 [tax] -->
    <td class="invoices_col_tableconfig_column_10 {{ config('table.tableconfig_column_10') }} tableconfig_column_10"
        id="invoices_col_tableconfig_column_10_{{ $invoice->bill_invoiceid }}">
        {{ runtimeMoneyFormat($invoice->bill_tax_total_amount) }}
    </td>

    <!--tableconfig_column_11 [discount type] -->
    <td class="invoices_col_tableconfig_column_11 {{ config('table.tableconfig_column_11') }} tableconfig_column_11"
        id="invoices_col_tableconfig_column_11_{{ $invoice->bill_invoiceid }}">
        @if($invoice->bill_discount_type == 'fixed')
        @lang('lang.fixed_amount')
        @endif
        @if($invoice->bill_discount_type == 'none')
        ---
        @endif
        @if($invoice->bill_discount_type == 'percentage')
        {{ $invoice->bill_discount_percentage }}%
        @endif
    </td>

    <!--tableconfig_column_12 [discount amount] -->
    <td class="invoices_col_tableconfig_column_12 {{ config('table.tableconfig_column_12') }} tableconfig_column_12"
        id="invoices_col_tableconfig_column_12_{{ $invoice->bill_invoiceid }}">
        @if($invoice->bill_discount_amount == '0.00')
        ---
        @else
        {{ runtimeMoneyFormat($invoice->bill_discount_amount) }}
        @endif
    </td>

    <!--tableconfig_column_13 [last payment - date] -->
    <td class="invoices_col_tableconfig_column_13 {{ config('table.tableconfig_column_13') }} tableconfig_column_13"
        id="tableconfig_column_13_{{ $invoice->bill_invoiceid }}">
        {{ runtimeDate($invoice->last_payment_date) }}
    </td>

    <!--tableconfig_column_14 [last payment - amount] -->
    <td class="invoices_col_tableconfig_column_14 {{ config('table.tableconfig_column_14') }} tableconfig_column_14"
        id="invoices_col_tableconfig_column_14_{{ $invoice->bill_invoiceid }}">
        @if($invoice->last_payment_amount == '0.00')
        ---
        @else
        {{ runtimeMoneyFormat($invoice->last_payment_amount) }}
        @endif
    </td>



    <!--tableconfig_column_15 [last payment - method] -->
    <td class="invoices_col_tableconfig_column_15 {{ config('table.tableconfig_column_15') }} tableconfig_column_15 ucw"
        id="invoices_col_tableconfig_column_15_{{ $invoice->bill_invoiceid }}">
        {{ $invoice->last_payment_method ?? '---' }}
    </td>

    <!--tableconfig_column_16 [last payment - transaction id] -->
    <td class="invoices_col_tableconfig_column_16 {{ config('table.tableconfig_column_16') }} tableconfig_column_16"
        id="invoices_col_tableconfig_column_16_{{ $invoice->bill_invoiceid }}">
        {{ $invoice->last_payment_transaction_id ?? '---' }}
    </td>

    <!--tableconfig_column_17 [attachments] -->
    <td class="invoices_col_tableconfig_column_17 {{ config('table.tableconfig_column_17') }} tableconfig_column_17"
        id="invoices_col_tableconfig_column_17_{{ $invoice->bill_invoiceid }}">
        @if($invoice->count_attachments == 0)
        ---
        @else
        {{ $invoice->count_attachments }}
        @endif
    </td>

    <!--tableconfig_column_19 [scheduled publishing date] -->
    <td class="invoices_col_tableconfig_column_19 {{ config('table.tableconfig_column_19') }} tableconfig_column_19"
        id="invoices_col_tableconfig_column_19_{{ $invoice->bill_invoiceid }}">
        {{ runtimeDate($invoice->bill_publishing_scheduled_date ?? '') }}
    </td>


    <!--tableconfig_column_20 [payments]-->
    <td class="invoices_col_tableconfig_column_20 {{ config('table.tableconfig_column_20') }} tableconfig_column_20"
        id="invoices_col_tableconfig_column_20_{{ $invoice->bill_invoiceid }}">
        <a
            href="{{ url('payments?filter_payment_invoiceid='.$invoice->bill_invoiceid) }}">{{ runtimeMoneyFormat($invoice->sum_payments) }}</a>
    </td>

    <!--tableconfig_column_21 [amount]-->
    <td class="invoices_col_tableconfig_column_21 {{ config('table.tableconfig_column_21') }} tableconfig_column_21"
        id="invoices_col_amount_{{ $invoice->bill_invoiceid }}">
        {{ runtimeMoneyFormat($invoice->bill_final_amount) }}</td>


    <!--tableconfig_column_22 [balance]-->
    <td class="invoices_col_tableconfig_column_22 {{ config('table.tableconfig_column_22') }} tableconfig_column_22"
        id="invoices_col_balance_{{ $invoice->bill_invoiceid }}">
        {{ runtimeMoneyFormat($invoice->invoice_balance) }}
    </td>

    <!--tableconfig_column_23 [status]-->
    <td class="invoices_col_tableconfig_column_23 {{ config('table.tableconfig_column_23') }} tableconfig_column_23"
        id="invoices_col_status_{{ $invoice->bill_invoiceid }}">

        <span class="label {{ runtimeInvoiceStatusColors($invoice->bill_status, 'label') }}">{{
            runtimeLang($invoice->bill_status) }}</span>

        <!--invoice is scheduled-->
        @if($invoice->bill_publishing_type == 'scheduled' && $invoice->bill_publishing_scheduled_status == 'pending')
        <span class="label label-icons label-icons-warning" data-toggle="tooltip" data-placement="top"
            title="@lang('lang.scheduled_publishing_info'): {{ runtimeDate($invoice->bill_publishing_scheduled_date) }}"><i
                class="sl-icon-clock"></i></span>
        @endif

        @if(config('system.settings_estimates_show_view_status') == 'yes' && auth()->user()->is_team &&
        $invoice->bill_status != 'draft' && $invoice->bill_status != 'paid')
        <!--estimate not viewed-->
        @if($invoice->bill_viewed_by_client == 'no')
        <span class="label label-icons label-icons-default" data-toggle="tooltip" data-placement="top"
            title="@lang('lang.client_has_not_opened')"><i class="sl-icon-eye"></i></span>
        @endif
        <!--estimate viewed-->
        @if($invoice->bill_viewed_by_client == 'yes')
        <span class="label label-icons label-icons-info" data-toggle="tooltip" data-placement="top"
            title="@lang('lang.client_has_opened')"><i class="sl-icon-eye"></i></span>
        @endif
        @endif

    </td>

    <!--actions-->
    <td class="invoices_col_action actions_column" id="invoices_col_action_{{ $invoice->bill_invoiceid }}">
        <!--action button-->
        <span class="list-table-action font-size-inherit">

            <!--client options-->
            @if(auth()->user()->is_client)
            <a title="{{ cleanLang(__('lang.download')) }}" title="{{ cleanLang(__('lang.download')) }}"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-warning btn-circle btn-sm"
                href="{{ url('/invoices/'.$invoice->bill_invoiceid.'/pdf') }}" download>
                <i class="ti-import"></i></a>
            @endif
            <!--delete-->
            @if(config('visibility.action_buttons_delete'))
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_invoice')) }}"
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                data-url="{{ url('/') }}/invoices/{{ $invoice->bill_invoiceid }}">
                <i class="sl-icon-trash"></i>
            </button>
            @endif
            <!--edit-->
            @if(config('visibility.action_buttons_edit'))
            <a href="/invoices/{{ $invoice->bill_invoiceid }}/edit-invoice" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="sl-icon-note"></i>
            </a>
            @endif
            <a href="/invoices/{{ $invoice->bill_invoiceid }}" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>

            <!--more button (team)-->
            @if(auth()->user()->is_team)
            <span class="list-table-action dropdown font-size-inherit">
                <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" title="{{ cleanLang(__('lang.more')) }}"
                    class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                    <i class="ti-more"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="listTableAction">
                    @if(config('visibility.action_buttons_edit'))
                    <!--quick edit-->
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'/edit') }}"
                        data-loading-target="commonModalBody"
                        data-modal-title="{{ cleanLang(__('lang.edit_invoice')) }}"
                        data-action-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'?ref=list') }}"
                        data-action-method="PUT" data-action-ajax-class=""
                        data-action-ajax-loading-target="invoices-td-container">
                        {{ cleanLang(__('lang.quick_edit')) }}
                    </a>
                    <!--email to client-->
                    @if(auth()->user()->role->role_invoices > 1)
                    <a class="dropdown-item confirm-action-info" href="javascript:void(0)"
                        data-confirm-title="{{ cleanLang(__('lang.email_to_client')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                        data-url="{{ url('/invoices') }}/{{ $invoice->bill_invoiceid }}/resend?ref=list">
                        {{ cleanLang(__('lang.email_to_client')) }}</a>
                    @endif
                    <!--overdue invoice reminder-->
                    @if(auth()->user()->role->role_invoices > 1 && $invoice->bill_status == 'overdue')
                    <a class="dropdown-item confirm-action-info" href="javascript:void(0)"
                        data-confirm-title="{{ cleanLang(__('lang.send_overdue_reminder_info')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                        data-url="{{ url('/invoices') }}/{{ $invoice->bill_invoiceid }}/overdue-reminder?ref=list">
                        {{ cleanLang(__('lang.send_overdue_reminder')) }}</a>
                    @endif
                    <!--add payment-->
                    @if(auth()->user()->role->role_invoices > 1)
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                        href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                        data-modal-title="{{ cleanLang(__('lang.add_new_payment')) }}"
                        data-url="{{ url('/payments/create?bill_invoiceid='.$invoice->bill_invoiceid) }}"
                        data-action-url="{{ urlResource('/payments?ref=invoice&source=list&bill_invoiceid='.$invoice->bill_invoiceid) }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        {{ cleanLang(__('lang.add_new_payment')) }}</a>
                    @endif
                    <!--clone invoice-->
                    @if(auth()->user()->role->role_invoices > 1)
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                        href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                        data-modal-title="{{ cleanLang(__('lang.clone_invoice')) }}"
                        data-url="{{ url('/invoices/'.$invoice->bill_invoiceid.'/clone') }}"
                        data-action-url="{{ url('/invoices/'.$invoice->bill_invoiceid.'/clone') }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        {{ cleanLang(__('lang.clone_invoice')) }}</a>
                    @endif
                    <!--change category-->
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                        data-modal-title="{{ cleanLang(__('lang.change_category')) }}"
                        data-url="{{ url('/invoices/change-category') }}"
                        data-action-url="{{ urlResource('/invoices/change-category?id='.$invoice->bill_invoiceid) }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        {{ cleanLang(__('lang.change_category')) }}</a>
                    <!--attach project -->
                    @if(!is_numeric($invoice->bill_projectid))
                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                        data-modal-title=" {{ cleanLang(__('lang.attach_to_project')) }}"
                        data-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'/attach-project?client_id='.$invoice->bill_clientid) }}"
                        data-action-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'/attach-project') }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        {{ cleanLang(__('lang.attach_to_project')) }}</a>
                    @endif
                    <!--dettach project -->
                    @if(is_numeric($invoice->bill_projectid))
                    <a class="dropdown-item confirm-action-danger" href="javascript:void(0)"
                        data-confirm-title="{{ cleanLang(__('lang.detach_from_project')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                        data-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'/detach-project') }}">
                        {{ cleanLang(__('lang.detach_from_project')) }}</a>
                    @endif
                    <!--recurring settings-->
                    <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'/recurring-settings?source=page') }}"
                        data-loading-target="commonModalBody"
                        data-modal-title="{{ cleanLang(__('lang.recurring_settings')) }}"
                        data-action-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'/recurring-settings?source=page') }}"
                        data-action-method="POST"
                        data-action-ajax-loading-target="invoices-td-container">{{ cleanLang(__('lang.recurring_settings')) }}</a>
                    <!--stop recurring -->
                    @if($invoice->bill_recurring == 'yes')
                    <a class="dropdown-item confirm-action-info" href="javascript:void(0)"
                        data-confirm-title="{{ cleanLang(__('lang.stop_recurring')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                        data-url="{{ urlResource('/invoices/'.$invoice->bill_invoiceid.'/stop-recurring') }}">
                        {{ cleanLang(__('lang.stop_recurring')) }}</a>
                    @endif
                    @endif
                    <a class="dropdown-item"
                        href="{{ url('payments?filter_payment_invoiceid='.$invoice->bill_invoiceid) }}">
                        {{ cleanLang(__('lang.view_payments')) }}</a>
                    <a class="dropdown-item" href="{{ url('/invoices/'.$invoice->bill_invoiceid.'/pdf') }}" download>
                        {{ cleanLang(__('lang.download')) }}</a>
                </div>
            </span>
            @endif
            <!--more button-->

            <!--pin-->
            <span class="list-table-action">
                <a href="javascript:void(0);" title="{{ cleanLang(__('lang.pinning')) }}"
                    data-parent="invoice_{{ $invoice->bill_invoiceid }}"
                    data-url="{{ url('/invoices/'.$invoice->bill_invoiceid.'/pinning') }}"
                    class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm opacity-4 js-toggle-pinning">
                    <i class="ti-pin2"></i>
                </a>
            </span>
        </span>
        <!--action button-->

    </td>
</tr>
@endforeach
<!--each row-->