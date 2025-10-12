<?php

/** --------------------------------------------------------------------------------
 * Process proposal automation
 *
 * @fooo    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;
use App\Repositories\EmailerRepository;
use App\Repositories\EstimateRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\FileFolderRepository;
use App\Repositories\InvoiceGeneratorRepository;
use App\Repositories\LineitemRepository;
use App\Repositories\MilestoneCategoryRepository;
use App\Repositories\MilestoneRepository;
use App\Repositories\ProjectManagerRepository;
use App\Repositories\ProposalRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class ProposalAutomationRepository {

    private $settings;
    private $assignedrepo;
    private $eventrepo;
    private $trackingrepo;
    private $emailerrepo;
    private $userrepo;
    private $taskrepo;
    private $proposalrepo;
    private $invoicegenerator;
    private $milestonerepo;
    private $milestonecategories;
    private $filefolderrepo;
    private $lineitemrepo;
    private $estimaterepo;

    public function __construct(
        ProjectManagerRepository $assignedrepo,
        EventRepository $eventrepo,
        EmailerRepository $emailerrepo,
        TaskRepository $taskrepo,
        UserRepository $userrepo,
        EstimateRepository $estimaterepo,
        ProposalRepository $proposalrepo,
        InvoiceGeneratorRepository $invoicegenerator,
        MilestoneRepository $milestonerepo,
        MilestoneCategoryRepository $milestonecategories,
        FileFolderRepository $filefolderrepo,
        LineitemRepository $lineitemrepo,
        EventTrackingRepository $trackingrepo) {

        //system settings
        $this->settings = \App\Models\Settings::Where('settings_id', 1)->first();

        $this->assignedrepo = $assignedrepo;
        $this->eventrepo = $eventrepo;
        $this->trackingrepo = $trackingrepo;
        $this->emailerrepo = $emailerrepo;
        $this->userrepo = $userrepo;
        $this->taskrepo = $taskrepo;
        $this->proposalrepo = $proposalrepo;
        $this->invoicegenerator = $invoicegenerator;
        $this->milestonerepo = $milestonerepo;
        $this->milestonecategories = $milestonecategories;
        $this->filefolderrepo = $filefolderrepo;
        $this->lineitemrepo = $lineitemrepo;
        $this->estimaterepo = $estimaterepo;

    }

    /**
     * process the automation
     *
     * @param  int  $id proposal id
     * @return \Illuminate\Http\Response
     */
    public function process($proposal) {

        Log::info("proposal automation started", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $proposal->doc_id]);

        //default (incase we are not creating a project)
        $project = [];

        //check if the proposal has automation enabled
        if ($proposal->proposal_automation_status != 'enabled') {
            Log::info("proposal automation is disabled - will now exit", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $proposal->doc_id]);
            return;
        }

        //(1) create project
        if ($proposal->proposal_automation_create_project == 'yes') {

            //create a new project
            if ($project = $this->createProject($proposal)) {

                //assign the project
                $assigned = $this->assignProject($project, $proposal);

                //record timeline & email clent
                $this->projectTimeline($project, $proposal);

                //create tasks
                $this->createTasks($project, $proposal);
            }

        }

        //(2) create invoice
        if ($proposal->proposal_automation_create_invoice == 'yes') {

            //new invoice
            if ($invoice = $this->createInvoice($proposal, $project)) {

                //eamail the invoice to the client
                $this->emailInvoice($invoice->bill_invoiceid);
            }

        }

        Log::info("proposal automation completed", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $proposal->doc_id]);

    }

    /**
     * create a new project
     * @param obj $proposal proposal
     * @return obj project
     */
    public function createProject($proposal) {

        //info
        Log::info("starting to create a project for this proposal", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $proposal->doc_id]);

        //check if automation has not already run for this proposal
        if (is_numeric($proposal->proposal_automation_log_created_project_id)) {
            if (\App\Models\Project::Where('project_id', $proposal->proposal_automation_log_created_project_id)->exists()) {
                Log::info("a project has previously been created for this automation. will now exit", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $proposal->doc_id, 'project_id' => $proposal->proposal_automation_log_created_project_id]);
                return false;
            }
        }

        $project = new \App\Models\Project();
        $project->project_clientid = $proposal->doc_client_id;
        $project->project_status = $proposal->proposal_automation_project_status;
        $project->project_title = $proposal->proposal_automation_project_title;
        $project->project_creatorid = 0;
        $project->project_uniqueid = str_unique();
        $project->project_date_start = now();
        $project->project_billing_rate = $this->settings->settings_projects_default_hourly_rate;
        $project->clientperm_tasks_view = $this->settings->settings_projects_clientperm_tasks_view;
        $project->clientperm_tasks_collaborate = $this->settings->settings_projects_clientperm_tasks_collaborate;
        $project->clientperm_tasks_create = $this->settings->settings_projects_clientperm_tasks_create;
        $project->clientperm_timesheets_view = $this->settings->settings_projects_clientperm_timesheets_view;
        $project->clientperm_expenses_view = $this->settings->settings_projects_clientperm_expenses_view;
        $project->clientperm_checklists = $this->settings->settings_projects_clientperm_checklists;
        $project->assignedperm_milestone_manage = $this->settings->settings_projects_assignedperm_milestone_manage;
        $project->assignedperm_tasks_collaborate = $this->settings->settings_projects_assignedperm_tasks_collaborate;
        $project->project_calendar_timezone = config('system.settings_system_timezone');
        $project->save();

        //create default milestones
        $position = $this->milestonecategories->addProjectMilestones($project);
        $this->milestonerepo->addUncategorised($project->project_id, $position);

        //add default folders
        $this->filefolderrepo->addDefault($project->project_id);

        //attach proposal to this project
        \App\Models\Proposal::where('doc_id', $proposal->doc_id)
            ->update([
                'doc_project_id' => $project->project_id,
                'proposal_automation_log_created_project_id' => $project->project_id,
            ]);

        //info
        Log::info("project has been created", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

        //return project
        return $project;
    }

    /**
     * assign the project
     * @param obj $project project
     * @param obj $proposal proposal
     * @return null
     */
    public function assignProject($project, $proposal) {

        //info
        Log::info("assigning the prroject", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

        //default
        $users = [];

        //get assigned users
        $assigned_users = \App\Models\AutomationAssigned::Where('automationassigned_resource_type', 'proposal')
            ->Where('automationassigned_resource_id', $proposal->doc_id)
            ->get();

        //assign
        foreach ($assigned_users as $assigned_user) {
            $assigned = new \App\Models\ProjectAssigned();
            $assigned->projectsassigned_projectid = $project->project_id;
            $assigned->projectsassigned_userid = $assigned_user->automationassigned_userid;
            $assigned->save();
            $users[] = $assigned_user->automationassigned_userid;
        }

        //email
        foreach ($assigned_users as $assigned_user) {
            if ($user = \App\Models\User::Where('id', $assigned_user->automationassigned_userid)->first()) {
                if ($user->notifications_new_assignement == 'yes_email') {
                    $mail = new \App\Mail\ProjectAssignment($user, [], $project);
                    $mail->build();
                }
            }
        }

        //return
        return $users;

    }

    /**
     * create timeline events
     * @param obj $project project
     * @param obj $proposal proposal
     * @return null
     */
    public function projectTimeline($project, $proposal) {

        //info
        Log::info("recoring project creation event timeline", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

        /** ----------------------------------------------
         * record event [project created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => 0,
            'event_item' => 'new_project',
            'event_item_id' => '',
            'event_item_lang' => 'event_created_project',
            'event_item_content' => $project->project_title,
            'event_item_content2' => '',
            'event_parent_type' => 'project',
            'event_parent_id' => $project->project_id,
            'event_parent_title' => $project->project_title,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => $project->project_clientid,
            'eventresource_type' => 'project',
            'eventresource_id' => $project->project_id,
            'event_notification_category' => 'notifications_projects_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($project->project_clientid, 'all', 'ids');
            //record notification
            $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        /** ----------------------------------------------
         * send email [project created]
         * ----------------------------------------------*/
        if ($proposal->proposal_automation_project_email_client == 'yes') {
            if ($owner = $this->userrepo->getClientAccountOwner($project->project_clientid)) {
                if ($owner->notifications_new_project == 'yes_email') {
                    $mail = new \App\Mail\ProjectCreated($owner, [], $project);
                    $mail->build();
                }
            }
        }

    }

    /**
     * create project tasks
     * @param obj $project project
     * @param obj $proposal proposal
     * @return null
     */
    public function createTasks($project, $proposal) {

        //validate
        if ($proposal->proposal_automation_create_tasks != 'yes') {
            return;
        }

        //info
        Log::info("creating tasks for the project - started", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

        //get the default milestone category
        $milestone = \App\Models\Milestone::Where('milestone_projectid', $project->project_id)->Where('milestone_type', 'uncategorised')->first();

        //check if there is an estimate with this proposal
        if (!$estimate = \App\Models\Estimate::Where('bill_proposalid', $proposal->doc_id)->first()) {
            Log::info("this proposal does not have a pricing estimate - will exit creating tasks", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);
            return true;
        }

        //get the line items for this proposal's estimate
        if ($items = \App\Models\Lineitem::Where('lineitemresource_type', 'estimate')->where('lineitemresource_id', $estimate->bill_estimateid)->get()) {

            //list of task id's for tasks that will be created product tasks
            $product_tasks_list = [];
            $product_tasks_map = [];

            //create a task
            $count = 1;
            foreach ($items as $item) {

                //do we have tasks from the product used in the line item
                if (is_numeric($item->lineitem_linked_product_id) && $product_tasks = \App\Models\ProductTask::Where('product_task_itemid', $item->lineitem_linked_product_id)->get()) {
                    Log::info("found some product based tasks. will now create tasks using them.", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

                    foreach ($product_tasks as $task_template) {
                        $task = new \App\Models\Task();
                        $task->task_creatorid = 0;
                        $task->task_uniqueid = str_unique();
                        $task->task_projectid = $project->project_id;
                        $task->task_clientid = $proposal->doc_client_id;
                        $task->task_title = $task_template->product_task_title;
                        $task->task_description = $task_template->product_task_description;
                        $task->task_client_visibility = 'yes';
                        $task->task_status = 1; //default (new)
                        $task->task_milestoneid = $milestone->milestone_id;
                        $task->task_position = $count;
                        $task->task_calendar_timezone = config('system.settings_system_timezone');
                        $task->save();

                        //add to list and map them
                        $product_tasks_list[] = $task_template->product_task_id;
                        $product_tasks_map[$task_template->product_task_id] = $task->task_id;

                        //assign the task users
                        $this->assignTaskUsers($task, $project, $task_template, 'specified');
                    }

                    //create dependencies

                } else {

                    Log::info("no product based tasks were found. will now create using the lineitem, title", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

                    $task = new \App\Models\Task();
                    $task->task_creatorid = 0;
                    $task->task_uniqueid = str_unique();
                    $task->task_projectid = $project->project_id;
                    $task->task_clientid = $proposal->doc_client_id;
                    $task->task_title = $item->lineitem_description;
                    $task->task_client_visibility = 'yes';
                    $task->task_status = 1; //default (new)
                    $task->task_milestoneid = $milestone->milestone_id;
                    $task->task_position = $count;
                    $task->task_calendar_timezone = config('system.settings_system_timezone');
                    $task->save();
                    $count++;

                    //assign the task
                    $this->assignTaskUsers($task, $project, $proposal, 'default');

                    //info
                    Log::info("new task create", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id, 'task_title' => $task->task_title]);

                }

            }

            //create any task dependencies referrenced in the product tasks
            $this->createTaskDependencies($project, $product_tasks_list, $product_tasks_map);

        }
    }

    /**
     * create any task dependencies
     * @param obj $project project
     * @param obj $product_tasks_list
     * @param obj $product_tasks_map
     * @return null
     */
    public function createTaskDependencies($project, $product_tasks_list, $product_tasks_map) {

        Log::info("creating task dependencies", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

        //validation
        if (empty($product_tasks_list)) {
            Log::info("no tasks were created for products. dependencies will now exit.", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);
        }

        //get all the blocking tasks
        if ($dependencies = \App\Models\ProductTasksDependency::WhereIn('product_task_dependency_taskid', $product_tasks_list)->get()) {
            Log::info("found some task dependencies", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

            foreach ($dependencies as $dependency) {
                $task_dependency = new \App\Models\TaskDependency();
                $task_dependency->tasksdependency_creatorid = 0;
                $task_dependency->tasksdependency_projectid = $project->project_id;
                $task_dependency->tasksdependency_clientid = $project->project_clientid;
                $task_dependency->tasksdependency_taskid = $product_tasks_map[$dependency->product_task_dependency_taskid];
                $task_dependency->tasksdependency_blockerid = $product_tasks_map[$dependency->product_task_dependency_blockerid];
                $task_dependency->tasksdependency_type = $dependency->product_task_dependency_type;
                $task_dependency->save();
            }
        }

    }

    /**
     * assign a task
     * @param obj $project project
     * @param obj $proposal proposal
     * @return null
     */
    public function assignTaskUsers($task, $project, $obj, $type) {

        Log::info("assiging tasks (default users)", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);

        //get assigned project users (system default users)
        if ($type == 'default') {
            $assigned_users = \App\Models\AutomationAssigned::Where('automationassigned_resource_type', 'proposal')
                ->Where('automationassigned_resource_id', $obj->doc_id)
                ->get();
        }

        //get assigned project users (specified users from the product task)
        if ($type == 'specified') {
            $assigned_users = \App\Models\AutomationAssigned::Where('automationassigned_resource_type', 'product_task')
                ->Where('automationassigned_resource_id', $obj->product_task_id)
                ->get();

            //[sanity] also assign these task users to the project itself (if they were not already assigned)
            foreach ($assigned_users as $project_user) {
                if (\App\Models\ProjectAssigned::Where('projectsassigned_projectid', $project->project_id)
                    ->Where('projectsassigned_userid', $project_user->automationassigned_userid)
                    ->doesntExist()) {
                    $assigned = new \App\Models\ProjectAssigned();
                    $assigned->projectsassigned_projectid = $project->project_id;
                    $assigned->projectsassigned_userid = $project_user->automationassigned_userid;
                    $assigned->save();
                }
            }
        }

        //assign each project user
        $users = [];
        foreach ($assigned_users as $assigned_user) {
            $assigned = new \App\Models\TaskAssigned();
            $assigned->tasksassigned_taskid = $task->task_id;
            $assigned->tasksassigned_userid = $assigned_user->automationassigned_userid;
            $assigned->save();
            $users[] = $assigned_user->automationassigned_userid;
        }

        //get the task with more data needed in email
        $tasks = $this->taskrepo->search($task->task_id, ['apply_filters' => false]);
        $task = $tasks->first();

        /** ----------------------------------------------
         * record assignment events and send emails
         * ----------------------------------------------*/
        foreach ($users as $user_id) {
            if ($user = \App\Models\User::Where('id', $user_id)->first()) {
                $data = [
                    'event_creatorid' => 0,
                    'event_item' => 'assigned',
                    'event_item_id' => '',
                    'event_item_lang' => 'event_assigned_user_to_a_task',
                    'event_item_lang_alt' => 'event_assigned_user_to_a_task_alt',
                    'event_item_content' => __('lang.assigned'),
                    'event_item_content2' => $user_id,
                    'event_item_content3' => $user->first_name,
                    'event_parent_type' => 'task',
                    'event_parent_id' => $task->task_id,
                    'event_parent_title' => $task->task_title,
                    'event_show_item' => 'yes',
                    'event_show_in_timeline' => 'yes',
                    'event_clientid' => $task->task_clientid,
                    'eventresource_type' => 'project',
                    'eventresource_id' => $task->task_projectid,
                    'event_notification_category' => 'notifications_new_assignement',
                ];
                //record event
                if ($event_id = $this->eventrepo->create($data)) {
                    $emailusers = $this->trackingrepo->recordEvent($data, [$user_id], $event_id);
                }

                //email user
                if ($user->notifications_new_assignement == 'yes_email') {
                    $mail = new \App\Mail\TaskAssignment($user, $data, $task);
                    $mail->build();
                }
            }
        }

    }

    /**
     * create a new invoice
     * @param obj $proposal proposal
     * @return obj project
     */
    public function createInvoice($proposal, $project) {

        //info
        Log::info("starting to create an invoice", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $proposal->doc_id]);

        //check if there is an estimate with this proposal
        if (!$estimate = \App\Models\Estimate::Where('bill_proposalid', $proposal->doc_id)->first()) {
            Log::info("this proposal does not have a pricing estimate - will exit creating invoice", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $project->project_id]);
            return true;
        }

        //update estimate to have a client id
        $estimate->bill_clientid = $proposal->doc_client_id;
        $estimate->save();

        //defaults
        $bill_terms = config('system.settings_invoices_default_terms_conditions');
        $bill_due_days = $proposal->proposal_automation_invoice_due_date;

        //make sure this proposal has not been previously converted to an invoice
        if (is_numeric($proposal->proposal_automation_log_created_invoice_id)) {
            if (\App\Models\Invoice::Where('bill_invoiceid', $proposal->proposal_automation_log_created_invoice_id)->exists()) {
                //info
                Log::info("an invoice has previously been created for this automation. will now exit", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $proposal->doc_id, 'invoice_id' => $proposal->proposal_automation_log_created_invoice_id]);
                return false;
            }
        }

        //Set invoice terms and due days - from client profile (if they exists)
        if ($client = \App\Models\Client::Where('client_id', $proposal->doc_client_id)->first()) {
            //set the invoice terms
            if ($client->client_billing_invoice_terms != '') {
                $bill_terms = $client->client_billing_invoice_terms;
            }
            //set the invoice due days
            if (is_numeric($client->client_billing_invoice_due_days)) {
                $bill_due_days = $client->client_billing_invoice_due_days;
            }
        }

        //convert the proposal to an invoice
        $invoice = $this->estimaterepo->convertEstimateToInvoice($estimate->bill_estimateid);
        $invoice->bill_date = now();
        $invoice->bill_due_date = \Carbon\Carbon::now()->addDays($bill_due_days)->format('Y-m-d');
        $invoice->bill_terms = $bill_terms;
        $invoice->bill_creatorid = 0;
        $invoice->bill_uniqueid = str_unique();
        $invoice->save();

        //did we also create a project as part of this process
        if ($project instanceof \App\Models\Project) {
            $invoice->bill_projectid = $project->project_id;
            $invoice->save();
        } else {
            //attach the invoice to the project listed in the automation log (if one exists) or null
            $invoice->bill_projectid = $proposal->proposal_automation_log_created_project_id;
            $invoice->save();
        }

        //mark proposal as converted to invoice
        \App\Models\Proposal::where('doc_id', $proposal->doc_id)
            ->update([
                'proposal_automation_log_created_invoice_id' => $invoice->bill_invoiceid,
            ]);

        //return
        return $invoice;

    }

    /**
     * email invoice to the client
     * @param int $id invoice id
     * @return \Illuminate\Http\Response
     */
    public function emailInvoice($bill_invoiceid) {

        //info
        Log::info("emailing invoice to client", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'invoice_id' => $bill_invoiceid]);

        //update invoice status to published
        if (!$invoice = \App\Models\Invoice::Where('bill_invoiceid', $bill_invoiceid)->first()) {
            Log::error("emailing invoice to client failed - unable to fetch the invoice id ($bill_invoiceid)", ['process' => '[proposal-automation]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'invoice_id' => $invoice->bill_invoiceid]);
            return false;
        }

        //update invoice status
        $invoice->bill_status = 'due';
        $invoice->save();

        //generate the invoice
        if (!$payload = $this->invoicegenerator->generate($invoice->bill_invoiceid)) {
            return;
        }

        //invoice
        $invoice = $payload['bill'];

        /** ----------------------------------------------
         * send email [queued]
         * ----------------------------------------------*/
        $users = $this->userrepo->getClientUsers($invoice->bill_clientid, 'owner', 'collection');
        //other data
        $data = [];
        foreach ($users as $user) {
            $mail = new \App\Mail\PublishInvoice($user, $data, $invoice);
            $mail->build();
        }
    }
}