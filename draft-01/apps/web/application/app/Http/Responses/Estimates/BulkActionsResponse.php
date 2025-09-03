<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the estimates
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Estimates;
use Illuminate\Contracts\Support\Responsable;

class BulkActionsResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for estimates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //initialize the JSON data
        $jsondata = [];

        //response action is archive or restore
        if (in_array($response, ['email-clients', 'change-status'])) {

            //update each row using the ajax blade files
            foreach ($allrows as $estimates) {
                foreach ($estimates as $estimate) {
                    $html = view('pages.estimates.components.table.ajax', compact('estimates'))->render();
                    $jsondata['dom_html'][] = array(
                        'selector' => '#estimate_' . $estimate->bill_estimateid,
                        'action' => 'replace-with',
                        'value' => $html,
                    );
                }
            }

            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

            //close actions modal
            $jsondata['dom_visibility'][] = array('selector' => '#actionsModal', 'action' => 'close-modal');

            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

            //response
            return response()->json($jsondata);
        }

        //response for convert to invoice
        if ($response == 'convert-to-invoice') {
            //update each row using the ajax blade files (for estimates that weren't deleted)
            if (isset($allrows) && count($allrows) > 0) {
                foreach ($allrows as $estimates) {
                    foreach ($estimates as $estimate) {
                        $html = view('pages.estimates.components.table.ajax', compact('estimates'))->render();
                        $jsondata['dom_html'][] = array(
                            'selector' => '#estimate_' . $estimate->bill_estimateid,
                            'action' => 'replace-with',
                            'value' => $html,
                        );
                    }
                }
            }

            //remove rows for deleted estimates
            if (isset($deleted_rows) && count($deleted_rows) > 0) {
                foreach ($deleted_rows as $bill_estimateid) {
                    $jsondata['dom_visibility'][] = array(
                        'selector' => '#estimate_' . $bill_estimateid,
                        'action' => 'slideup-remove',
                    );
                }
            }

            //close commonModal
            $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

            // Update stats widget
            $jsondata['dom_html'][] = [
                'selector' => '#estimates-stats-wrapper',
                'action' => 'replace',
                'value' => view('misc.list-pages-stats', ['stats' => $stats])->render(),
            ];

            //response
            return response()->json($jsondata);
        }

        //default reponse
        return response()->json($jsondata);
    }

}
