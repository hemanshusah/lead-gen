<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for billing tasks to an invoice
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Invoices;
use Illuminate\Contracts\Support\Responsable;

class TaskBillingResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for invoices
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //render the view
        $html = view('pages/bill/components/modals/bill-tasks-table', compact('tasks', 'project'))->render();

        //update the modal body
        $jsondata['dom_html'][] = [
            'selector' => '#tasksModalBody',
            'action' => 'replace',
            'value' => $html,
        ];

        //ajax response
        return response()->json($jsondata);
    }

}