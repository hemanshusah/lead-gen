<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [create] process for the fooo
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Calendar;
use Illuminate\Contracts\Support\Responsable;

class DeleteFileResponse implements Responsable {

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

        $jsondata['dom_visibility'][] = [
            'selector' => '.event_file_' . $file_uniqueid,
            'action' => 'hide',
        ];

        //ajax response
        return response()->json($jsondata);

    }

}
