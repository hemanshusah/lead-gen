<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the projects
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Projects;
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

        //default
        $jsondata = [];

        //move item to the top of the list
        if (auth()->user()->pref_view_projects_layout == 'list' && in_array($status, ['pin', 'unpin'])) {
            $jsondata['dom_move_element'][] = array(
                'element' => "#project_$project_id",
                'newparent' => '#projects-td-container',
                'method' => ($status == 'pin') ? 'prepend' : 'append',
                'visibility' => 'show');
        }

        //update cards view
        if (auth()->user()->pref_view_projects_layout == 'card' && in_array($status, ['pin', 'unpin'])) {
            $jsondata['dom_move_element'][] = array(
                'element' => "#project_$project_id",
                'newparent' => '#projects-cards-container',
                'method' => ($status == 'pin') ? 'prepend' : 'append',
                'visibility' => 'show');
        }

        //final actions
        $jsondata['dom_classes'][] = [
            'selector' => "#project_$project_id",
            'action' => ($status == 'pin') ? 'add' : 'remove',
            'value' => 'pinned',
        ];
        $jsondata['dom_classes'][] = [
            'selector' => "#project_$project_id",
            'action' => 'remove',
            'value' => 'disabled-content',
        ];

        //response
        return response()->json($jsondata);
    }

}
