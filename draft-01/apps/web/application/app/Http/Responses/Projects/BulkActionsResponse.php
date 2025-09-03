<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Projects;
use Illuminate\Contracts\Support\Responsable;

class BulkActionsResponse implements Responsable {

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

        //initialize the JSON data
        $jsondata = [];

        //response action is archive or restore
        if (in_array($response, ['archive', 'restore', 'update-progress', 'stop-timers'])) {

            //update each row using the ajax blade files
            //for both list and card view
            foreach ($allrows as $projects) {
                foreach ($projects as $project) {
                    //card view - render the each row
                    $html = view('pages.projects.views.cards.layout.ajax', compact('projects'))->render();
                    $jsondata['dom_html'][] = array(
                        'selector' => '#project_' . $project->project_id,
                        'action' => 'replace-with',
                        'value' => $html
                    );

                    //list view - render the each row
                    $html = view('pages.projects.views.list.table.ajax', compact('projects'))->render();
                    $jsondata['dom_html'][] = array(
                        'selector' => '#project_' . $project->project_id,
                        'action' => 'replace-with',
                        'value' => $html
                    );
                }
            }

            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');
            
            //close actions modal
            $jsondata['dom_visibility'][] = array('selector' => '#actionsModal', 'action' => 'close-modal');
            
            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

            //response
            return response()->json($jsondata);
        }

        //default reponse
        return response()->json($jsondata);
    }

}