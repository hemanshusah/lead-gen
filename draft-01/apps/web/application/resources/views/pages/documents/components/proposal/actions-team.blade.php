<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-6 align-self-center text-right parent-page-actions p-b-9"
    id="list-page-actions-container-proposals">
    <div id="list-page-actions">


        <!--reminder-->
        @if(config('visibility.modules.reminders'))
        <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.reminder')) }}"
            id="reminders-panel-toggle-button"
            class="reminder-toggle-panel-button list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-reminder-panel ajax-request {{ $document->reminder_status }}"
            data-url="{{ url('reminders/start?resource_type='.$document->doc_type.'&resource_id='.$document->doc_id) }}"
            data-loading-target="reminders-side-panel-body" data-progress-bar='hidden'
            data-target="reminders-side-panel" data-title="@lang('lang.my_reminder')">
            <i class="ti-alarm-clock"></i>
        </button>
        @endif

        @if(config('visibility.document_options_buttons'))
        
        <!--publish-->
        @if($document->doc_status == 'draft')
        <span class="dropdown">
            <button type="button" data-toggle="dropdown" title="{{ cleanLang(__('lang.publish_document')) }}"
                aria-haspopup="true" aria-expanded="false"
                class="data-toggle-tooltip  list-actions-button btn btn-page-actions waves-effect waves-dark">
                <i class="sl-icon-share-alt"></i>
            </button>
            <div class="dropdown-menu w-px-250 p-t-20 p-l-20 p-r-20 js-stop-propagation"
                aria-labelledby="listTableAction">
                <div class="form-group form-group-checkbox row m-b-0">
                    <div class="col-12">
                        <input type="checkbox" id="publishing_option_now" name="publishing_option_now"
                            class="filled-in chk-col-light-blue publishing_option"
                            data-url="{{ urlResource('/'.$document->doc_type.'s/'.$document->doc_id.'/publish') }}"
                            {{ runtimePreChecked2($document->doc_publishing_type, 'instant') }}>
                        <label class="p-l-30" for="publishing_option_now">@lang('lang.publish_now') <span
                                class="align-middle text-info font-16" data-toggle="tooltip"
                                title="@lang('lang.it_will_be_sent_now')" data-placement="top"><i
                                    class="ti-info-alt"></i></span></label>
                    </div>
                </div>

                <div class="modal-selector m-l--20 m-r--20 p-t-5 p-b-5 m-t-10 p-l-20 p-r-20 p-t-10"
                    id="publishing_option_later_container">

                    <div class="form-group form-group-checkbox row  m-b-0">
                        <div class="col-12">
                            <input type="checkbox" id="publishing_option_later" name="publishing_option_later"
                                class="filled-in chk-col-light-blue publishing_option"
                                data-url="{{ urlResource('/'.$document->doc_type.'s/'.$document->doc_id.'/publish/scheduled') }}"
                                data-type="form" data-form-id="publishing_option_later_container" data-ajax-type="post"
                                {{ runtimePreChecked2($document->doc_publishing_type, 'scheduled') }}>
                            <label class="p-l-30" for="publishing_option_later">@lang('lang.publish_later') <span
                                    class="align-middle text-info font-16" data-toggle="tooltip"
                                    title="@lang('lang.it_will_be_sent_schedule')" data-placement="top"><i
                                        class="ti-info-alt"></i></span></label>
                        </div>
                    </div>

                    <!--date-->
                    <div class="form-group row m-b-10">
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm pickadate publishing_option_date"
                                autocomplete="off" name="publishing_option_date"
                                value="{{ runtimeDatepickerDate($document->doc_publishing_scheduled_date ?? '') }}"
                                {{ runtimePublihItemDate($document->doc_publishing_type) }}>
                            <input class="mysql-date" type="hidden" name="publishing_option_date"
                                id="publishing_option_date" value="{{ $document->doc_publishing_scheduled_date	 ?? '' }}">
                        </div>
                    </div>
                </div>
                <!--form buttons-->
                <div class="text-right p-t-5 m-b-10">
                    <button type="submit" id="publishing_option_button"
                        class="btn btn-sm btn-info waves-effect text-left" data-url="" data-loading-target=""
                        data-ajax-type="POST" data-lang-error-message="@lang('lang.schedule_date_is_requried')"
                        data-lang-publish="@lang('lang.publish_now')" data-lang-schedule="@lang('lang.schedule')"
                        data-on-start-submit-button="disable">{{ runtimePublihItemButtonLang($document->doc_publishing_type) }}</button>
                </div>
            </div>
        </span>
        @endif

        <!--email invoice-->
        <button type="button" data-toggle="tooltip" title="@lang('lang.send_email')"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="@lang('lang.send_email')"
            data-confirm-text="@lang('lang.confirm')"
            data-url="{{ urlResource('/'.$document->doc_type.'s/'.$document->doc_id.'/resend') }}"
            id="document-action-email"><i class="ti-email"></i></button>


        <!--clone-->
        @if(config('visibility.document_edit_button'))
        <span class="dropdown">
            <button type="button" class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark 
                            actions-modal-button js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                title="{{ cleanLang(__('lang.clone_proposal')) }}" data-toggle="modal" data-target="#commonModal"
                data-modal-title="{{ cleanLang(__('lang.clone_proposal')) }}"
                data-url="{{ url('/proposals/'.$document->doc_id.'/clone') }}"
                data-action-url="{{ url('/proposals/'.$document->doc_id.'/clone') }}"
                data-loading-target="actionsModalBody" data-action-method="POST">
                <i class=" mdi mdi-content-copy"></i>
            </button>
        </span>
        @endif


        @if(config('visibility.document_edit_button'))
        <!--edit button-->
        <a data-toggle="tooltip" title="@lang('lang.edit')"
            href="{{ urlResource('/'.$document->doc_type.'s/'.$document->doc_id.'/edit') }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark">
            <i class="sl-icon-note"></i>
        </a>

        <!--settings-->
        <span class="dropdown">
            <button type="button" data-toggle="dropdown" title="{{ cleanLang(__('lang.edit')) }}" aria-haspopup="true"
                aria-expanded="false"
                class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark">
                <i class="sl-icon-wrench"></i>
            </button>

            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <a class="dropdown-item" href="{{ url('/proposals/view/'.$document->doc_unique_id.'?action=preview') }}"
                    target="_blank"><i class="ti-new-window display-inline-block p-r-5"></i>
                    @lang('lang.proposal_url')</a>

                <!--Mark As Accepted-->
                <a class="dropdown-item confirm-action-info {{ runtimeVisibility('document-status', 'accepted', $document->doc_status)}}"
                    href="javascript:void(0)" data-confirm-title="{{ cleanLang(__('lang.mark_as_accepted')) }}"
                    id="bill-actions-dettach-project" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                    data-url="{{ url('/proposals/'.$document->doc_id.'/change-status?status=accepted') }}">
                    <i class="sl-icon-check display-inline-block p-r-5"></i> @lang('lang.mark_as_accepted')</a>

                <!--Mark As Declined-->
                <a class="dropdown-item confirm-action-danger {{ runtimeVisibility('document-status', 'declined', $document->doc_status)}}"
                    href="javascript:void(0)" data-confirm-title="{{ cleanLang(__('lang.mark_as_accepted')) }}"
                    id="bill-actions-dettach-project" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                    data-url="{{ url('/proposals/'.$document->doc_id.'/change-status?status=declined') }}">
                    <i class="sl-icon-close display-inline-block p-r-5"></i> @lang('lang.mark_as_declined')</a>

                <!--Mark As Revised-->
                <a class="dropdown-item confirm-action-danger {{ runtimeVisibility('document-status', 'revised', $document->doc_status)}}"
                    href="javascript:void(0)" data-confirm-title="{{ cleanLang(__('lang.mark_as_revised')) }}"
                    id="bill-actions-dettach-project" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                    data-url="{{ url('/proposals/'.$document->doc_id.'/change-status?status=revised') }}">
                    <i class="ti-reload display-inline-block p-r-5"></i> @lang('lang.mark_as_revised')</a>

                <!--automation-->
                <a href="javascript:void(0)"
                    class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="{{ urlResource('/proposals/'.$document->doc_id.'/edit-automation') }}"
                    data-loading-target="commonModalBody" data-modal-title="@lang('lang.proposal_automation')"
                    data-action-url="{{ urlResource('/proposals/'.$document->doc_id.'/edit-automation') }}"
                    data-action-method="POST" data-action-ajax-loading-target="commonModalBody"><i
                        class="sl-icon-energy display-inline-block p-r-5"></i>@lang('lang.automation')
                </a>

            </div>
        </span>
        @endif

        <!--print-->
        <a data-toggle="tooltip" title="@lang('lang.print')"
            href="{{ url('proposals/'.$document->doc_id.'?render=print') }}" target="_blank"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark">
            <i class="sl-icon-printer"></i>
        </a>

        <!--edit cost estimate-->
        @if(config('visibility.document_edit_estimate_button'))
        <button type="button"
            class="list-actions-button btn-text btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            id="js-document-billing"
            data-url="{{ url('estimates/'.$estimate->bill_estimateid.'/edit-estimate?estimate_mode=document') }}"
            data-progress-bar="hidden" data-loading-target="documents-side-panel-billing-content"
            data-target="documents-side-panel-billing">
            @lang('lang.edit_billing')
        </button>
        @endif

        <!--show variables-->
        @if(config('visibility.document_edit_variables_button'))
        <button type="button"
            class="list-actions-button btn-text btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="documents-side-panel-variables">
            @lang('lang.variables')
        </button>
        @endif

        <!--exit buton-->
        @if(config('visibility.document_edit_variables_button'))
        <a data-toggle="tooltip" title="@lang('lang.exit_editing_mode')"
            href="{{ url('proposals/'.$document->doc_id) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark">
            <i class="sl-icon-logout"></i>
        </a>
        @endif
        @endif

        <!--delete proposal-->
        @if(config('visibility.delete_document_button'))
        <!--delete-->
        <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.delete_proposal')) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-danger"
            data-confirm-title="{{ cleanLang(__('lang.delete_proposal')) }}"
            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
            data-url="{{ url('/proposals/'.$document->doc_id.'?source=page') }}"><i class="sl-icon-trash"></i></button>
        @endif
    </div>
</div>
<!-- action buttons -->