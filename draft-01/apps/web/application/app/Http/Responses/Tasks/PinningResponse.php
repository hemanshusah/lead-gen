<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the tasks
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Tasks;
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
        if (auth()->user()->pref_view_tasks_layout == 'list' && in_array($status, ['pin', 'unpin'])) {
            $jsondata['dom_move_element'][] = array(
                'element' => "#task_$task_id",
                'newparent' => '#tasks-td-container',
                'method' => ($status == 'pin') ? 'prepend' : 'append',
                'visibility' => 'show');
            $jsondata['dom_classes'][] = [
                'selector' => "#task_$task_id",
                'action' => ($status == 'pin') ? 'add' : 'remove',
                'value' => 'pinned',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => "#task_$task_id",
                'action' => 'remove',
                'value' => 'disabled-content',
            ];
        }

        //update cards view
        if (auth()->user()->pref_view_tasks_layout == 'kanban' && in_array($status, ['pin', 'unpin'])) {
            $jsondata['dom_move_element'][] = array(
                'element' => "#card_task_$task_id",
                'newparent' => '#kanban-board-wrapper-' . $task->task_status,
                'method' => ($status == 'pin') ? 'prepend' : 'append',
                'visibility' => 'show');
            $jsondata['dom_classes'][] = [
                'selector' => "#card_task_$task_id",
                'action' => ($status == 'pin') ? 'add' : 'remove',
                'value' => 'pinned',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => "#card_task_$task_id",
                'action' => 'remove',
                'value' => 'disabled-content',
            ];
        }

        //response
        return response()->json($jsondata);
    }

}
