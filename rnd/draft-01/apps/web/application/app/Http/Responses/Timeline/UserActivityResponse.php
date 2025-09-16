<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the timeline
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Timeline;
use Illuminate\Contracts\Support\Responsable;

class UserActivityResponse implements Responsable {

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

        /** ---------------------------------------------------------------------------------------------
         * [todo]
         * 1. this file is mostly done. We are loading the events timeline inside the modal window
         * 2. We will use existing timeline blade views
         * 3. Do not edit or later existing timeline views
         * ---------------------------------------------------------------------------------------------*/

        //has this call been made from an embedded page/ajax or directly on timeline page
        if (request()->ajax()) {

            //we are loading additional pages/content
            if (request('action') == 'load') {
                $template = 'pages/timeline/components/misc/ajax';
                $dom_container = '#timeline-container';
                $dom_action = 'append';
            } else {
                //this is the initial load
                $template = 'pages/timeline/timeline';
                $dom_container = '#commonModalBody';
                $dom_action = 'replace';
            }

            //load more button - change the page number and determine buttons visibility
            if ($events->currentPage() < $events->lastPage()) {
                $url = loadMoreButtonUrl($events->currentPage() + 1, request('source'));
                $jsondata['dom_attributes'][] = array(
                    'selector' => '#load-more-button',
                    'attr' => 'data-url',
                    'value' => $url);
                //load more - visible
                $jsondata['dom_visibility'][] = array('selector' => '.loadmore-button-container', 'action' => 'show');
                //load more: (intial load - sanity)
                $page['visibility_show_load_more'] = true;
                $page['url'] = $url;
            } else {
                $jsondata['dom_visibility'][] = array('selector' => '.loadmore-button-container', 'action' => 'hide');
            }

            //render the view and save to json
            $html = view($template, compact('page', 'events'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => $dom_container,
                'action' => $dom_action,
                'value' => $html);

            return response()->json($jsondata);

        }
    }
}