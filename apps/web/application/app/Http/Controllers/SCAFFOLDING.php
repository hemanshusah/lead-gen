<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for template
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Fooos\CreateResponse;
use App\Http\Responses\Fooos\DestroyResponse;
use App\Http\Responses\Fooos\EditResponse;
use App\Http\Responses\Fooos\IndexResponse;
use App\Http\Responses\Fooos\StoreResponse;
use App\Http\Responses\Fooos\UpdateResponse;
use App\Http\Responses\Fooos\ShowResponse;
use App\Repositories\FoooRepository;
use App\Http\Requests\Fooo\StoreUpdate;
use Illuminate\Http\Request;

class Fooos extends Controller {

    /**
     * The fooo repository instance.
     */
    protected $fooorepo;

    public function __construct(FoooRepository $fooorepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        $this->middleware('fooosMiddlewareIndex')->only([
            'index',
            'create',
            'store',
            'update',
        ]);

        $this->middleware('fooosMiddlewareEdit')->only([
            'edit',
            'update',
        ]);

        $this->middleware('fooosMiddlewareCreate')->only([
            'create',
            'store',
        ]);

        $this->middleware('fooosMiddlewareDestroy')->only([
            'destroy',
        ]);

        $this->fooorepo = $fooorepo;
    }

    /**
     * Display a listing of fooos
     * @url baseusr/fooos?page=1&source=ext&action=load
     * @urlquery
     *    - [page] numeric|null (pagination page number)
     *    - [source] ext|null  (ext: when called from embedded pages)
     *    - [action] load | null (load: when making additional ajax calls)
     * @return blade view | ajax view
     */
    public function index() {

        //get team members
        $fooos = $this->fooorepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('fooos'),
            'fooos' => $fooos,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
        ];

        //show the form
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdate $request) {

        //count rows
        $fooo = new \App\Models\Fooo();
        $fooo->bar = request('bar');
        $fooo->save();

        //count all rows
        $fooos = $this->fooosrepo->search();
        $count = count($fooos);

        //get the fooo object (friendly for rendering in blade template)
        $fooos = $this->fooorepo->search($$fooo->fooo_id);

        //reponse payload
        $payload = [
            'fooos' => $fooos,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    /**
     * Display the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        //get the fooo
        $fooo = $this->fooorepo->search($id);
        $fooo = $fooo->first();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'fooo' => $fooo,
        ];

        //response
        return new ShowResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //get the fooo
        $fooo = $this->fooorepo->search($id);
        $fooo = $fooo->first();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'fooo' => $fooo,
        ];

        //response
        return new EditResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdate $request, $id) {

        //get fooo
        $fooo = \App\Models\Fooo::Where('fooo_id', $id)->first();

        //update
        $fooo->bar = request('bar');
        $fooo->save();

        //get fooo
        $fooos = $this->fooorepo->search($id);

        //reponse payload
        $payload = [
            'fooos' => $fooos,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified item from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy() {

        //delete each record in the array
        $allrows = array();
        foreach (request('ids') as $id => $value) {
            //only checked fooos
            if ($value == 'on') {
                if ($fooo = \App\Models\Fooo::Where('fooo_id', $id)->first()) {
                    //delete client
                    $fooo->delete();
                }
                //add to array
                $allrows[] = $id;
            }
        }
        //reponse payload
        $payload = [
            'allrows' => $allrows,
        ];

        //generate a response
        return new DestroyResponse($payload);
    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.fooos'),
            ],
            'meta_title' => __('lang.fooos'),
            'heading' => __('lang.fooos'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'fooos',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_fooos' => 'active',
            'sidepanel_id' => 'sidepanel-filter-fooos',
            'dynamic_search_url' => url('fooos/search?action=search&foooresource_id=' . request('foooresource_id') . '&foooresource_type=' . request('foooresource_type')),
            'add_button_classes' => 'add-edit-fooo-button',
            'load_more_button_route' => 'fooos',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_new_fooo'),
            'add_modal_create_url' => url('fooos/create?foooresource_id=' . request('foooresource_id') . '&foooresource_type=' . request('foooresource_type')),
            'add_modal_action_url' => url('fooos?foooresource_id=' . request('foooresource_id') . '&foooresource_type=' . request('foooresource_type')),
            'add_modal_action_ajax_class' => 'js-ajax-ux-request',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //fooos list page
        if ($section == 'fooos') {
            $page += [
                'meta_title' => __('lang.fooos'),
                'heading' => __('lang.fooos'),
                'sidepanel_id' => 'sidepanel-filter-fooos',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //create new resource
        if ($section == 'create') {
            $page += [
                'section' => 'create',
            ];
            return $page;
        }

        //edit new resource
        if ($section == 'edit') {
            $page += [
                'section' => 'edit',
            ];
            return $page;
        }

        //return
        return $page;
    }
}