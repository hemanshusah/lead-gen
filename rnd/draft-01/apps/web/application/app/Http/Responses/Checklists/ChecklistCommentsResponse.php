<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [checklist comments] process for the checklists
 * controller
 * @package   Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Checklists;
use Illuminate\Contracts\Support\Responsable;

class ChecklistCommentsResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for checklist comments
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set mode - for use in frontend
        config(['response.checklist_comments' => true]);

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        $payload = $this->payload;

        //render the comments
        $html = view('pages.checklists.checklist-comment', compact('checklist', 'checklist_id'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => "#checklist-comments-list-wrapper-$checklist_id",
            'action' => 'replace',
            'value' => $html);

        //clear comment textarea
        $jsondata['dom_val'][] = array(
            'selector' => "#checklist-comments-textarea-$checklist_id",
            'action' => 'replace',
            'value' => '');

        //show comments wrapper
        $jsondata['dom_visibility'][] = array(
            'selector' => "#checklist-comments-list-wrapper-$checklist_id",
            'action' => 'show');

        //hide textarea wrapper
        $jsondata['dom_visibility'][] = array(
            'selector' => "#checklist-comments-textarea-wrapper-$checklist_id",
            'action' => 'hide');

        //response
        return response()->json($jsondata);
    }

}