<!-- right-sidebar -->
<div class="right-sidebar" id="sidepanel-filter-fooos">
    <form>
        <div class="slimscrollright">

            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i>@lang('lang.filter_fooos')
                <span>
                    <i class="ti-close js-close-side-panels" data-target="sidepanel-filter-fooos"></i>
                </span>
            </div>


            <div class="r-panel-body">

                <!--[template] filter with searching select2-->
                <div class="filter-block">
                    <div class="title">
                        @lang('lang.seachable_select2')
                    </div>
                    <div class="fields">
                        <div class="row">
                            <!--select2 basic search-->
                            <div class="col-md-12">
                                <select name="filter_fooo_example_name" id="filter_fooo_example_name"
                                    class="form-control form-control-sm js-select2-basic-search select2-hidden-accessible"
                                    data-ajax--url="{{ url('/feed/fooo_names') }}"></select>
                            </div>
                        </div>
                    </div>
                </div>


                <!--[template] filter for minimum and maximum for numeri values-->
                <div class="filter-block">
                    <div class="title">
                        @lang('lang.example_value_range')
                    </div>
                    <div class="fields">
                        <div class="row">
                            <!--minimum value-->
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon">$</span>
                                <input type="number" name="filter_fooo_example_value_min"
                                    id="filter_fooo_example_value_min" class="form-control form-control-sm"
                                    placeholder="@lang('lang.minimum')">
                            </div>
                            <!--maximum value-->
                            <div class="col-md-6 input-group input-group-sm">
                                <span class="input-group-addon">$</span>
                                <input type="number" name="filter_fooo_example_value_max"
                                    id="filter_fooo_example_value_max" class="form-control form-control-sm"
                                    placeholder="@lang('lang.maximum')">
                            </div>
                        </div>
                    </div>
                </div>


                <!--[template] filter for start and end dates-->
                <div class="filter-block">
                    <div class="title">
                        @lang('lang.date_range')
                    </div>
                    <div class="fields">
                        <div class="row">
                            <!--start date-->
                            <div class="col-md-6">
                                <input type="text" name="filter_fooo_example_date_start"
                                    class="form-control form-control-sm pickadate" autocomplete="off"
                                    placeholder="Start">
                                <input class="mysql-date" type="hidden" name="filter_fooo_example_date_start"
                                    id="filter_fooo_example_date_start" value="">
                            </div>
                            <!--end date-->
                            <div class="col-md-6">
                                <input type="text" name="filter_fooo_example_date_end"
                                    class="form-control form-control-sm pickadate" autocomplete="off" placeholder="End">
                                <input class="mysql-date" type="hidden" name="filter_fooo_example_date_end"
                                    id="filter_fooo_example_date_end" value="">
                            </div>
                        </div>
                    </div>
                </div>


                <!--submit and cancel buttons-->
                <div class="buttons-block">
                    <!--reset button-->
                    <button type="button" name="fooo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel">@lang('lang.reset')</button>

                    <!--apply filter button-->
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        data-url="{{ urlResource('/fooos/search?') }}"
                        data-type="form"
                        data-ajax-type="GET">@lang('lang.apply_filter')</button>
                </div>

                <!--additional hidden payload-->
                <input type="hidden" name="action" value="search">
            </div>
        </div>
    </form>
</div>