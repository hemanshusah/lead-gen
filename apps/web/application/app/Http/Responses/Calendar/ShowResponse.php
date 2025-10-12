<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [create] process for the fooo
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Calendar;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for fooo members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        config(['response' => 'show']);

        //render the form
        $html = view('pages/calendar/components/modals/show', compact('page', 'event', 'users', 'sharing'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#commonModalBody',
            'action' => 'replace',
            'value' => $html);

        //show modal foooter
        $jsondata['dom_visibility'][] = array('selector' => '#commonModalFooter', 'action' => 'hide');

        // POSTRUN FUNCTIONS------
        $jsondata['postrun_functions'][] = [
            'value' => 'NXCalendarCreate',
        ];
        $jsondata['postrun_functions'][] = [
            'value' => 'NXMultipleFileUpload',
        ];

        //ajax response
        return response()->json($jsondata);

    }

}
