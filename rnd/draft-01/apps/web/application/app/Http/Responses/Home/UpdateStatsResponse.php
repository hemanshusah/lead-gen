<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the projects
 * controller
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Home;
use Illuminate\Contracts\Support\Responsable;

class UpdateStatsResponse implements Responsable {

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

        $payload = $this->payload;



        if ($response == 'admin-income-expenses-chart') {

            //set response config
            config(['response.show' => true]);
            config(['response.redirect' => false]);
            config(['response.ajax' => true]);

            //render updated chart view
            $html = view('pages/home/admin/widgets/second-row/income', compact('payload'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#dashboard-admin-invoice-vs-expenses',
                'action' => 'replace-with',
                'value' => $html,
            ];

            //response
            return response()->json($jsondata);
        }

    }

}