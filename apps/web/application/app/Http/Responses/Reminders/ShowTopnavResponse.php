<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [create] process for the reminder
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Reminders;
use Illuminate\Contracts\Support\Responsable;

class ShowTopnavResponse implements Responsable {

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

        $payload = $this->payload;

        //show reminders
        $html = view('pages/reminders/topnav/reminder', compact('reminders'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#sidepanel-reminders-container',
            'action' => 'replace',
            'value' => $html);

        //reset sidepanel menus active status
        $jsondata['dom_classes'][] = [
            'selector' => '.right-sidepanel-reminders-menu',
            'action' => 'remove',
            'value' => 'active',
        ];
        $jsondata['dom_classes'][] = [
            'selector' => '#sidepanel-reminders-container',
            'action' => 'remove',
            'value' => 'due',
        ];
        $jsondata['dom_classes'][] = [
            'selector' => '#sidepanel-reminders-container',
            'action' => 'remove',
            'value' => 'active',
        ];

        //set correct sidepanel menu as active
        if ($status == 'due') {
            $jsondata['dom_classes'][] = [
                'selector' => '#right-sidepanel-reminders-menu-due',
                'action' => 'add',
                'value' => 'active',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => '#sidepanel-reminders-container',
                'action' => 'add',
                'value' => 'due',
            ];
        } else {
            $jsondata['dom_classes'][] = [
                'selector' => '#right-sidepanel-reminders-menu-active',
                'action' => 'add',
                'value' => 'active',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => '#sidepanel-reminders-container',
                'action' => 'add',
                'value' => 'active',
            ];
        }

        //do we have reminders - remove highlight from topnav icon
        if ($count_due == 0) {
            $jsondata['dom_classes'][] = [
                'selector' => '#topnav-reminders-icon',
                'action' => 'remove',
                'value' => 'due',
            ];
        }

        //ajax response
        return response()->json($jsondata);

    }

}
