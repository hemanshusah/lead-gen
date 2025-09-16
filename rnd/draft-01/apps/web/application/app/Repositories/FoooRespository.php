<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for fooos
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Fooo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FoooRespository {

    /**
     * The fooo repository instance.
     */
    protected $fooo;

    /**
     * Inject dependecies
     */
    public function __construct(Fooo $fooo) {
        $this->fooo = $fooo;
    }

    /**
     * Search the fooo model. Joing user table and related tabled. Apply filter and sorting.
     * @param int $id optional for getting a single, specified record
     * @return object fooos collection
     */
    public function search($id = '') {

        $fooos = $this->fooo->newQuery();

        // all client fields
        $fooos->selectRaw('*');

        //joins
        $fooos->leftJoin('users', 'users.id', '=', 'fooos.fooo_creratorid');
        $fooos->leftJoin('others', 'others.other_id', '=', 'fooos.fooo_other_id');

        //default where
        $fooos->whereRaw("1 = 1");

        //a fooo id was supplied
        if (is_numeric($id)) {
            $fooos->where('fooo_id', $id);
        }

        //filters: by supplied value
        if (request()->filled('filter_fooo_example')) {
            $fooos->where('fooo_example', request('filter_fooo_example'));
        }

        //filter: minimum numeric value
        if (request()->filled('filter_fooo_example_value_min')) {
            $fooos->where('fooo_example_value', '>=', request('filter_fooo_example_value_min'));
        }

        //filter: maximum numeric value
        if (request()->filled('filter_fooo_example_value_max')) {
            $fooos->where('fooo_example_value', '>=', request('filter_fooo_example_value_max'));
        }

        //apply additional filters coming from search box
        if (request()->filled('search_query') || request()->filled('query')) {
            $fooos->where(function ($query) {
                $query->orWhere('fooo_example_text', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhereHas('others', function ($q) {
                    $q->where('other_name', 'LIKE', '%' . request('search_query') . '%');
                });
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('fooos', request('orderby'))) {
                $fooos->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
            case 'other_value':
                $fooos->orderBy('other_value', request('sortorder'));
                break;
            }
        } else {
            //default sorting
            $fooos->orderBy('fooo_id', 'desc');
        }

        //eager load
        $fooos->with([
            'bars',
        ]);

        // return the paginated results and return them.
        return $fooos->paginate(config('system.settings_system_pagination_limits'));
    }
}