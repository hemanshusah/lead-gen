<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the fooo
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Calendar;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable {

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

        //visibility
        config(['visibility.calendarjs' => true]);

        //update request from filter panel
        if (request('calendar_action') == 'user-preferences') {
            $jsondata['redirect_url'] = url('/calendar');
            //ajax response
            return response()->json($jsondata);
        }

        return view('pages/calendar/wrapper', compact('page', 'events', 'data'))->render();

    }

}
