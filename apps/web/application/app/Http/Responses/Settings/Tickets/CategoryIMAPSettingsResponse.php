<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the tickets settings
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Settings\Tickets;
use Illuminate\Contracts\Support\Responsable;

class CategoryIMAPSettingsResponse implements Responsable {

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
            $html = view('pages/settings/sections/tickets/email/modals/category', compact('category', 'settings'))->render();

            $jsondata['dom_html'][] = array(
                'selector' => "#commonModalBody",
                'action' => 'replace',
                'value' => $html);
        }

        //form submitted
        if ($response == 'update') {
            $jsondata['redirect_url'] = url('app/categories?filter_category_type=ticket&source=ext');
        }

        //ajax response
        return response()->json($jsondata);
    }
}
