<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [create] process for the reminder
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Reminders;
use Illuminate\Contracts\Support\Responsable;

class DeleteReminderResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for reminder members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //do we have reminders - remove highlight from topnav icon
        if ($count_due == 0) {
            $jsondata['dom_classes'][] = [
                'selector' => '#topnav-reminders-icon',
                'action' => 'remove',
                'value' => 'due',
            ];
            //ajax response
            return response()->json($jsondata);
        }

    }

}
