<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [importChecklists] process for the tasks
 * controller
 * @package   Grow CRM
 * @author    NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Tasks;
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

        // Set mode - for use in frontend
        config(['response.import_checklist' => true]);

        // Set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        config(['response.import' => true]);

        // Check if import was successful
        if ($import_results['success']) {

            // Render updated checklists
            $html = view('pages.task.components.checklists', compact('checklists', 'progress', 'task'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#card-checklist',
                'action' => 'replace-with',
                'value' => $html,
            ];

            // Update task card indicators (if any)
            if ($task->has_checklist) {
                $jsondata['dom_visibility'][] = [
                    'selector' => "#kanban_task_checklist_icon_{$task->task_id}",
                    'action' => 'show',
                ];
            }

            // Close modal
            $jsondata['dom_visibility'][] = [
                'selector' => '#commonModal',
                'action' => 'close-modal',
            ];

            // Success notification
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

            // Error notification
            $jsondata['notification'] = [
                'type' => 'error',
                'value' => $import_results['message'],
            ];
        }

        // Return AJAX response
        return response()->json($jsondata);
    }
}