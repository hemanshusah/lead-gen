<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the starred
 * controller
 * @package    CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Starred;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for starred
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //show project comments
        if ($response == 'project-comments') {
            $html = view('pages/starred/project_comments/list', compact('projects'))->render();
        }

        //now notes
        if ($response == 'notes') {
            //render the notes list
            $html = view('pages/starred/notes/list', compact('notes'))->render();
        }

        //clients
        if ($response == 'clients') {
            //render the clients list
            $html = view('pages/starred/clients/list', compact('clients'))->render();
        }

        //projects
        if ($response == 'projects') {
            //render the projects list
            $html = view('pages/starred/project/list', compact('projects'))->render();
        }

        //tasks
        if ($response == 'tasks') {
            //render the tasks list
            $html = view('pages/starred/tasks/list', compact('tasks'))->render();
        }

        //render the list
        $jsondata['dom_html'][] = array(
            'selector' => '#sidepanel-starred-container',
            'action' => 'replace',
            'value' => $html);

        //response
        return response()->json($jsondata);

    }

}