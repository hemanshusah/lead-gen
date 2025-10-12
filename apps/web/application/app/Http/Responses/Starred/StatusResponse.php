<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [toggleStatus] process for the starred
 * controller
 * @package    CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Starred;
use Illuminate\Contracts\Support\Responsable;

class StatusResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the response for status toggle
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //toggle button visibility
        if ($action == 'star') {
            $jsondata['dom_visibility'][] = array('selector' => '#starred-star-button', 'action' => 'hide');
            $jsondata['dom_visibility'][] = array('selector' => '#starred-unstar-button', 'action' => 'show');
        } else {
            $jsondata['dom_visibility'][] = array('selector' => '#starred-unstar-button', 'action' => 'hide');
            $jsondata['dom_visibility'][] = array('selector' => '#starred-star-button', 'action' => 'show');
        }

        //for buttons with id's
        if ($action == 'star') {
            $jsondata['dom_visibility'][] = array('selector' => "#starred-star-button-$id", 'action' => 'hide');
            $jsondata['dom_visibility'][] = array('selector' => "#starred-unstar-button-$id", 'action' => 'show');
        } else {
            $jsondata['dom_visibility'][] = array('selector' => "#starred-unstar-button-$id", 'action' => 'hide');
            $jsondata['dom_visibility'][] = array('selector' => "#starred-star-button-$id", 'action' => 'show');
        }

        //response
        return response()->json($jsondata);

    }

}