<div class="col-12 align-self-center hidden checkbox-actions  box-shadow-minimum"
    id="invoices-checkbox-actions-container">
    <!--button-->
    @if(config('visibility.action_buttons_edit'))
    <div class="x-buttons">
        @if(config('visibility.action_buttons_delete'))
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger"
            data-type="form" data-ajax-type="POST" data-form-id="invoices-list-table"
            data-url="{{ url('/invoices/delete') }}"
            data-confirm-title="{{ cleanLang(__('lang.delete_selected_items')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" id="checkbox-actions-delete-invoices">
            <i class="sl-icon-trash"></i> {{ cleanLang(__('lang.delete')) }}
        </button>
        @endif

        <!--change category-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal"
            data-modal-title="{{ cleanLang(__('lang.change_category')) }}"
            data-url="{{ urlResource('/invoices/change-category') }}"
            data-action-url="{{ urlResource('/invoices/change-category') }}" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-invoices">
            <i class="sl-icon-share-alt"></i> {{ cleanLang(__('lang.change_category')) }}
        </button>

        <!--dettach from project-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="invoices-list-table"
            data-url="{{ url('/invoices/bulk-dettach-project') }}"
            data-confirm-title="{{ cleanLang(__('lang.detach_from_project')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" id="checkbox-actions-dettach-project">
            <i class="sl-icon-link"></i> {{ cleanLang(__('lang.detach_from_project')) }}</button>

        <!--email to client-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="invoices-list-table"
            data-url="{{ url('/invoices/bulk-email-client') }}"
            data-confirm-title="{{ cleanLang(__('lang.email_to_client')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" id="checkbox-actions-email-invoices">
            <i class="ti-email"></i> {{ cleanLang(__('lang.email_to_client')) }}</button>

    </div>
    @else
    <div class="x-notice">
        {{ cleanLang(__('lang.no_actions_available')) }}
    </div>
    @endif
</div>