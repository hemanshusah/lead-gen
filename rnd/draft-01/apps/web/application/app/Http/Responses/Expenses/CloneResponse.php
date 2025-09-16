<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [clone] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Expenses;
use Illuminate\Contracts\Support\Responsable;

class CloneResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for projects
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //render the form
        if ($type == 'form') {
            $html = view('pages/expenses/components/modals/clone', compact('expense', 'categories'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#commonModalBody',
                'action' => 'replace',
                'value' => $html);

            //show modal projectter
            $jsondata['dom_visibility'][] = array('selector' => '#commonModalFooter', 'action' => 'show');
        }

        //success
        if ($type == 'store') {
            $html = view('pages/expenses/components/table/ajax', compact('expenses'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#expenses-td-container',
                'action' => 'append',
                'value' => $html);
            $jsondata['notification'] = [
                'type' => 'success',
                'value' => __('lang.request_has_been_completed'),
            ];
            $jsondata['dom_visibility'][] = [
                'selector' => '#commonModal', 'action' => 'close-modal',
            ];
        }

        //ajax response
        return response()->json($jsondata);
    }
}