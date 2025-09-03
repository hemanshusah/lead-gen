<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="fooos-bulk-actions-container">
    <!--[template] bulk delete checked items-->
    <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger" 
        data-type="form"
        data-ajax-type="POST"
        data-form-id="fooos-table" 
        data-url="{{ url('/fooos/bulk/delete') }}"
        data-confirm-title="@lang('lang.delete_selected_items')"
        data-confirm-text="@lang('lang.are_you_sure')">
        <i class="sl-icon-trash"></i> {{ cleanLang(__('lang.delete')) }}
    </button>
</div>