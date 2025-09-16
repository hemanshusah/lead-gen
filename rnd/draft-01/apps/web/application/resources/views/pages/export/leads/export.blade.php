<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-leads">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i>{{ cleanLang(__('lang.export_leads')) }}
                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-leads"></i>
                </span>
            </div>

            <!--body-->
            <div class="r-panel-body p-l-35 p-r-35">

                <!--standard fields-->
                <div class="">
                    <h5>@lang('lang.standard_fields')</h5>
                </div>
                <div class="line"></div>
                <div class="row">

                    <!--title-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_title]" name="standard_field[lead_title]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_title]">@lang('lang.title')</label>
                            </div>
                        </div>
                    </div>

                    <!--firstname-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_firstname]"
                                    name="standard_field[lead_firstname]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_firstname]">@lang('lang.first_name')</label>
                            </div>
                        </div>
                    </div>

                    <!--lastname-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_lastname]"
                                    name="standard_field[lead_lastname]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_lastname]">@lang('lang.last_name')</label>
                            </div>
                        </div>
                    </div>

                    <!--created by-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_creator]"
                                    name="standard_field[lead_creator]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_creator]">@lang('lang.created_by')</label>
                            </div>
                        </div>
                    </div>

                    <!--email-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_email]" name="standard_field[lead_email]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_email]">@lang('lang.email')</label>
                            </div>
                        </div>
                    </div>

                    <!--phone-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_phone]" name="standard_field[lead_phone]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_phone]">@lang('lang.phone')</label>
                            </div>
                        </div>
                    </div>

                    <!--job position-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_job_position]"
                                    name="standard_field[lead_job_position]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_job_position]">@lang('lang.job_title')</label>
                            </div>
                        </div>
                    </div>

                    <!--website-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_website]"
                                    name="standard_field[lead_website]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_website]">@lang('lang.website')</label>
                            </div>
                        </div>
                    </div>

                    <!--street-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_street]"
                                    name="standard_field[lead_street]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_street]">@lang('lang.street')</label>
                            </div>
                        </div>
                    </div>

                    <!--city-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_city]" name="standard_field[lead_city]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_city]">@lang('lang.city')</label>
                            </div>
                        </div>
                    </div>

                    <!--state-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_state]" name="standard_field[lead_state]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_state]">@lang('lang.state')</label>
                            </div>
                        </div>
                    </div>

                    <!--zip-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_zip]" name="standard_field[lead_zip]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_zip]">@lang('lang.zipcode')</label>
                            </div>
                        </div>
                    </div>

                    <!--country-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_country]"
                                    name="standard_field[lead_country]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_country]">@lang('lang.country')</label>
                            </div>
                        </div>
                    </div>

                    <!--description-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_description]"
                                    name="standard_field[lead_description]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_description]">@lang('lang.description')</label>
                            </div>
                        </div>
                    </div>

                    <!--company name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_company_name]"
                                    name="standard_field[lead_company_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_company_name]">@lang('lang.company_name')</label>
                            </div>
                        </div>
                    </div>

                    <!--value-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_value]" name="standard_field[lead_value]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[lead_value]">@lang('lang.value')</label>
                            </div>
                        </div>
                    </div>

                    <!--source-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_source]"
                                    name="standard_field[lead_source]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_source]">@lang('lang.source')</label>
                            </div>
                        </div>
                    </div>

                    <!--status-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_status]"
                                    name="standard_field[lead_status]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[lead_status]">@lang('lang.status')</label>
                            </div>
                        </div>
                    </div>

                    <!--last contacted-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_last_contacted]"
                                    name="standard_field[lead_last_contacted]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_last_contacted]">@lang('lang.last_contacted')</label>
                            </div>
                        </div>
                    </div>

                    <!--converted-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_converted]"
                                    name="standard_field[lead_converted]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_converted]">@lang('lang.converted')</label>
                            </div>
                        </div>
                    </div>

                    <!--converted by-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_converted_by]"
                                    name="standard_field[lead_converted_by]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_converted_by]">@lang('lang.converted_by')</label>
                            </div>
                        </div>
                    </div>

                    <!--date converted-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[lead_converted_date]"
                                    name="standard_field[lead_converted_date]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[lead_converted_date]">@lang('lang.date_converted')</label>
                            </div>
                        </div>
                    </div>

                </div>

                <!--custon fields-->
                <div class="m-t-30">
                    <h5>@lang('lang.custom_fields')</h5>
                </div>
                <div class="line"></div>
                <div class="row">
                    @foreach($fields as $field)
                    @if($field->customfields_title)
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[{{ $field->customfields_name }}]"
                                    class="filled-in chk-col-light-blue toggle-all-checkbox"
                                    name="custom_field[{{ $field->customfields_name }}]">
                                <label class="p-l-30"
                                    for="custom_field[{{ $field->customfields_name }}]">{{ $field->customfields_title }}</label>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        id="export-leads-button" data-url="{{ urlResource('/export/leads?') }}" data-type="form"
                        data-ajax-type="POST" data-button-loading-annimation="yes">
                        @lang('lang.export')
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--sidebar-->