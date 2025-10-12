<div class="card m-t--50">
    <div class="card-body">

        @if(auth()->user()->is_admin)
        <div class="text-right p-b-10">

            <!--view user activity-->
            @if(auth()->user()->is_admin)
            <button type="button"
                class="btn btn-xxs btn-outline-warning waves-effect text-left edit-add-modal-button ajax-request m-r-8"
                data-url="{{ url('timeline/user/'.$contact->id) }}" data-loading-target="commonModalBody"
                data-modal-title="@lang('lang.view_activity') - {{ $contact->first_name }} {{ $contact->last_name }}"
                data-modal-size="modal-lg" data-header-close-icon="hidden" data-header-extra-close-icon="visible"
                data-footer-visibility="hidden" data-action-ajax-loading-target="commonModalBody">
                @lang('lang.view_activity')
            </button>
            @endif

            <!--edit user icon-->
            <button type="submit" id="submitButton"
                class="btn btn-xxs btn-outline-info waves-effect text-left edit-add-modal-button ajax-request"
                data-action-url="{{ url('contacts/'.$contact->id.'?ref=profile-modal') }}"
                data-skip-modal-body-reset="yes" data-modal-title="@lang('lang.edit_profile')" data-action-method="PUT"
                data-url="{{ url('contacts/'.$contact->id.'/edit?ref=list') }}">@lang('lang.edit_profile')</button>
        </div>
        @endif

        <center> <img src="{{ getUsersAvatar($contact->avatar_directory, $contact->avatar_filename) }}"
                class="img-circle" width="120">
            <h4 class="card-title m-t-10">{{ $contact->first_name }} {{ $contact->last_name }}</h4>
            <h6 class="card-subtitle">{{ $contact->email }}</h6>
            <span class="label {{ runtimeUserTypeLabel($contact->type) }}">
                @if($contact->type == 'team')
                @lang('lang.team_member')
                @endif
                @if($contact->type == 'client')
                @lang('lang.client_user')
                @endif
                @if($contact->type == 'contact')
                @lang('lang.email_contact')
                @endif
            </span>
        </center>
    </div>
    <div>
        <hr>
    </div>
    <div class="card-body p-t-0">
        <small class="text-muted p-t-10 db">@lang('lang.telephone')</small>
        <h6>{{ $contact->phone ?? '---' }}</h6>
        <small class="text-muted p-t-30 db">@lang('lang.job_title')</small>
        <h6>{{ $contact->position ?? '---' }}</h6>
        <small class="text-muted p-t-30 db">@lang('lang.date_added')</small>
        <h6>{{ runtimeDate($contact->created) }}</h6>
        <small class="text-muted p-t-30 db">@lang('lang.last_seen')</small>
        <h6>{{ runtimeDateAgo($contact->last_seen) }}</h6>
        <br>
        @if($contact->social_twitter != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_twitter }}"><i
                class="sl-icon-social-twitter"></i></a>
        @endif
        @if($contact->social_linkedin != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_linkedin }}"><i
                class="sl-icon-social-linkedin"></i></a>
        @endif
        @if($contact->social_facebook != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_facebook }}"><i
                class="sl-icon-social-facebook"></i></a>
        @endif
        @if($contact->social_github != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_github }}"><i
                class="sl-icon-social-github"></i></a>
        @endif
    </div>
</div>