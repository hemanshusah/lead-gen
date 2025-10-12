<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the KB
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\knowledgebase;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for knowledgebase
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //searching
        if (request()->ajax() && request('action') == 'search') {
            $html = view('pages/knowledgebase/components/table/table', compact('page', 'knowledgebase', 'categories', 'category'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#knowledgebase-table-wrapper',
                'action' => 'replace',
                'value' => $html,
            ];
            return response()->json($jsondata);
        }

        return view('pages/knowledgebase/wrapper', compact('page', 'knowledgebase', 'categories', 'category'))->render();

    }

}
