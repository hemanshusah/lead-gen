<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [edit] pre-check processes for fooos
 *
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Fooos;
use Closure;
use Log;

class Edit {


    public function handle($request, Closure $next) {

        //fooo id
        $fooo_id = $request->route('fooo');

        //frontend
        $this->fronteEnd();

        //does the fooo exist
        if ($fooo_id == '' || !$fooo = \App\Models\Fooo::Where('fooo_id', $fooo_id)->first()) {
            Log::error("fooo could not be found", ['process' => '[fooos][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'fooo id' => $fooo_id ?? '']);
            abort(404);
        }

        //permission: does user have permission edit fooos
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_fooos >= 2) {
                return $next($request);
            }
        }

        //client: does user have permission edit fooos
        if (auth()->user()->is_client) {
            if ($fooo->fooo_clientid == auth()->user()->clientid) {
                    return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['middleware.edit.fooo', config('app.debug_ref'), basename(__FILE__), __line__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        //some settings
        config([
            'settings.fooo' => true,
        ]);
    }
}
