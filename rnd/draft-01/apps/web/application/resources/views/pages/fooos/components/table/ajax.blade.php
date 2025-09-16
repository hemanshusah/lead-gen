@foreach($fooos as $fooo)
<!--each fooo row-->
<tr id="fooo_{{ $fooo->fooo_id }}">

    <!--[template] bulk actions checkbox-->
    <td class="fooos_col_checkbox p-l-0">
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-fooos-{{ $fooo->fooo_id }}"
                name="ids[{{ $fooo->fooo_id }}]"
                class="listcheckbox listcheckbox-fooos filled-in chk-col-light-blue"
                data-actions-container-class="fooos-bulk-actions-container">
            <label for="listcheckbox-fooos-{{ $fooo->fooo_id }}"></label>
        </span>
    </td>

    <!--[template] fooo_example_name-->
    <td class="col_fooo_example_name">
        <a type="button" title="{{ cleanLang(__('lang.view')) }}"
            class="data-toggle-tooltip show-modal-button edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal" data-url="{{ urlResource('fooos/'.$fooo->fooo_id) }}"
            data-loading-target="commonModalBody" data-footer-visibility="hidden"
            data-modal-title="{{ $fooo->fooo_name }}">
            {{ $fooo->fooo_example_name }}
        </a>
    </td>

    <!--[template] fooo_example_creator-->
    <td class="col_fooo_example_creator">
        <img src="{{ getUsersAvatar($fooo->avatar_directory, $fooo->avatar_filename, $fooo->fooo_example_creatorid) }}"
            alt="user" class="img-circle avatar-xsmall">
        {{ checkUsersName($fooo->first_name, $fooo->fooo_creatorid)  }}
    </td>

    <!--[template] fooo_example_date-->
    <td class="col_fooo_example_date">
        {{ runtimeDate($fooo->fooo_example_date) }}
    </td>

    <!--[template] fooo_example_money-->
    <td class="col_fooo_example_money">
        {{ runtimeMoneyFormat($fooo->fooo_example_money) }}
    </td>

    <!--[template] fooo_example_status -->
    <td class="col_fooo_example_money">
        @if ($fooo->fooo_example_status === 'enabled')
        <span class="label label-outline-success">@lang('lang.enabled')</span>
        @elseif ($fooo->fooo_example_status === 'disabled')
        <span class="label label-outline-warning">@lang('lang.disabled')</span>
        @elseif ($fooo->fooo_example_status === 'bar')
        <span class="label label-outline-warning">@lang('lang.bar')</span>
        @endif
    </td>

    <!--actions buttons (delete, edit, etc)-->
    <td class="col_fooos_actions actions_column">
        <span class="list-table-action dropdown font-size-inherit">

            <!--[template] delete button-->
            @if(config('visibility.action_buttons_delete'))
            <button type="button" title="@lang('lang.delete')"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="@lang('lang.delete_item')" data-confirm-text="@lang('lang.are_you_sure')"
                data-ajax-type="DELETE" data-url="{{ url('/fooos/'.$fooo->fooo_id) }}">
                <i class="sl-icon-trash"></i>
            </button>
            @endif

            <!--[template] edit button-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="@lang('lang.edit')"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="{{ url('/fooos/'.$fooo->fooo_id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="@lang('lang.edit_item')"
                data-action-url="{{ urlResource('/fooos/'.$fooo->fooo_id) }}" data-action-method="PUT"
                data-action-ajax-class="ajax-request" data-action-ajax-loading-target="fooos-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif

            <!--[template] view-->
            <button type="button" title="@lang('lang.view_fooo')"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="{{ url('fooos/'.$fooo->fooo_id) }}"
                data-loading-target="commonModalBody" data-footer-visibility="hidden"
                data-modal-title="{{ $fooo->fooo_name }}">
                <i class="ti-new-window"></i>
            </button>

        </span>
    </td>
</tr>
@endforeach
<!--each row-->