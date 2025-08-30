<div class="card" id="fooos-table-wrapper">
    <div class="card-body">
        <div class="table-responsive">
            @if (@count($fooos ?? []) > 0)
            <table id="fooo-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <!--[template] fooo_example_plain_text-->
                        <th class="col_fooo_example_plain_text"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_fooo_example_plain_text" href="javascript:void(0)"
                                data-url="{{ urlResource('/foos?action=sort&orderby=fooo_example_plain_text&sortorder=asc') }}">@lang('lang.plain_text')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                        <!--[template] fooo_example_creator-->
                        <th class="col_fooo_example_creator"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_fooo_example_creator" href="javascript:void(0)"
                                data-url="{{ urlResource('/foos?action=sort&orderby=fooo_example_creator&sortorder=asc') }}">@lang('lang.creator')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>


                        <!--[template] fooo_example_date-->
                        <th class="col_fooo_example_date"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_fooo_example_date" href="javascript:void(0)"
                                data-url="{{ urlResource('/foos?action=sort&orderby=fooo_example_date&sortorder=asc') }}">@lang('lang.date')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>


                        <!--[template] fooo_example_money-->
                        <th class="col_fooo_example_money"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_fooo_example_money" href="javascript:void(0)"
                                data-url="{{ urlResource('/foos?action=sort&orderby=fooo_example_money&sortorder=asc') }}">@lang('lang.amount')<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>


                        <!--actions buttons (delete, edit, etc)-->
                        <th class="col_fooos_actions"><a href="javascript:void(0)">@lang('lang.actions')</a></th>
                    </tr>
                </thead>

                <tbody id="fooos-td-container">
                    <!--ajax content from responses-->
                    @include('pages.fooos.components.table.ajax')
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif

            <!--no results were found-->
            @if (@count($fooos ?? []) == 0)
            @include('notifications.no-results-found')
            @endif
        </div>
    </div>
</div>