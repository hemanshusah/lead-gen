<div class="card count-{{ @count($invoices ?? []) }}" id="invoices-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper min-h-400">
            @if (@count($invoices ?? []) > 0)
            <table id="invoices-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        @if(config('visibility.invoices_col_checkboxes'))
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-invoices" name="listcheckbox-invoices"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="invoices-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-invoices">
                                <label for="listcheckbox-invoices"></label>
                            </span>
                        </th>
                        @endif

                        <!--tableconfig_column_1 [id]-->
                        <th
                            class="invoices_col_tableconfig_column_1 {{ config('table.tableconfig_column_1') }} tableconfig_column_1">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_invoiceid"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_invoiceid&sortorder=asc') }}">@lang('lang.id')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_2 [parent id] -->
                        <th
                            class="invoices_col_tableconfig_column_2 {{ config('table.tableconfig_column_2') }} tableconfig_column_2">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_recurring_parent_id"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_recurring_parent_id&sortorder=asc') }}">@lang('lang.parent_invoice')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_3 [date]-->
                        <th
                            class="invoices_col_tableconfig_column_3 {{ config('table.tableconfig_column_3') }} tableconfig_column_3">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_date" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_date&sortorder=asc') }}">@lang('lang.date')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_4 [due]-->
                        <th
                            class="invoices_col_tableconfig_column_4 {{ config('table.tableconfig_column_4') }} tableconfig_column_4">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_due_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_due_date&sortorder=asc') }}">@lang('lang.due_date')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_5 [company name]-->
                        <th
                            class="invoices_col_tableconfig_column_5 {{ config('table.tableconfig_column_5') }} tableconfig_column_5">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=client&sortorder=asc') }}">@lang('lang.company_name')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                        <!--tableconfig_column_6 [client contact] -->
                        <th
                            class="invoices_col_tableconfig_column_6 {{ config('table.tableconfig_column_6') }} tableconfig_column_6">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_contact"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=client_contact&sortorder=asc') }}">@lang('lang.client_contact')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_7 [created by] -->
                        <th
                            class="invoices_col_tableconfig_column_7 {{ config('table.tableconfig_column_7') }} tableconfig_column_7">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_created_by" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=created_by&sortorder=asc') }}">@lang('lang.created_by')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_8 [project] -->
                        <th
                            class="invoices_col_tableconfig_column_8 {{ config('table.tableconfig_column_8') }} tableconfig_column_8">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_projectid" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_projectid&sortorder=asc') }}">@lang('lang.project_id')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_9 [project_title] -->
                        <th
                            class="invoices_col_tableconfig_column_9 {{ config('table.tableconfig_column_9') }} tableconfig_column_9">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_title"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=project_title&sortorder=asc') }}">@lang('lang.project_title')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_10 [tax] -->
                        <th
                            class="invoices_col_tableconfig_column_10 {{ config('table.tableconfig_column_10') }} tableconfig_column_10">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_tax_total_amount" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_tax_total_amount&sortorder=asc') }}">@lang('lang.tax')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_11 [discount type] -->
                        <th
                            class="invoices_col_tableconfig_column_11 {{ config('table.tableconfig_column_11') }} tableconfig_column_11">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_discount_type"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_discount_type&sortorder=asc') }}">@lang('lang.discount_type')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_12 [discount amount] -->
                        <th
                            class="invoices_col_tableconfig_column_12 {{ config('table.tableconfig_column_12') }} tableconfig_column_12">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_discount_amount"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_discount_amount&sortorder=asc') }}">@lang('lang.discount_amount')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_13 [last payment - date] -->
                        <th
                            class="invoices_col_tableconfig_column_13 {{ config('table.tableconfig_column_13') }} tableconfig_column_13">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_last_payment_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=last_payment_date&sortorder=asc') }}">@lang('lang.last_payment')
                                - @lang('lang.date')<span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>


                        <!--tableconfig_column_14 [last payment - amount] -->
                        <th
                            class="invoices_col_tableconfig_column_14 {{ config('table.tableconfig_column_14') }} tableconfig_column_14">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_last_payment_amount"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=last_payment_amount&sortorder=asc') }}">@lang('lang.last_payment')
                                - @lang('lang.amount')<span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>


                        <!--tableconfig_column_15 [last payment - method] -->
                        <th
                            class="invoices_col_tableconfig_column_15 {{ config('table.tableconfig_column_15') }} tableconfig_column_15">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_last_payment_method"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=last_payment_method&sortorder=asc') }}">@lang('lang.last_payment')
                                - @lang('lang.method')<span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>


                        <!--tableconfig_column_16 [last payment - transaction id] -->
                        <th
                            class="invoices_col_tableconfig_column_16 {{ config('table.tableconfig_column_16') }} tableconfig_column_16">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_last_payment_transaction_id"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=last_payment_transaction_id&sortorder=asc') }}">@lang('lang.latest_payment')
                                - @lang('lang.transaction_id')<span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>


                        <!--tableconfig_column_17 [attachments] -->
                        <th
                            class="invoices_col_amount {{ config('table.tableconfig_column_17') }} tableconfig_column_17">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_attachments"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=attachments&sortorder=asc') }}">@lang('lang.attachments')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_19 [scheduled publishing date] -->
                        <th
                            class="invoices_col_tableconfig_column_19 {{ config('table.tableconfig_column_19') }} tableconfig_column_19">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_publishing_scheduled_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_publishing_scheduled_date&sortorder=asc') }}">@lang('lang.scheduled_publishing_date')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_20 [payments]-->
                        <th
                            class="invoices_col_payments {{ config('table.tableconfig_column_20') }} tableconfig_column_20">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_payments" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=payments&sortorder=asc') }}">@lang('lang.payments')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_21 [amount]-->
                        <th
                            class="invoices_col_tableconfig_column_21 {{ config('table.tableconfig_column_21') }} tableconfig_column_21">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_bill_final_amount" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_final_amount&sortorder=asc') }}">@lang('lang.amount')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_22 [balance]-->
                        <th
                            class="invoices_col_tableconfig_column_22 {{ config('table.tableconfig_column_22') }} tableconfig_column_22">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_balance" href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=balance&sortorder=asc') }}">@lang('lang.balance')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_23 [status]-->
                        <th class="invoices_col_tableconfig_column_23 {{ config('table.tableconfig_column_23') }} tableconfig_column_23"><a
                                class="js-ajax-ux-request js-list-sorting" id="sort_bill_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/invoices?action=sort&orderby=bill_status&sortorder=asc') }}">@lang('lang.status')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--actions-->
                        <th class="invoices_col_action with-table-config-icon actions_column"><a
                                href="javascript:void(0)">@lang('lang.action')</a>

                            <!--[tableconfig]-->
                            <div class="table-config-icon">
                                <span class="text-default js-toggle-table-config-panel"
                                    data-target="table-config-invoices">
                                    <i class="sl-icon-settings">
                                    </i>
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="invoices-td-container">
                    <!--ajax content here-->
                    @include('pages.invoices.components.table.ajax')
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif @if (@count($invoices ?? []) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>