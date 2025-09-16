<?php

/** --------------------------------------------------------------------------------
 * This response will send a list of fooos html element id's to be removed from the DOM.
 * This process is completed by the frontend JavaScript framework for dom manipulation
 * 
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Fooos;
use Illuminate\Contracts\Support\Responsable;

class DestroyResponse implements Responsable {

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

        //create an array of fooo html element id's that will be removed from the frontend
        foreach ($allrows as $id) {
            $jsondata['dom_visibility'][] = array(
                'selector' => '#fooo_' . $id,
                'action' => 'slideup-slow-remove',
            );
        }

        //trigger the modal window to close
        $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

        //dsiplay any popup notifications
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //send response to the ajax request that triggered this request
        return response()->json($jsondata);

    }

}
