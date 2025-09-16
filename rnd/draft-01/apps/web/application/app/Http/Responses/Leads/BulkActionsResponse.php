<?php

/** --------------------------------------------------------------------------------
 * This classes renders [common] responses for various controllers
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Leads;
use Illuminate\Contracts\Support\Responsable;

class BulkActionsResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for invoices
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //response action is archive or restore
        if (in_array($response, ['archive', 'restore'])) {

            //update each row using the ajax blade files
            //for both list and card view
            foreach ($allrows as $leads) {
                foreach ($leads as $lead) {
                    //list view - render the each row
                    $html = view('pages.leads.components.table.ajax', compact('leads'))->render();
                    $jsondata['dom_html'][] = array(
                        'selector' => '#lead_' . $lead->lead_id,
                        'action' => 'replace-with',
                        'value' => $html,
                    );
                }
            }

            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

            //ajax response
            return response()->json($jsondata);

        }

    }

}
