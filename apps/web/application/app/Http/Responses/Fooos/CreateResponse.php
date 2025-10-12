<?php

/** --------------------------------------------------------------------------------
 * This response renders the dom form for creating a new fooo.
 * The form will be added inside the modal window that is already open in the browser
 * This process is completed by the frontend JavaScript framework for dom manipulation
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Fooos;
use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable {

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

        //render the page (form) and add it to add it to the json object
        $html = view('pages/fooos/components/modals/add-edit-inc', compact('page'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html);

        //show modal footer with the submit button
        $jsondata['dom_visibility'][] = array('selector' => '#commonModalFoooter', 'action' => 'show');

        //trigger some javascript function to execute when dom in updated
        $jsondata['postrun_functions'][] = [
            'value' => 'NXFoooCreate',
        ];

        //send response to the ajax request that triggered this request
        return response()->json($jsondata);

    }

}
