<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [show] precheck processes for fooos
 *
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Fooos;
use Closure;
use Log;

class Show {

    public function handle($request, Closure $next) {

        //fooo id
        $fooo_id = $request->route('fooo');

        //frontend
        $this->fronteEnd();

        //does the fooo exist
        if ($fooo_id == '' || !$fooo = \App\Models\Fooo::Where('fooo_id', $fooo_id)->first()) {
            abort(404);
        }

        //team: does user have permission edit fooos
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_fooos >= 1) {
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
        Log::error("permission denied", ['middleware.show.fooo', config('app.debug_ref'), basename(__FILE__), __line__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        //show something
        config(['visibility.foo_bar_ement' => true]);

    }

}
