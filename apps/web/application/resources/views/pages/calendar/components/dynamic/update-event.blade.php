<!--delete the existing event - as sent by the backend-->
<script>
    var event_id = "{{ $event_id }}";

    // Find and update the event
    var calendar_event = NX.calendar.getEventById(event_id);

    //remove the event
    if (calendar_event) {
        calendar_event.remove();
    }
</script>

<!--add a new event as sent by the backend-->
<script>
    //general data from backend
    NX.calendar_data = @json($event);

    //add a new event
    NX.calendar.addEvent(NX.calendar_data);
</script>
