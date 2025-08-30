<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store/destroy checklist comment] process for the tasks
 * controller
 * @package   SaaS Platform
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Tasks;
use Illuminate\Contracts\Support\Responsable;

class ChecklistCommentsResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for checklist comment operations
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

        //store comment response
        if ($response == 'store') {
            
            //set mode - for use in frontend
            config(['response.store' => true]);

            //render the new comment
            $html = view('pages.task.components.checklist-comment', compact('comment'))->render();
            
            //append the new comment to the comments list
            $jsondata['dom_html'][] = array(
                'selector' => '#checklist-comments-list-wrapper-' . $checklist_id,
                'action' => 'prepend',
                'value' => $html);

            //clear the comment textarea
            $jsondata['dom_val'][] = array(
                'selector' => '#checklist-comments-textarea-' . $checklist_id,
                'value' => '');

            //hide the comment form
            $jsondata['dom_visibility'][] = array(
                'selector' => '#checklist-comments-textarea-wrapper-' . $checklist_id, 
                'action' => 'hide');
        }

        //delete comment response
        if ($response == 'delete') {
            
            //set mode - for use in frontend
            config(['response.destroy' => true]);

            //hide and remove the deleted comment
            $jsondata['dom_visibility'][] = array(
                'selector' => '#checklist_comment_' . $comment_id,
                'action' => 'slideup-slow-remove',
            );
        }

        //notice
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //response
        return response()->json($jsondata);
    }
}