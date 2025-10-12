<!--update an existing event as sent by the backend-->
<script>
    var event_id = "{{ $event_id }}";

    // Find and update the event
    var calendar_event = NX.calendar.getEventById(event_id);

    //remove the event
    if (calendar_event) {
        calendar_event.remove();
    }
</script>