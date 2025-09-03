<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the checklists
 * controller
 * @package   Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Checklists;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for checklists
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set mode - for use in frontend
        config(['response.index' => true]);

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        $payload = $this->payload;

        //dynamic ajax response
        if (request()->ajax()) {

            $html = view('pages.checklists.checklists', compact('checklists', 'progress', 'can_manage_checklists'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#embed-content-container',
                'action' => 'replace',
                'value' => $html,
            ];

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

            //skip dom reset
            $jsondata['skip_dom_reset'] = true;

            // postrun function
            $jsondata['postrun_functions'][] = [
                'value' => 'nxChecklistFileUpload',
            ];

            // postrun function
            $jsondata['postrun_functions'][] = [
                'value' => 'NXChecklistDragDrop',
            ];

            //ajax response
            return response()->json($jsondata);
        }

        //main view
        return view('pages.checklists.checklists', compact('checklists', 'progress'))->render();
    }
}