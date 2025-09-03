<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for lead logs
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\LeadLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LeadLogRepository {

    /**
     * The leads repository instance.
     */
    protected $logs;

    /**
     * Inject dependecies
     */
    public function __construct(LeadLog $logs) {
        $this->logs = $logs;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object lead logs collection
     */
    public function search($id = '', $data = array()) {

        $logs = $this->logs->newQuery();

        // all client fields
        $logs->selectRaw('*');

        //filter by lead id
        if (request()->filled('filter_lead_id')) {
            $logs->where('lead_log_leadid', request('filter_lead_id'));
        }

        //filter by log id
        if (is_numeric($id)) {
            $logs->where('lead_log_id', $id);
        }

        //filter by log unique id
        if (request()->filled('filter_lead_log_uniqueid')) {
            $logs->where('lead_log_uniqueid', request('filter_lead_log_uniqueid'));
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('lead_logs', request('orderby'))) {
                $logs->orderBy(request('orderby'), request('sortorder'));
            }
        } else {
            //default sorting
            $logs->orderBy('lead_log_id', 'desc');
        }

        //eager load
        $logs->with(['creator', 'lead']);

        // Get the results and return them.
        return $logs->get();
    }
}