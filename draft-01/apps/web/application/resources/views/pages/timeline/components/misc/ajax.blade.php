@foreach($events as $event)
@if($event->event_show_in_timeline == 'yes')
<!--each events item-->
<div class="sl-item timeline">
    <div class="sl-left">
        <img src="{{ getUsersAvatar($event->avatar_directory, $event->avatar_filename, $event->event_creatorid)  }}"
            alt="user" class="img-circle" />
    </div>
    <div class="sl-right">
        <div>
            <div class="x-meta">
                @if($event->event_creatorid == 0 || $event->event_creatorid == -1)
                @if($event->event_creatorid == 0)
                {{ cleanLang(__('lang.system_bot_name')) }}
                @else
                <!--non registered users-->
                {{ $event->event_creator_name }}
                @endif
                @else
                <a href="javascript:void(0);" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal" data-url="{{ url('contacts/'.$event->id ?? 0) }}"
                    data-loading-target="commonModalBody" data-modal-title="" data-modal-size="modal-md"
                    data-header-close-icon="hidden" data-header-extra-close-icon="visible"
                    data-footer-visibility="hidden" data-action-ajax-loading-target="commonModalBody">
                    {{ $event->first_name ?? runtimeUnkownUser() }}
                </a>
                @endif
                <span class="sl-date">{{ runtimeDateAgo($event->event_created) }}</span>
            </div>
            <div class="x-title">
                <!--assigned event - viewed by third party-->
                @if($event->event_notification_category == 'notifications_new_assignement' && (auth()->user()->id !=
                $event->event_item_content2))
                <span>{{ runtimeLang($event->event_item_lang_alt) }} {{ $event->event_item_content3 }}<span>
                        @else
                        <span>{{ runtimeLang($event->event_item_lang) }}<span>
                                @endif
                                <!--do for project time lines-->
                                @if(request('timelineresource_type') == 'project' && ($event->event_parent_type
                                =='project' || $event->event_parent_type =='file'))
                                <!--do nothing-->
                                @else
                                @include('pages.events.includes.parent')
                                @endif
            </div>
            @if($event->event_show_item == 'yes')
            @include('pages.events.includes.content')
            @endif
        </div>
    </div>
</div>
<!--each events item-->
@endif
@endforeach