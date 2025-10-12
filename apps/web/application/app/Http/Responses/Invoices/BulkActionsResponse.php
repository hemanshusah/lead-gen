<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the invoices
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Invoices;
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

        //initialize the JSON data
        $jsondata = [];

        //response action is archive or restore
        if (in_array($response, ['dettach-project', 'email-clients'])) {

            //update each row using the ajax blade files
            foreach ($allrows as $invoices) {
                foreach ($invoices as $invoice) {
                    $html = view('pages.invoices.components.table.ajax', compact('invoices'))->render();
                    $jsondata['dom_html'][] = array(
                        'selector' => '#invoice_' . $invoice->bill_invoiceid,
                        'action' => 'replace-with',
                        'value' => $html
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

        //default reponse
        return response()->json($jsondata);
    }

}