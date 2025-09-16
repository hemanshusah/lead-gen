<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [importChecklists] process for the leads
 * controller
 * @package   Grow CRM
 * @author    NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Leads;
use Illuminate\Contracts\Support\Responsable;

class ImportChecklistResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the response for importing checklists
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set mode - for use in frontend
        config(['response.import_checklist' => true]);

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        config(['response.import' => true]);

        //check if import was successful
        if ($import_results['success']) {

            //render updated checklists
            $html = view('pages.lead.components.checklists', compact('checklists', 'progress', 'lead'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#card-checklist',
                'action' => 'replace-with',
                'value' => $html,
            ];

            //update lead card indicators (if any)
            if ($lead->has_checklist) {
                $jsondata['dom_visibility'][] = [
                    'selector' => "#kanban_lead_checklist_icon_{$lead->lead_id}",
                    'action' => 'show',
                ];
            }

            //close modal
            $jsondata['dom_visibility'][] = [
                'selector' => '#commonModal',
                'action' => 'close-modal',
            ];

            //show success notification
            $jsondata['notification'] = [
                'type' => 'success',
                'value' => $import_results['message'],
            ];

            // postrun function
            $jsondata['postrun_functions'][] = [
                'value' => 'nxChecklistFileUpload',
            ];

            //drag and drop checklist itens
            $jsondata['postrun_functions'][] = [
                'value' => 'NXChecklistDragDrop',
            ];

        } else {
            //show error notification
            $jsondata['notification'] = [
                'type' => 'error',
                'value' => $import_results['message'],
            ];
        }

        //response
        return response()->json($jsondata);
    }
}