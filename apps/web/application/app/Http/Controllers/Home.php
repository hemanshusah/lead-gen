<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for home page
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;
use App\Http\Responses\Home\HomeResponse;
use App\Http\Responses\Home\UpdateStatsResponse;
use App\Repositories\EventRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\LeadRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\StatsRepository;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Log;

class Home extends Controller {

    private $page = array();

    protected $statsrepo;
    protected $eventsrepo;
    protected $trackingrepo;
    protected $projectrepo;
    protected $taskrepo;
    protected $leadrepo;

    public function __construct(
        StatsRepository $statsrepo,
        EventRepository $eventsrepo,
        EventTrackingRepository $trackingrepo,
        ProjectRepository $projectrepo,
        TaskRepository $taskrepo,
        LeadRepository $leadrepo
    ) {

        //parent
        parent::__construct();

        $this->statsrepo = $statsrepo;
        $this->eventsrepo = $eventsrepo;
        $this->trackingrepo = $trackingrepo;
        $this->projectrepo = $projectrepo;
        $this->taskrepo = $taskrepo;
        $this->leadrepo = $leadrepo;

        //authenticated
        $this->middleware('auth');

        $this->middleware('homeMiddlewareIndex')->only([
            'index',
        ]);
    }

    /**
     * Display the home page
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $page = $this->pageSettings();

        $payload = [];

        //Team Dashboards
        if (auth()->user()->type == 'team') {
            //admin user
            if (auth()->user()->is_admin) {
                //get payload
                $payload = $this->adminDashboard();
                $payload['available_years'] = $this->statsrepo->getAvailableYears();                
            }
            //team uder
            if (!auth()->user()->is_admin) {
                //get payload
                $payload = $this->teamDashboard();
            }
        }

        //Client Dashboards
        if (auth()->user()->type == 'client') {
            //get payload
            $payload = $this->clientDashboard();

        }

        //[AFFILIATE]
        if (config('settings.custom_modules.cs_affiliate')) {
            if (auth()->user()->type == 'cs_affiliate') {
                //get payload
                $payload = $this->csAffiliateDashboard();
                return view('pages/cs_affiliates/home/home', compact('page', 'payload'));
            }
        }

        //page
        $payload['page'] = $page;

        //process reponse
        return new HomeResponse($payload);

    }

    /**
     * [AFFILIATE]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function csAffiliateDashboard() {

        //get events
        $events = \App\Models\Custom\CSEvent::Where('cs_event_affliateid', auth()->id())->orderBy('cs_event_id', 'DESC')
            ->take(100)
            ->get();

        //get projects
        $projects = \App\Models\Custom\CSAffiliateProject::leftJoin('projects', 'projects.project_id', '=', 'cs_affiliate_projects.cs_affiliate_project_projectid')
            ->selectRaw('*')
            ->Where('cs_affiliate_project_affiliateid', auth()->id())
            ->where('cs_affiliate_project_status', 'active')
            ->orderBy('cs_affiliate_project_id', 'DESC')
            ->take(100)
            ->get();

        //Profits - today
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $profits['today'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_commission_approval_date', $today)
            ->where('cs_affiliate_earning_affiliateid', auth()->id())
            ->where('cs_affiliate_earning_status', 'paid')
            ->sum('cs_affiliate_earning_amount');

        //Profits - today
        $start = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');
        $profits['this_month'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_commission_approval_date', '>=', $start)
            ->where('cs_affiliate_earning_commission_approval_date', '<=', $end)
            ->where('cs_affiliate_earning_status', 'paid')
            ->where('cs_affiliate_earning_affiliateid', auth()->id())
            ->sum('cs_affiliate_earning_amount');

        //Profits - all time
        $profits['all_time'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_affiliateid', auth()->id())
            ->where('cs_affiliate_earning_status', 'paid')
            ->sum('cs_affiliate_earning_amount');

        //Profits - pending
        $profits['pending'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_affiliateid', auth()->id())
            ->where('cs_affiliate_earning_status', 'unpaid')
            ->sum('cs_affiliate_earning_amount');

        $payload = [
            'events' => $events,
            'projects' => $projects,
            'profits' => $profits,
        ];

        return $payload;

    }

    /**
     * display team dashboard
     * @return \Illuminate\Http\Response
     */
    public function teamDashboard() {

        //payload
        $payload = [];

        //[projects][all]
        $payload['projects'] = [
            'pending' => $this->statsrepo->countProjects([
                'status' => 'pending',
                'assigned' => auth()->id(),
            ]),
        ];

        //tasks]
        $payload['tasks'] = [
            'new' => $this->statsrepo->countTasks([
                'status' => 'new',
                'assigned' => auth()->id(),
            ]),
            'pending' => $this->statsrepo->countTasks([
                'status' => 'pending',
                'assigned' => auth()->id(),
            ]),
            'completed' => $this->statsrepo->countTasks([
                'status' => 'completed',
                'assigned' => auth()->id(),
            ]),
        ];

        //filter
        request()->merge([
            'eventtracking_userid' => auth()->id(),
        ]);
        $payload['all_events'] = $this->trackingrepo->search(20);

        //filter
        request()->merge([
            'filter_assigned' => [auth()->id()],
        ]);
        $payload['my_projects'] = $this->projectrepo->search('', ['limit' => 30]);

        //return payload
        return $payload;

    }

    /**
     * display client dashboard
     * @return \Illuminate\Http\Response
     */
    public function clientDashboard() {

        //payload
        $payload = [];

        //[invoices]
        $payload['invoices'] = [
            'due' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'due',
                'client_id' => auth()->user()->clientid,
            ]),
            'overdue' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'overdue',
                'client_id' => auth()->user()->clientid,
            ]),
        ];

        //[projects][all]
        $payload['projects'] = [
            'pending' => $this->statsrepo->countProjects([
                'status' => 'pending',
                'client_id' => auth()->user()->clientid,
            ]),
            'completed' => $this->statsrepo->countProjects([
                'status' => 'completed',
                'client_id' => auth()->user()->clientid,
            ]),
        ];

        //filter
        request()->merge([
            'eventtracking_userid' => auth()->id(),
        ]);
        $payload['all_events'] = $this->trackingrepo->search(20);

        //filter
        request()->merge([
            'filter_project_clientid' => auth()->user()->clientid,
        ]);
        $payload['my_projects'] = $this->projectrepo->search('', ['limit' => 30]);

        //return payload
        return $payload;

    }

    /**
     * display admin User
     * @return \Illuminate\Http\Response
     */
    public function adminDashboard() {

        //payload
        $payload = [];

        //[payments]
        $payload['payments'] = [
            'today' => $this->statsrepo->sumCountPayments([
                'type' => 'sum',
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            ]),
            'this_month' => $this->statsrepo->sumCountPayments([
                'type' => 'sum',
                'start_date' => \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),
                'end_date' => \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d'),
            ]),
        ];

        //[invoices]
        $payload['invoices'] = [
            'due' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'due',
            ]),
            'overdue' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'overdue',
            ]),
        ];

        //[income][yearly]
        $payload['income'] = $this->statsrepo->sumYearlyIncome([
            'period' => 'this_year',
        ]);

        //[expense][yearly]
        $payload['expenses'] = $this->statsrepo->sumYearlyExpenses([
            'period' => 'this_year',
        ]);

        //[projects][all]
        $payload['all_projects'] = [
            'not_started' => $this->statsrepo->countProjects([
                'status' => 'not_started',
            ]),
            'in_progress' => $this->statsrepo->countProjects([
                'status' =>
                'in_progress',
            ]),
            'on_hold' => $this->statsrepo->countProjects([
                'status' => 'on_hold',
            ]),
            'completed' => $this->statsrepo->countProjects([
                'status' => 'completed',
            ]),
        ];

        //[projects][ny]
        $payload['my_projects'] = [
            'not_started' => $this->statsrepo->countProjects([
                'status' => 'not_started',
                'assigned' => auth()->id(),
            ]),
            'in_progress' => $this->statsrepo->countProjects([
                'status' => 'in_progress',
                'assigned' => auth()->id(),
            ]),
            'on_hold' => $this->statsrepo->countProjects([
                'status' => 'on_hold',
                'assigned' => auth()->id(),
            ]),
            'completed' => $this->statsrepo->countProjects([
                'status' => 'completed',
                'assigned' => auth()->id(),
            ]),
        ];

        //filter
        $payload['all_events'] = $this->eventsrepo->search([
            'pagination' => 20,
            'filter' => 'timeline_visible',
        ]);

        //[leads] - alltime
        $data = $this->widgetLeads('alltime');
        $payload['leads_stats'] = json_encode($data['stats']);
        $payload['leads_key_colors'] = json_encode($data['leads_key_colors']);
        $payload['leads_chart_center_title'] = $data['leads_chart_center_title'];

        //[tickets] - this year
        $ticket_data = $this->widgetTickets('thisyear');
        $payload['tickets_stats'] = json_encode($ticket_data['stats']);
        $payload['tickets_key_colors'] = json_encode($ticket_data['tickets_key_colors']);
        $payload['tickets_chart_center_title'] = $ticket_data['tickets_chart_center_title'] . ' - ' . $ticket_data['count_all_tickets'];
        $payload['ticket_statuses'] = $ticket_data['ticket_statuses'];

        //filter payments-today
        $payload['filter_payment_today'] = \Carbon\Carbon::now()->format('Y-m-d');

        //filter payments - this month
        $payload['filter_payment_month_start'] = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $payload['filter_payment_month_end'] = \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d');

        //return payload
        return $payload;

    }

    /**
     * create a leads widget
     * [UPCOMING] call this via ajax for dynamically changing dashboad filters
     * @param string $filter [alltime|...]  //add as we go
     * @return \Illuminate\Http\Response
     */
    public function widgetLeads($filter) {

        $payload['stats'] = [];
        $payload['leads_key_colors'] = [];
        $payload['leads_chart_center_title'] = __('lang.leads');

        $counter = 0;

        //do this for each lead category
        foreach (config('home.lead_statuses') as $status) {

            //count all leads
            if ($filter = 'alltime') {
                $count = $this->statsrepo->countLeads(
                    [
                        'status' => $status['id'],
                    ]);
            }

            //add to array
            $payload['stats'][] = [
                $status['title'], $count,
            ];

            //add to counter
            $counter += $count;

            $payload['leads_key_colors'][] = $status['colorcode'];

        }

        // no lead in system - display something (No Leads - 100%) in chart
        if ($counter == 0) {
            $payload['stats'][] = [
                'No Leads', 1,
            ];
            $payload['leads_key_colors'][] = "#eff4f5";
            $payload['leads_chart_center_title'] = __('lang.no_leads');
        }

        return $payload;
    }

/**
 * generate a chart to show the following ticket stats
 * @param string $filter [alltime|thisyear]  //add as we go
 * @return array
 */
    public function widgetTickets($filter = 'thisyear') {

        $payload['stats'] = [];
        $payload['tickets_key_colors'] = [];
        $payload['tickets_chart_center_title'] = __('lang.tickets');
        $payload['ticket_statuses'] = [];

        $counter = 0;

        // Get all ticket statuses from database
        $statuses = \App\Models\TicketStatus::orderBy('ticketstatus_position', 'asc')->get();

        // Count tickets for each status
        $year_start = \Carbon\Carbon::now()->startOfYear()->format('Y-m-d');
        $year_end = \Carbon\Carbon::now()->endOfYear()->format('Y-m-d');

        $ticket_statuses = [];

        // Loop through each status
        foreach ($statuses as $status) {

            $count = \App\Models\Ticket::where('ticket_status', $status->ticketstatus_id)
                ->where('ticket_created', '>=', $year_start)
                ->where('ticket_created', '<=', $year_end)
                ->count();

            // Store the original title and the title with count
            $payload['ticket_statuses'][] = [
                'color' => $status->ticketstatus_color,
                'title' => $status->ticketstatus_title . ': ' . $count,
            ];

            // Add to stats array - use JS-safe title with count included (escape any special characters)
            $safe_title = str_replace("'", "\\'", $status->ticketstatus_title . ': ' . $count);

            $payload['stats'][] = [
                $safe_title, $count,
            ];

            // Add to counter
            $counter += $count;

            $payload['tickets_key_colors'][] = runtimeColorCode($status->ticketstatus_color);
        }

        //sum all tickets
        $payload['count_all_tickets'] = \App\Models\Ticket::where('ticket_created', '>=', $year_start)->where('ticket_created', '<=', $year_end)->count();

        // No tickets in system - display something (No Tickets - 100%) in chart
        if ($counter == 0) {
            $payload['stats'][] = [
                'No Tickets: 0', 1,
            ];
            $payload['tickets_key_colors'][] = "#eff4f5";
            $payload['tickets_chart_center_title'] = __('lang.no_tickets');
        }

        return $payload;
    }

/**
 * Update income vs expenses chart for selected year
 * @return \Illuminate\Http\Response
 */
    public function updateIncomeExpensesChart() {

        //validation - ensure year parameter is provided and valid
        $selected_year = request('income_expenses_year');
        if (!$selected_year || !is_numeric($selected_year)) {
            abort(400, 'Invalid year parameter');
        }

        //payload
        $payload = [];

        //[income][yearly] for selected year
        $payload['income'] = $this->statsrepo->sumYearlyIncome([
            'period' => $selected_year,
        ]);

        //[expenses][yearly] for selected year
        $payload['expenses'] = $this->statsrepo->sumYearlyExpenses([
            'period' => $selected_year,
        ]);

        //available years for dropdown
        $payload['available_years'] = $this->statsrepo->getAvailableYears();

        //response type
        $payload['response'] = 'admin-income-expenses-chart';

        //process response
        return new UpdateStatsResponse($payload);
    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        $page = [
            'crumbs' => [
                __('lang.home'),
            ],
            'crumbs_special_class' => 'main-pages-crumbs',
            'page' => 'home',
            'meta_title' => __('lang.home'),
            'heading' => __('lang.home'),
            'mainmenu_home' => 'active',
            'add_button_classes' => '',
        ];

        return $page;
    }

}
