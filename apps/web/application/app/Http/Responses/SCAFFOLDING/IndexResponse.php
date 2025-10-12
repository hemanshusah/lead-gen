<?php

/** --------------------------------------------------------------------------------
 * [EXAMPLE] Response Class for showing a list of resources and various ajax responses
 * for search, load more, etc
 * controller
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
     * show a list of fooos in the dom. Depening on the type or request, either render teh whole table or just append an item to the list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //if this was an ajax call:
        if (request('source') == 'ext' || request('action') == 'search' || request()->ajax()) {

            //what type of call was this request
            switch (request('action')) {

            //load - typically used with the 'load more' button - just append a resource to the list
            case 'load':
                $template = 'pages/fooos/components/table/ajax';
                $dom_container = '#fooo-td-container';
                $dom_action = 'append';
                break;

            //from the sorting links on the table - replace all rows in the table with newly sorted rows
            case 'sort':
                $template = 'pages/fooos/components/table/ajax';
                $dom_container = '#fooo-td-container';
                $dom_action = 'replace';
                break;

            //from search box or filter panel - render the whole table afresh
            case 'search':
                $template = 'pages/fooos/components/table/table';
                $dom_container = '#fooo-table-wrapper';
                $dom_action = 'replace-with';
                break;

            //this is typically the view when the page first loads (if requested via ajax)
            default:
                $template = 'pages/fooos/tabswrapper';
                $dom_container = '#embed-content-container';
                $dom_action = 'replace';
                break;
            }

            //load more button - change the page number and determine buttons visibility after this load
            if ($fooos->currentPage() < $fooos->lastPage()) {
                $url = loadMoreButtonUrl($fooos->currentPage() + 1, request('source'));
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

            //flip sorting url for this particular link - only is we clicked sort menu links
            if (request('action') == 'sort') {
                $sort_url = flipSortingUrl(request()->fullUrl(), request('sortorder'));
                $element_id = '#sort_' . request('orderby');
                $jsondata['dom_attributes'][] = array(
                    'selector' => $element_id,
                    'attr' => 'data-url',
                    'value' => $sort_url);
            }

            //render the view and add it to the dom
            $html = view($template, compact('page', 'fooos'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => $dom_container,
                'action' => $dom_action,
                'value' => $html);

            //for embedded - change breadcrumb title (optional)
            $jsondata['dom_html'][] = [
                'selector' => '.active-bread-crumb',
                'action' => 'replace',
                'value' => strtoupper(__('lang.fooo')),
            ];

            //ajax response
            return response()->json($jsondata);

        } else {

            //standard view - this was not an ajax call, just render the page as normal - start by creating load more button
            $page['url'] = loadMoreButtonUrl($fooos->currentPage() + 1, request('source'));
            $page['loading_target'] = 'fooo-td-container';
            $page['visibility_show_load_more'] = ($fooos->currentPage() < $fooos->lastPage()) ? true : false;

            //show the page
            return view('pages/fooos/wrapper', compact('page', 'fooos'))->render();

        }

    }

}
