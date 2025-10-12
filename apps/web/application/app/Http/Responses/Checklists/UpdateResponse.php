<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update checklist] process for the checklists
 * controller
 * @package   Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Checklists;
use Illuminate\Contracts\Support\Responsable;

class UpdateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for updating checklists
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set mode - for use in frontend
        config(['response.update' => true]);

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        $payload = $this->payload;

        //replace the specific checklist item
        if (isset($checklists) && $checklists->count() > 0) {
            $checklist = $checklists->first();
            $html = view('pages.checklists.checklists', compact('checklists'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#checklist_container_" . $checklist->checklist_id,
                'action' => 'replace-with',
                'value' => $html);
        }

        //show success notification
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //response
        return response()->json($jsondata);
    }

}