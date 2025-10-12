@foreach($logs as $log)
@include('pages.lead.content.logs.log-ajax')

<!--Log editing wrapper-->
<div id="lead_log_editing_wrapper_{{ $log->lead_log_uniqueid }}" class="hidden"></div>
@endforeach