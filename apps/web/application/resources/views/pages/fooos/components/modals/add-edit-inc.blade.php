<!--[template] plain text-->
<div class="form-group row">
    <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.example_text')</label>
    <div class="col-sm-12 col-lg-9">
        <input type="text" class="form-control form-control-sm" id="add_invoices_date" name="add_invoices_date"
            value="{{ $fooo->fooo_example_text ?? '' }}">
    </div>
</div>

<!--[template] date-->
<div class="form-group row">
    <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.example_date')</label>
    <div class="col-sm-12 col-lg-9">
        <input type="text" class="form-control form-control-sm pickadate" autocomplete="off" name="fooo_example_date"
            value="{{ runtimeDatepickerDate($fooo->fooo_example_date ?? '') }}">
        <input class="mysql-date" type="hidden" name="fooo_date" id="fooo_example_date"
            value="{{ $fooo->fooo_example_date ?? '' }}">
    </div>
</div>


<!--[template] select list-->
<div class="form-group row">
    <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.example_list')</label>
    <div class="col-sm-12 col-lg-9">
        <select class="select2-basic form-control form-control-sm select2-preselected" id="fooo_example_list"
            name="fooo_example_list" data-preselected="{{ $fooo->fooo_example_list ?? ''}}">
            <option></option>
            <option value="1">Web Site Redesign</option>
            <option value="2">Logo Design</option>
        </select>
    </div>
</div>

<!--[template] checkbox-->
<div class="form-group form-group-checkbox row">
    <div class="col-12 p-t-5">
        <input type="checkbox" id="fooo_example_checkbox" name="foobar" class="filled-in chk-col-light-blue"
            {{ runtimePrechecked($fooo->fooo_example_checkbox ?? '') }}>
        <label class="p-l-30" for="fooo_example_checkbox">@lang('lang.example_checkbox')</label>
    </div>
</div>

<!--[template] text aread-->
<div class="form-group row">
    <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">@lang('lang.example_text_area')</label>
    <div class="col-sm-12 col-lg-9">
        <textarea class="form-control form-control-sm tinymce-textarea" rows="5" name="example_text_area"
            id="example_text_area">{{ $fooo->example_text_area ?? '' }}</textarea>
    </div>
</div>