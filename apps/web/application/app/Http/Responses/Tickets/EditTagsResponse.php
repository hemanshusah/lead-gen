<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the files
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Tickets;
use Illuminate\Contracts\Support\Responsable;

class EditTagsResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for files
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
        if ($response == 'edit') {

            $html = view('pages/tickets/components/modals/edit-tags', compact('tags', 'current_tags', 'ticket'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#commonModalBody',
                'action' => 'replace',
                'value' => $html,
            ];
            return response()->json($jsondata);
        }

        //action reposed
        if ($response == 'update') {

            //close modal
            $jsondata['dom_visibility'][] = [
                'selector' => '#commonModal', 'action' => 'close-modal',
            ];

            //notice error
            $jsondata['notification'] = [
                'type' => 'success',
                'value' => __('lang.request_has_been_completed'),
            ];

            $html = view('pages/tickets/components/table/ajax', compact('tags', 'tickets'))->render();
            $jsondata['dom_html'][] = [
                'selector' => "#ticket_$id",
                'action' => 'replace-with',
                'value' => $html,
            ];

            //if redirecting
            if (request('action') == 'redirect') {
                $jsondata['redirect_url'] = url("tickets/$id");
            }

            return response()->json($jsondata);
        }

    }

}
