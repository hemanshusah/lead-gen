<div class="col-lg-12 align-self-center hidden checkbox-actions box-shadow-minimum"
    id="estimates-checkbox-actions-container">
    <!--button-->
    @if(config('visibility.action_buttons_edit'))
    <div class="x-buttons">
        @if(config('visibility.action_buttons_delete'))
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger"
            data-type="form" data-ajax-type="POST" data-form-id="estimates-list-table"
            data-url="{{ url('/estimates/delete?type=bulk') }}"
            data-confirm-title="{{ cleanLang(__('lang.delete_selected_items')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" id="checkbox-actions-delete-estimates">
            <i class="sl-icon-trash"></i> {{ cleanLang(__('lang.delete')) }}
        </button>
        @endif

        <!--change category-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal"
            data-modal-title="{{ cleanLang(__('lang.change_category')) }}"
            data-url="{{ urlResource('/estimates/change-category') }}"
            data-action-url="{{ urlResource('/estimates/change-category?type=bulk') }}" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-estimates">
            <i class="sl-icon-share-alt"></i> {{ cleanLang(__('lang.change_category')) }}
        </button>


        <!--change status-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal" data-modal-title="{{ cleanLang(__('lang.change_status')) }}"
            data-url="{{ urlResource('/estimates/bulk-change-status') }}"
            data-action-url="{{ urlResource('/estimates/bulk-change-status-update') }}" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-status-estimates">
            <i class="sl-icon-share-alt"></i> {{ cleanLang(__('lang.change_status')) }}
        </button>


        <!--convert to invoice-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-modal-title="{{ cleanLang(__('lang.convert_to_invoice')) }}"
            data-url="{{ urlResource('/estimates/bulk-convert-to-invoice') }}"
            data-action-url="{{ urlResource('/estimates/bulk-convert-to-invoice-action') }}"
            data-action-form-id="main-body"
            data-action-type="form"
            data-loading-target="commonModalBody" 
            data-action-method="POST" data-skip-checkboxes-reset="TRUE"
            id="checkbox-actions-convert-invoice-estimates">
            <i class="sl-icon-doc"></i> {{ cleanLang(__('lang.convert_to_invoice')) }}
        </button>

        <!--email to client-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="estimates-list-table"
            data-url="{{ url('/estimates/bulk-email-client') }}"
            data-confirm-title="{{ cleanLang(__('lang.email_to_client')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" id="checkbox-actions-email-estimates">
            <i class="ti-email"></i> {{ cleanLang(__('lang.email_to_client')) }}</button>
    </div>
    @else
    <div class="x-notice">
        {{ cleanLang(__('lang.no_actions_available')) }}
    </div>
    @endif
</div>