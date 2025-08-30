<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [checklist] process for the checklists
 * controller
 * @package   Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Checklists;
use Illuminate\Contracts\Support\Responsable;

class ChecklistResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for checklist actions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set mode - for use in frontend
        config(['response.checklist' => true]);

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        $payload = $this->payload;

        //update progress bar
        if (isset($progress)) {
            $jsondata['dom_html'][] = array(
                'selector' => '#card-checklist-progress',
                'action' => 'replace',
                'value' => $progress['completed']);

                $html = view('pages.checklists.progressbar', compact('progress'))->render();
                $jsondata['dom_html'][] = array(
                    'selector' => '#card-checklist-progress-bar',
                    'action' => 'replace-with',
                    'value' => $html);
        }

        //hide and remove deleted checklist item
        if (isset($action) && $action == 'delete' && isset($checklistid)) {
            $jsondata['dom_visibility'][] = array(
                'selector' => "#checklist_container_$checklistid",
                'action' => 'slideup-slow-remove',
            );
        }

        //response
        return response()->json($jsondata);
    }

}