<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for templates
 *
 * @proposal    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Proposal;
use App\Repositories\EventRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;

class ProposalRepository {

    /**
     * The repository instance.
     */
    protected $proposal;
    protected $eventrepo;
    protected $trackingrepo;
    protected $userrepo;

    /**
     * Inject dependecies
     */
    public function __construct(
        Proposal $proposal,
        EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo,
        UserRepository $userrepo) {

        $this->proposal = $proposal;
        $this->eventrepo = $eventrepo;
        $this->trackingrepo = $trackingrepo;
        $this->userrepo = $userrepo;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object proposals collection
     */
    public function search($id = '', $data = []) {

        $proposals = $this->proposal->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        //joins
        $proposals->leftJoin('users', 'users.id', '=', 'proposals.doc_creatorid');
        $proposals->leftJoin('clients', 'clients.client_id', '=', 'proposals.doc_client_id');
        $proposals->leftJoin('leads', 'leads.lead_id', '=', 'proposals.doc_lead_id');
        $proposals->leftJoin('estimates', 'estimates.bill_proposalid', '=', 'proposals.doc_id');
        $proposals->leftJoin('categories', 'categories.category_id', '=', 'proposals.doc_categoryid');
        $proposals->leftJoin('pinned', function ($join) {
            $join->on('pinned.pinnedresource_id', '=', 'proposals.doc_id')
                ->where('pinned.pinnedresource_type', '=', 'proposal');
            if (auth()->check()) {
                $join->where('pinned.pinned_userid', auth()->id());
            }
        });

        //join: users reminders - do not do this for cronjobs
        if (auth()->check()) {
            $proposals->leftJoin('reminders', function ($join) {
                $join->on('reminders.reminderresource_id', '=', 'proposals.doc_id')
                    ->where('reminders.reminderresource_type', '=', 'proposal')
                    ->where('reminders.reminder_userid', '=', auth()->id());
            });
        }

        // all client fields
        $proposals->selectRaw('*');

        //count proposals (all)
        $proposals->selectRaw("(SELECT COUNT(*)
                                      FROM proposals)
                                      AS count_proposals_all");

        //count proposals (draft)
        $proposals->selectRaw("(SELECT COUNT(*)
                                      FROM proposals
                                      WHERE doc_status = 'draft')
                                      AS count_proposals_draft");

        //count proposals (new)
        $proposals->selectRaw("(SELECT COUNT(*)
                                      FROM proposals
                                      WHERE doc_status = 'new')
                                      AS count_proposals_new");

        //count proposals (accepted)
        $proposals->selectRaw("(SELECT COUNT(*)
                                      FROM proposals
                                      WHERE doc_status = 'accepted')
                                      AS count_proposals_accepted");

        //count proposals (declined)
        $proposals->selectRaw("(SELECT COUNT(*)
                                      FROM proposals
                                      WHERE doc_status = 'declined')
                                      AS count_proposals_declined");

        //count proposals (revised)
        $proposals->selectRaw("(SELECT COUNT(*)
                                      FROM proposals
                                      WHERE doc_status = 'revised')
                                      AS count_proposals_revised");

        //client details - first name
        $proposals->selectRaw("(SELECT first_name
                                      FROM users
                                      WHERE clientid = proposals.doc_client_id AND account_owner = 'yes' LIMIT 1)
                                      AS client_first_name");

        //client details - last name
        $proposals->selectRaw("(SELECT last_name
                                      FROM users
                                      WHERE clientid = proposals.doc_client_id AND account_owner = 'yes' LIMIT 1)
                                      AS client_last_name");

        //sum value: all
        $proposals->selectRaw("(SELECT COALESCE(SUM(bill_final_amount), 0.00)
                                      FROM estimates
                                      WHERE bill_proposalid = proposals.doc_id)
                                      AS proposal_value");

        //default where
        $proposals->whereRaw("1 = 1");

        //filters: id
        if (request()->filled('filter_doc_id')) {
            $proposals->where('doc_id', request('filter_doc_id'));
        }
        if (is_numeric($id)) {
            $proposals->where('doc_id', $id);
        }

        //stats: - count
        if (isset($data['stats']) && (in_array($data['stats'], [
            'count-new',
            'count-accepted',
            'count-declined',
            'count-revised',
            'count-expired',
        ]))) {
            $proposals->where('doc_status', str_replace('count-', '', $data['stats']));
        }

        //stats: - sum
        if (isset($data['stats']) && (in_array($data['stats'], [
            'sum-new',
            'sum-accepted',
            'sum-declined',
            'sum-revised',
            'sum-expired',
        ]))) {
            $proposals->where('doc_status', str_replace('sum-', '', $data['stats']));
        }

        //filter category
        if (is_array(request('filter_proposal_categoryid')) && !empty(array_filter(request('filter_proposal_categoryid')))) {
            $proposals->whereIn('doc_categoryid', request('filter_proposal_categoryid'));
        }

        //apply filters
        if ($data['apply_filters']) {

            //filter doc_client_id
            if (request()->filled('filter_doc_client_id')) {
                $proposals->where('doc_client_id', request('filter_doc_client_id'));
            }

            //filter doc_client_id
            if (request()->filled('filter_doc_lead_id')) {
                $proposals->where('doc_lead_id', request('filter_doc_lead_id'));
            }

            //filter proposal id
            if (request()->filled('filter_proposal_id')) {
                $proposals->where('proposal_id', request('filter_proposal_id'));
            }

            //filter: doc_date (start)
            if (request()->filled('filter_doc_date')) {
                $proposals->whereDate('doc_date', '>=', request('filter_doc_date'));
            }

            //filter: doc_date (end)
            if (request()->filled('filter_doc_date')) {
                $proposals->whereDate('doc_date', '<=', request('filter_doc_date'));
            }

            //filter: doc_created (start)
            if (request()->filled('filter_doc_created')) {
                $proposals->whereDate('doc_created', '>=', request('filter_doc_created'));
            }

            //filter: doc_created (end)
            if (request()->filled('filter_doc_created')) {
                $proposals->whereDate('doc_created', '<=', request('filter_doc_created'));
            }

            //filter: doc_date_from (start)
            if (request()->filled('filter_doc_date_start_start')) {
                $proposals->whereDate('doc_date_start', '>=', request('filter_doc_date_start_start'));
            }

            //filter: doc_date_from (end)
            if (request()->filled('filter_doc_date_start_end')) {
                $proposals->whereDate('doc_date_start', '<=', request('filter_doc_date_start_end'));
            }

            //filter: doc_date_end (start)
            if (request()->filled('filter_doc_date_end_start')) {
                $proposals->whereDate('doc_date_end', '>=', request('filter_doc_date_end_start'));
            }

            //filter: doc_date_end (end)
            if (request()->filled('filter_doc_date_end_end')) {
                $proposals->whereDate('doc_date_end', '<=', request('filter_doc_date_end_end'));
            }

            //filter: doc_status
            if (is_array(request('filter_doc_status')) && !empty(array_filter(request('filter_doc_status')))) {
                $proposals->whereIn('doc_status', request('filter_doc_status'));
            }

            //filter: tags
            if (is_array(request('filter_tags')) && !empty(array_filter(request('filter_tags')))) {
                $proposals->whereHas('tags', function ($query) {
                    $query->whereIn('tag_title', request('filter_tags'));
                });
            }

        }

        //filter - exlude draft proposals
        if (request('filter_proposal_exclude_status') == 'draft') {
            $proposals->whereNotIn('doc_status', ['draft']);
        }

        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
            $proposals->where(function ($query) {
                //clean for estimate id search
                $proposal_id = str_replace(config('system.settings_proposals_prefix'), '', request('search_query'));
                $proposal_id = preg_replace("/[^0-9.,]/", '', $proposal_id);
                $proposal_id = ltrim($proposal_id, '0');
                $query->Where('doc_id', '=', $proposal_id);

                $query->orWhere('doc_status', '=', request('search_query'));
                $query->orWhere('lead_firstname', '=', request('search_query'));
                $query->orWhere('lead_lastname', '=', request('search_query'));
                $query->orWhere('client_company_name', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('doc_title', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('lead_title', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('lead_firstname', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('lead_lastname', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('doc_date_start', '=', date('Y-m-d', strtotime(request('search_query'))));
                $query->orWhere('doc_date_end', '=', date('Y-m-d', strtotime(request('search_query'))));
                if (is_numeric(request('search_query'))) {
                    $query->orWhere('bill_final_amount', '=', request('search_query'));
                }
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('proposals', request('orderby'))) {
                $proposals->orderByRaw('CASE WHEN pinned.pinned_id IS NOT NULL THEN 1 ELSE 0 END DESC')
                    ->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
            case 'client':
                $proposals->orderByRaw('CASE WHEN pinned.pinned_id IS NOT NULL THEN 1 ELSE 0 END DESC')
                    ->orderBy('client_company_name', request('sortorder'))
                    ->orderBy('lead_firstname', request('sortorder'));
                break;
            case 'value':
                $proposals->orderByRaw('CASE WHEN pinned.pinned_id IS NOT NULL THEN 1 ELSE 0 END DESC')
                    ->orderBy('bill_final_amount', request('sortorder'));
                break;
            }
        } else {
            //default sorting
            $proposals->orderByRaw('CASE WHEN pinned.pinned_id IS NOT NULL THEN 1 ELSE 0 END DESC')
                ->orderBy('doc_id', 'desc');
        }

        //stats - count all
        if (isset($data['stats']) && in_array($data['stats'], [
            'count-new',
            'count-accepted',
            'count-declined',
            'count-revised',
            'count-expired',
        ])) {
            return $proposals->count();
        }

        //stats - sum balances
        if (isset($data['stats']) && in_array($data['stats'], [
            'sum-new',
            'sum-accepted',
            'sum-declined',
            'sum-revised',
            'sum-expired',
        ])) {
            return $proposals->get()->sum('proposal_value');
        }

        // Get the results and return them.
        return $proposals->paginate(config('system.settings_system_pagination_limits'));
    }

    /**
     * get the company name linked to a proposal
     *
     * @param  doc_id  prposal id
     * @return string
     */
    public function contactDetails($doc_id = '') {

        $details = [
            'company_name' => '---',
            'first_name' => '---',
            'last_name' => '---',
            'email' => '---',
        ];

        if ($proposal = \App\Models\Proposal::Where('doc_id', $doc_id)->first()) {
            //client proposal
            if ($proposal->docresource_type == 'client') {
                //company name
                if ($client = \App\Models\Client::Where('client_id', $proposal->doc_client_id)->first()) {
                    $details['company_name'] = $client->client_company_name;
                }
                //first name
                if ($user = \App\Models\User::Where('clientid', $proposal->doc_client_id)->where('account_owner', 'yes')->first()) {
                    $details['first_name'] = $user->first_name;
                    $details['last_name'] = $user->last_name;
                    $details['email'] = $user->email;
                }
            }
            //lead proposal
            if ($proposal->docresource_type == 'lead') {
                //company name
                if ($lead = \App\Models\Lead::Where('lead_id', $proposal->doc_lead_id)->first()) {
                    //$details['company_name'] = ($lead->lead_company_name != '') ? $lead->lead_company_name : $lead->lead_firstname. ' '. $lead->lead_lastname;
                    $details['company_name'] = $lead->lead_firstname . ' ' . $lead->lead_lastname;
                    $details['first_name'] = $lead->lead_firstname;
                    $details['last_name'] = $lead->lead_lastname;
                    $details['email'] = $lead->lead_email;
                }
            }
        }

        return $details;
    }

    /**
     * publish the resource
     * @return bool
     */
    public function publish($id = '') {

        Log::info("publishing proposal (id: $id) has started", ['process' => '[publish-proposal]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $id]);

        //validation
        if (!is_numeric($id)) {
            Log::error("publishing proposal has failed - proposal id is invalid", ['process' => '[publish-proposal]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $id]);
            return false;
        }

        //get the project
        if (!$document = \App\Models\Proposal::Where('doc_id', $id)->first()) {
            Log::error("publishing proposal has failed - proposal could not be found", ['process' => '[publish-proposal]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $id]);
            return false;
        }

        //get the proposal estimate
        if ($estimate = \App\Models\Estimate::Where('bill_proposalid', $id)->Where('bill_estimate_type', 'document')->first()) {
            $value = $estimate->bill_final_amount;
        } else {
            $value = 0;
        }

        //mark as published
        $document->doc_status = 'new';
        $document->doc_date_published = now();
        $document->doc_date_last_emailed = now();
        $document->save();

        /** ----------------------------------------------
         * record event [comment]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => (auth()->check()) ? auth()->id() : $document->doc_creatorid,
            'event_item' => 'proposal',
            'event_item_id' => $document->doc_id,
            'event_item_lang' => 'event_created_proposal',
            'event_item_content' => __('lang.proposal') . ' - ' . runtimeProposalIdFormat($document->doc_id),
            'event_item_content2' => '',
            'event_parent_type' => 'proposal',
            'event_parent_id' => $document->doc_id,
            'event_parent_title' => $document->doc_title,
            'event_clientid' => $document->doc_client_id,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => (is_numeric($document->doc_project_id)) ? 'project' : 'client',
            'eventresource_id' => (is_numeric($document->doc_project_id)) ? $document->doc_project_id : $document->doc_client_id,
            'event_notification_category' => 'notifications_billing_activity',
        ];
        $event_id = $this->eventrepo->create($data);

        /** ----------------------------------------------
         * send email - client users - [queued]
         * ----------------------------------------------*/
        if ($document->docresource_type == 'client') {

            if ($event_id = $this->eventrepo->create($data)) {
                //get users (main client)
                $users = $this->userrepo->getClientUsers($document->doc_client_id, 'owner', 'ids');
                //record notification
                $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
            }
            if (isset($emailusers) && is_array($emailusers)) {
                Log::info("foo bar4");
                $data = [
                    'user_type' => 'client',
                    'proposal_value' => $value,
                ];
                //send to users
                if ($users = \App\Models\User::WhereIn('id', $emailusers)->get()) {
                    foreach ($users as $user) {
                        $mail = new \App\Mail\ProposalPublish($user, $data, $document);
                        $mail->build();
                    }
                }
            }
        }

        /** ----------------------------------------------
         * send email - lead users - [queued]
         * ----------------------------------------------*/
        if ($document->docresource_type == 'lead') {
            if ($lead = \App\Models\Lead::Where('lead_id', $document->doc_lead_id)->first()) {
                $data = [
                    'user_type' => 'lead',
                    'proposal_value' => $value,
                ];
                $mail = new \App\Mail\ProposalPublish($lead, $data, $document);
                $mail->build();
            }
        }

        Log::info("publishing proposal (id: $id) has completed", ['process' => '[publish-proposal]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'proposal_id' => $id]);

        return true;
    }
}