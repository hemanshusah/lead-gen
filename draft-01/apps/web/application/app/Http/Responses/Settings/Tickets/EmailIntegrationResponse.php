<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the tickets settings
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Settings\Tickets;
use Illuminate\Contracts\Support\Responsable;

class EmailIntegrationResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for tickets
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //show the form
        if ($response == 'show') {
            $html = view('pages/settings/sections/tickets/email/page', compact('page', 'settings'))->render();

            $jsondata['dom_html'][] = array(
                'selector' => "#settings-wrapper",
                'action' => 'replace',
                'value' => $html);
        }

        //form submitted
        if ($response == 'update') {
            $jsondata['notification'] = [
                'type' => 'success',
                'value' => __('lang.request_has_been_completed'),
            ];
            $jsondata['skip_dom_reset'] = true;
        }


        //left menu activate
        if (request('url_type') == 'dynamic') {
            $jsondata['dom_attributes'][] = [
                'selector' => '#settings-menu-tickets',
                'attr' => 'aria-expanded',
                'value' => false,
            ];
            $jsondata['dom_action'][] = [
                'selector' => '#settings-menu-tickets',
                'action' => 'trigger',
                'value' => 'click',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => '#settings-menu-tickets-emailintegration',
                'action' => 'add',
                'value' => 'active',
            ];
        }


        //ajax response
        return response()->json($jsondata);
    }
}
