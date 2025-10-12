<!-- Column -->
<div class="col-lg-4 col-md-12" id="dashboard-widgets-tickets">
    <div class="card">
        <div class="card-body">
            <div class="d-flex m-b-30 no-block">
                <h5 class="card-title m-b-0 align-self-center">{{ cleanLang(__('lang.tickets')) }}</h5>
                <div class="ml-auto">
                    {{ cleanLang(__('lang.this_year')) }}
                </div>
            </div>
            <div id="ticketsWidget"></div>
            <ul class="list-inline m-t-30 text-center font-12">
                @foreach($payload['ticket_statuses'] as $ticket_status)
                <li class="p-b-10">
                    <span class="label label-{{ $ticket_status['color'] }} label-rounded">
                        <i class="fa fa-circle"></i> {{ $ticket_status['title'] }}
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!--[DYNAMIC INLINE SCRIPT]  Backend Variables to Javascript Variables-->
<script>
    NX.admin_home_c3_tickets_data = JSON.parse('{!! clean($payload["tickets_stats"]) !!}', true);
    NX.admin_home_c3_tickets_colors = JSON.parse('{!! clean($payload["tickets_key_colors"]) !!}', true);
    NX.admin_home_c3_tickets_title = "{{ $payload['tickets_chart_center_title'] }}";
</script>