<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [edit] precheck processes for contacts
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Contacts;
use Closure;
use Log;

class Show {


    /**
     * This middleware does the following
     *   2. checks users permissions to [view] contacts
     *   3. modifies the request object as needed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //contact id
        $contact_id = $request->route('contact');

        //does the contact exist
        if ($contact_id == '' || !$contact = \App\Models\User::Where('id', $contact_id)->first()) {
            Log::error("contact could not be found", ['process' => '[permissions][contacts][show]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'contact id' => $contact_id ?? '']);
            abort(409, __('lang.user_not_found'));
        }

        //frontend
        $this->fronteEnd($contact);

        //permission: does user have permission edit contacts
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_contacts >= 1) {
                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][contacts][show]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd($contact) {

    }
}
