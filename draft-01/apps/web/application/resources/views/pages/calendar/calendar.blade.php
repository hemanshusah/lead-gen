<div class="calendar_wrapper" id="calendar_wrapper">

    <!--calendar dynamically loaded here-->

</div>
@include('pages.calendar.components.misc.settings')


<!--set the data payload-->
<script>
    //general data from backend
    NX.calendar_data = @json($data);

    //events payload
    NX.calendar_events = @json($events);

    //general var
    NX.calendar_add_url = "{{ url('/calendar/create') }}";
    NX.calendar_action_url = "{{ url('/calendar') }}";
    NX.calendar_start_day = "{{ config('system.settings2_calendar_first_day') ?? 1 }}";

    //language
    NXLANG.calender_settings = "@lang('lang.calendar_settings')";
    NXLANG.calender_add_event = "@lang('lang.add_event')";

    NXLANG.calender_lang = {
        code: 'nextloop',
        buttonText: {
            today: "@lang('lang.today')",
            month: "@lang('lang.month')",
            week: "@lang('lang.week')",
            day: "@lang('lang.day')",
            list: "@lang('lang.list')"
        },
        weekText: 'W',
        allDayText: "@lang('lang.all_day')",
        moreLinkText: "@lang('lang.more')",
        noEventsText: "@lang('lang.no_events_to_display')",
        dayNames: [
            "@lang('lang.sunday')",
            "@lang('lang.monday')",
            "@lang('lang.tuesday')",
            "@lang('lang.wednesday')",
            "@lang('lang.thursday')",
            "@lang('lang.friday')",
            "@lang('lang.saturday')"
        ],
        dayNamesShort: [
            "@lang('lang.sunday_short')",
            "@lang('lang.monday_short')",
            "@lang('lang.tuesday_short')",
            "@lang('lang.wednesday_short')",
            "@lang('lang.thursday_short')",
            "@lang('lang.friday_short')",
            "@lang('lang.saturday_short')"
        ],
        monthNames: [
            "@lang('lang.january')",
            "@lang('lang.february')",
            "@lang('lang.march')",
            "@lang('lang.april')",
            "@lang('lang.may')",
            "@lang('lang.june')",
            "@lang('lang.july')",
            "@lang('lang.august')",
            "@lang('lang.september')",
            "@lang('lang.october')",
            "@lang('lang.november')",
            "@lang('lang.december')"
        ],
        monthNamesShort: [
            "@lang('lang.january_short')",
            "@lang('lang.february_short')",
            "@lang('lang.march_short')",
            "@lang('lang.april_short')",
            "@lang('lang.may_short')",
            "@lang('lang.june_short')",
            "@lang('lang.july_short')",
            "@lang('lang.august_short')",
            "@lang('lang.september_short')",
            "@lang('lang.october_short')",
            "@lang('lang.november_short')",
            "@lang('lang.december_short')"
        ]
    };
</script>

<!--trigger element-->
<span class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form" id="calendar-event-trigger"
    data-toggle="modal" data-target="#commonModal" data-loading-target="commonModalBody"
    data-modal-title="" data-action-method="GET" data-action-ajax-class="ajax-request"
    data-modal-size="modal-lg" data-action-ajax-loading-target="commonModalBody" data-footer-visibility="hidden"
    data-url-backup="{{ url('/calendar') }}/" data-url="{{ url('/calendar') }}/">
    <!--dynamic-->
</span>