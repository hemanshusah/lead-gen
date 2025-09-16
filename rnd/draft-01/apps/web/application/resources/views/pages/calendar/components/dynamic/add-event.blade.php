<!--add a new event as sent by the backend-->
<script>
    //general data from backend
    NX.calendar_data = @json($event);

    //add a new event
    NX.calendar.addEvent(NX.calendar_data);
</script>