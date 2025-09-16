<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for templates
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Pinned;

class PinnedRepository {

    /**
     * The fooo repository instance.
     */
    protected $pinned;

    /**
     * Inject dependecies
     */
    public function __construct(Pinned $pinned) {
        $this->pinned = $pinned;
    }

    /**
     * pin or unpin a resource
     *
     * @return string the state of the elements whether it is now pinned or unpinned
     */
    public function togglePinned($resource_id = '', $resource_type = '') {

        if (!is_numeric($resource_id)) {
            return false;
        }

        //check if record exists
        if ($pin = \App\Models\Pinned::Where('pinnedresource_id', $resource_id)->Where('pinnedresource_type', $resource_type)->Where('pinned_userid', auth()->id())->first()) {
            $pin->delete();
            return 'unpin';
        }

        //create a new pin
        $pin = new $this->pinned;
        $pin->pinnedresource_id = $resource_id;
        $pin->pinnedresource_type = $resource_type;
        $pin->pinned_userid = auth()->id();
        $pin->save();

        return 'pin';
    }

}