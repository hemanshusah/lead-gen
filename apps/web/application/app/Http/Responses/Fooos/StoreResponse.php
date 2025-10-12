<?php

/** --------------------------------------------------------------------------------
 * This response renders the dom for a new row of a fooo record that was stored
 * This process is completed by the frontend JavaScript framework for dom manipulation
 * 
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Fooos;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }


    /**
     * process a response and save it into a json object that will be sent back to the frontend for final rendering
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //payload that will be sent to the frontend
        $jsondata = [];

        //set all data that came from the controller into variables to use in compact()
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //if this is the first fooo in the database then render the entire table
        if ($count == 1) {
            $html = view('pages/fooos/components/table/table', compact('fooos'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#fooos-table-wrapper',
                'action' => 'replace',
                'value' => $html);
        } else {
            //if this is an additional fooo record, render just the new row for appending to the existing table that is already in view
            $html = view('pages/fooos/components/table/ajax', compact('fooos'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#fooos-td-container',
                'action' => 'prepend',
                'value' => $html);
        }

        //trigger the modal window to close
        $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

        //dsiplay any popup notifications
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //send response to the ajax request that triggered this request
        return response()->json($jsondata);
    }

}
