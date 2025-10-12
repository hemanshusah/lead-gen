<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store checklist] process for the checklists
 * controller
 * @package   Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Checklists;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for storing checklists
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set mode - for use in frontend
        config(['response.store' => true]);

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }
        $payload = $this->payload;

        //append new checklist to the container
        if (isset($checklists)) {
            $html = view('pages.checklists.checklist', compact('checklists', 'can_manage_checklists'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#card-checklists-container',
                'action' => 'append',
                'value' => $html);
            $jsondata['dom_val'][] = [
                'selector' => '#checklist_text',
                'value' => '',
            ];
        }

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

        //clear the input field
        $jsondata['dom_val'][] = array(
            'selector' => '#card-checklist-text',
            'action' => 'replace',
            'value' => '');

        //hide the add form
        $jsondata['dom_visibility'][] = array(
            'selector' => '#card-checklist-add-new-wrapper',
            'action' => 'hide');

        //show the add button
        $jsondata['dom_visibility'][] = array(
            'selector' => '#card-checklist-add-new',
            'action' => 'show');

        //response
        return response()->json($jsondata);
    }

}