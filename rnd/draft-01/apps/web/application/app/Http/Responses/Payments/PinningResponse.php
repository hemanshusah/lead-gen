<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the payments
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Payments;
use Illuminate\Contracts\Support\Responsable;

class PinningResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for team members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        $jsondata['dom_move_element'][] = array(
            'element' => "#payment_$payment_id",
            'newparent' => '#payments-td-container',
            'method' => ($status == 'pin') ? 'prepend' : 'append',
            'visibility' => 'show');

        //final actions
        $jsondata['dom_classes'][] = [
            'selector' => "#payment_$payment_id",
            'action' => ($status == 'pin') ? 'add' : 'remove',
            'value' => 'pinned',
        ];
        $jsondata['dom_classes'][] = [
            'selector' => "#payment_$payment_id",
            'action' => 'remove',
            'value' => 'disabled-content',
        ];

        //response
        return response()->json($jsondata);
    }

}
