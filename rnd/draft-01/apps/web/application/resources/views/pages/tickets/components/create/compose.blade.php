<form action="" class="w-100" method="post" id="ticket-compose-form" data-user-type="{{ auth()->user()->type }}">
    <div class="row ticket-compose" id="ticket-compose">
        <!--options panel-->
        @include('pages.tickets.components.create.options')


        <!--compose panel-->
        <div class="col-sm-12 col-lg-9">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" name="ticket_subject" id="ticket_subject"
                                    placeholder="{{ cleanLang(__('lang.subject')) }}:">
                            </div>
                            <div class="form-group">
                                <textarea class="tinymce-textarea" name="ticket_message" id="ticket_message"
                                    rows="15"></textarea>
                            </div>
                            <!--CANNED MESSAGES-->
                            @if(auth()->user()->is_team && config('system.settings2_tickets_replying_interface') ==
                            'inline')
                            <button type="button"
                                class="btn btn-default btn-sm waves-effect waves-dark js-toggle-side-panel ticket-add-canned m-b-20"
                                data-target="sidepanel-canned-messages">
                                <i class="sl-icon-speech"></i>
                                @lang('lang.canned_messages')
                            </button>
                            @endif
                            <!--fileupload-->
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="dropzone dz-clickable" id="fileupload_ticket">
                                        <div class="dz-default dz-message">
                                            <i class="icon-Upload-toCloud"></i>
                                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--tags-->
                            @if(auth()->user()->is_team)
                            <div class="form-group row">
                                <label
                                    class="col-12 text-left control-label col-form-label">{{ cleanLang(__('lang.tags')) }}</label>
                                <div class="col-12">
                                    <select name="tags" id="tags"
                                        class="form-control form-control-sm select2-multiple {{ runtimeAllowUserTags() }} select2-hidden-accessible"
                                        multiple="multiple" tabindex="-1" aria-hidden="true">
                                        <!--array of selected tags-->
                                        @if(isset($page['section']) && $page['section'] == 'edit')
                                        @foreach($ticket->tags as $tag)
                                        @php $selected_tags[] = $tag->tag_title ; @endphp
                                        @endforeach
                                        @endif
                                        <!--/#array of selected tags-->
                                        @foreach($tags as $tag)
                                        <option value="{{ $tag->tag_title }}"
                                            {{ runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags ?? []) }}>
                                            {{ $tag->tag_title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <!--submit-->
                            <div class="text-lg-right">
                                <button type="submit" class="btn btn-rounded-x btn-danger m-t-20"
                                    id="ticket-compose-form-button" data-url="{{ url('/tickets') }}" data-type="form"
                                    data-ajax-type="post" data-loading-overlay-target="wrapper-tickets"
                                    data-loading-overlay-classname="overlay"
                                    data-form-id="ticket-compose">{{ cleanLang(__('lang.submit_ticket')) }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>