<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [import checklist] process for the checklists
 * controller
 * @package   Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Checklists;
use Illuminate\Contracts\Support\Responsable;

class ImportChecklistResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for checklist import
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set mode - for use in frontend
        config(['response.import' => true]);

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        $payload = $this->payload;

        //replace checklists content
        if (isset($checklists)) {
            $html = view('pages.checklists.checklists', compact('checklists', 'can_manage_checklists'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#global-checklist-container',
                'action' => 'replace-with',
                'value' => $html);
        }

        // postrun function
        $jsondata['postrun_functions'][] = [
            'value' => 'NXChecklistDragDrop',
        ];

        //response
        return response()->json($jsondata);
    }

}