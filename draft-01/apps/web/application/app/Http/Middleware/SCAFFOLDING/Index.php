<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for fooos
 *
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Fooos;

use App\Models\Fooo;
use Closure;
use Log;

class Index {


    public function handle($request, Closure $next) {

        //various frontend and visibility settings
        $this->fronteEnd();

        //client user permission
        if (auth()->user()->is_client) {
            return $next($request);
        }

        //admin user permission
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_fooos >= 1) {
                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['middleware.list.fooos', config('app.debug_ref'), basename(__FILE__), __line__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        //show something
        config([
            'visibility.add_button' => true,
            'visibility.delete_button' => true,
            'visibility.edit_button' => true,
        ]);

    }
}
