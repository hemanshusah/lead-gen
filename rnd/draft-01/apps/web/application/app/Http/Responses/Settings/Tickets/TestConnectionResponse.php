<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [move] process for the tickets settings
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Settings\Tickets;
use Illuminate\Contracts\Support\Responsable;

class TestConnectionResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for sources
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //notice error
        if ($result['status'] === true) {
            $jsondata['notification'] = [
                'type' => 'success',
                'value' => __('lang.imap_connection_passed'),
            ];
        } else {
            $jsondata['notification'] = [
                'type' => 'error_clear_last',
                'value' => $result['message'] ?? __('lang.imap_connection_failed_general') . ' - ' . __('lang.hello'),
            ];
        }

        $jsondata['skip_dom_reset'] = true;

        //ajax response
        return response()->json($jsondata);
    }

}
