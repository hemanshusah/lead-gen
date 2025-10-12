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

class BootMail {

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //do not run this for SETUP path
        if (env('SETUP_STATUS') != 'COMPLETED') {
            return $next($request);
        }

        //[MT] boot mail settings
        env('MT_TPYE') ? middlewareSaaSBootMail() : middlewareBootMail();
        
        return $next($request);

    }

}