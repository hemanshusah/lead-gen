<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [create] pre-check processes for fooos
 *
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Fooos;
use Closure;
use Log;

class Create {

    public function handle($request, Closure $next) {

        //frontend
        $this->fronteEnd();

        //permission: does user have permission create fooos
        if (auth()->user()->role->role_fooos >= 2) {      
            return $next($request);
        }

        //permission denied
        Log::error("permission denied", ['middleware.create.fooo', config('app.debug_ref'), basename(__FILE__), __line__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        //show something
        config([
            'visibility.foo_bar_ement' => true
        ]);

    }
}
