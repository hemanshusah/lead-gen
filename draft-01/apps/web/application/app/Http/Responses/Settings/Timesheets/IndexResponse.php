<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the timesheet settings
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Settings\Timesheets;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for timesheets
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        $html = view('pages/settings/sections/timesheets/page', compact('page', 'settings'))->render();

        $jsondata['dom_html'][] = array(
            'selector' => "#settings-wrapper",
            'action' => 'replace',
            'value' => $html);

        //left menu activate
        if (request('url_type') == 'dynamic') {
            $jsondata['dom_attributes'][] = [
                'selector' => '#settings-menu-timesheets',
                'attr' => 'aria-expanded',
                'value' => false,
            ];
            $jsondata['dom_action'][] = [
                'selector' => '#settings-menu-timesheets',
                'action' => 'trigger',
                'value' => 'click',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => '#settings-menu-timesheets-general',
                'action' => 'add',
                'value' => 'active',
            ];
        }

        // POSTRUN FUNCTIONS------
        $jsondata['postrun_functions'][] = [
            'value' => 'NXSettingsTimesheets',
        ];

        //ajax response
        return response()->json($jsondata);
    }
}
