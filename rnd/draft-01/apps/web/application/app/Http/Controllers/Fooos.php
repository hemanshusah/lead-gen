<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for template
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fooo\StoreUpdate;
use App\Http\Responses\Fooos\CreateResponse;
use App\Http\Responses\Fooos\DestroyResponse;
use App\Http\Responses\Fooos\EditResponse;
use App\Http\Responses\Fooos\IndexResponse;
use App\Http\Responses\Fooos\ShowResponse;
use App\Http\Responses\Fooos\StoreResponse;
use App\Http\Responses\Fooos\UpdateResponse;
use App\Repositories\FoooRepository;
use Illuminate\Http\Request;

class Fooos extends Controller {

    /**
     * The fooo repository instance.
     */
    protected $foorepo;

    public function __construct(FoooRepository $foorepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        //use middleware to check user permissions for this methods
        $this->middleware('fooosMiddlewareIndex')->only([
            'index',
            'create',
            'store',
            'update',
        ]);

        //use middleware to check user permissions for this methods
        $this->middleware('fooosMiddlewareEdit')->only([
            'edit',
            'update',
        ]);

        //use middleware to check user permissions for this methods
        $this->middleware('fooosMiddlewareCreate')->only([
            'create',
            'store',
        ]);

        //use middleware to check user permissions for this methods
        $this->middleware('fooosMiddlewareDestroy')->only([
            'destroy',
        ]);

        $this->foorepo = $foorepo;
    }

    /**
     * Fetch a list of fooos from the database.
     * @return blade view | ajax view
     */
    public function index() {

        //get the fooos using the repository
        $fooos = $this->foorepo->search();

        //payload for generating a response
        $payload = [
            'page' => $this->pageSettings('index'),
            'fooos' => $fooos,
        ];

        //process reponse
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new fooo.
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
        ];

        //process reponse
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created fooo in the database
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdate $request) {

        //create a new fooo
        $fooo = new \App\Models\Fooo();
        $fooo->fooo_creatorid = auth()->id();
        $fooo->bar = request('bar');
        $fooo->save();

        //count all of fooos (do the count here)
        $count = \App\Models\Fooo::count();

        //intentionally fetch the single created fooo from the datase as 'rows' for use in the foreach loop
        $fooos = $this->foorepo->search($fooo->fooo_id);

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('store'),
            'fooos' => $fooos,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    /**
     * Display the specified fooo.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        //get the fooo using the repository search method
        $fooo = $this->foorepo->search($id);
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
     * Show the form for editing the specified fooo
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //get the fooo (validation is middleware)
        $fooo = \App\Models\Fooo::Where('fooo_id', $id)->first();

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

        //get the fooo (validation is middleware)
        $fooo = \App\Models\Fooo::Where('fooo_id', $id)->first();

        //update
        $fooo->bar = request('bar');
        $fooo->save();

        //intentionally fetch the single created fooo from the datase as 'rows' for use in the foreach loop
        $fooos = $this->foorepo->search($id);

        //reponse payload
        $payload = [
            'fooos' => $fooos,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Delete the fooo(s) from the supplied id's and remove them from the page view
     * @return \Illuminate\Http\Response
     */
    public function destroy() {

        //an arary to store the list of deleted fooos
        $allrows = array();

        //loop through the list of ids and delete the fooos
        foreach (request('ids') as $id => $value) {
            //only the items that were checked
            if ($value == 'on') {
                if ($fooo = \App\Models\Fooo::Where('fooo_id', $id)->first()) {
                    //delete the foo
                    $fooo->delete();
                }
                //add this foo to the array list
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
     * frontdend page elements specific to fooos
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //common settings that are always needed
        $page = [
            'crumbs' => [
                __('lang.fooos'),
            ],
            'meta_title' => __('lang.fooos'),
            'heading' => __('lang.fooos'),
            'page' => 'fooos',
            'mainmenu_fooos' => 'active',
            'load_more_button_route' => 'fooos',
            'source' => 'list',
        ];

        //return
        return $page;
    }
}