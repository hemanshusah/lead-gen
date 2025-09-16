<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [edit] process for the proposals
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Proposals;
use Illuminate\Contracts\Support\Responsable;

class UpdateAutomationResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for proposals
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        if (request('ref') == 'list') {
            $html = view('pages/proposals/components/table/ajax', compact('proposals', 'page'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => "#proposal_" . $proposal->doc_id,
                'action' => 'replace-with',
                'value' => $html);
        }

        if ($proposal->proposal_automation_status == 'enabled') {
            $jsondata['dom_visibility'][] = [
                'selector' => '#proposal-automation-icon',
                'action' => 'show',
            ];
        } else {
            $jsondata['dom_visibility'][] = [
                'selector' => '#proposal-automation-icon',
                'action' => 'hide',
            ];
        }

        //close modals
        $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

        //ajax response
        return response()->json($jsondata);
    }

}
