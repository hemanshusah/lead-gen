<?php

/** ---------------------------------------------------------------------------------------------------------------
 *
 * Boot settings from inside the helper file BootHelper.php
 *
 * @package    Grow CRM
 * @author     NextLoop
 * @revised    12 May 2024
 *----------------------------------------------------------------------------------------------------------------*/

namespace App\Http\Middleware\General;
use Closure;

class BootTheme {

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //boot mail settings
        middlewareBootTheme();

        return $next($request);
    }

}