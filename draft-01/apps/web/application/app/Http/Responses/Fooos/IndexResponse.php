<?php

/** --------------------------------------------------------------------------------
 * This response renders the dom html content that will display a list of fooos
 * The page will be added to a specified section of the page that is aleady open in the browser
 * This process is completed by the frontend JavaScript framework for dom manipulation
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Fooos;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * process a response and save it into a json object that will be sent back to the frontend for final rendering
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //payload that will be sent to the frontend
        $jsondata = [];

        //set all data that came from the controller into variables to use in compact()
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //the initial request was via ajax
        if (request('source') == 'ext' || request('action') == 'search' || request()->ajax()) {

            //determine which blade template to use and dom element (dom_container) where the content will be rendered
            switch (request('action')) {

            //the initial request was from the 'load more' button. prepare new rows that will be appended to table that is already in view
            case 'load':
                $template = 'pages/fooos/components/table/ajax';
                $dom_container = '#fooo-td-container';
                $dom_action = 'append';
                break;

            //the initial was from the table sorting links. render a new list that will replace all the existing rows in the table that is already in view
            case 'sort':
                $template = 'pages/fooos/components/table/ajax';
                $dom_container = '#fooo-td-container';
                $dom_action = 'replace';
                break;

            //the request was from the search box or the filter panel. prepare a new table and completely replace the one already in the view
            case 'search':
                $template = 'pages/fooos/components/table/table';
                $dom_container = '#fooo-table-wrapper';
                $dom_action = 'replace-with';
                break;

            //all other request, just replace the entire page that is already in the view
            default:
                $template = 'pages/fooos/tabswrapper';
                $dom_container = '#embed-content-container';
                $dom_action = 'replace';
                break;
            }

            //render just the load more button, changing the page number. also determine if the button should show again (if more rows are still there)
            if ($fooos->currentPage() < $fooos->lastPage()) {
                //render the button, with updated URL
                $url = loadMoreButtonUrl($fooos->currentPage() + 1, request('source'));
                $jsondata['dom_attributes'][] = array(
                    'selector' => '#load-more-button',
                    'attr' => 'data-url',
                    'value' => $url);
                //load more - visibility
                $jsondata['dom_visibility'][] = array('selector' => '.loadmore-button-container', 'action' => 'show');
                //load more: (intial load - sanity)
                $page['visibility_show_load_more'] = true;
                $page['url'] = $url;
            } else {
                $jsondata['dom_visibility'][] = array('selector' => '.loadmore-button-container', 'action' => 'hide');
            }

            //if the request was for table sorting, flip the order of the particular link, so it will do teh opposit next time
            if (request('action') == 'sort') {
                $sort_url = flipSortingUrl(request()->fullUrl(), request('sortorder'));
                $element_id = '#sort_' . request('orderby');
                $jsondata['dom_attributes'][] = array(
                    'selector' => $element_id,
                    'attr' => 'data-url',
                    'value' => $sort_url);
            }

            //render the page final and add it to add it to the json object
            $html = view($template, compact('page', 'fooos'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => $dom_container,
                'action' => $dom_action,
                'value' => $html);

            //render the breadcrumbs section and replace it
            $jsondata['dom_html'][] = [
                'selector' => '.active-bread-crumb',
                'action' => 'replace',
                'value' => strtoupper(__('lang.fooo')),
            ];

            //send response to the ajax request that triggered this request
            return response()->json($jsondata);

        } else {
            //this was not an ajax request - render the page in the standard way

            //some data used by the frontend for pagination and showing the 'load more' button
            $page['url'] = loadMoreButtonUrl($fooos->currentPage() + 1, request('source'));
            $page['loading_target'] = 'fooo-td-container';
            $page['visibility_show_load_more'] = ($fooos->currentPage() < $fooos->lastPage()) ? true : false;

            //display the page
            return view('pages/fooos/wrapper', compact('page', 'fooos'))->render();
        }

    }

}
