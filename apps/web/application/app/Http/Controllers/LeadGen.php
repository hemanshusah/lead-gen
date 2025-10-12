<?php

/** --------------------------------------------------------------------------------
 * LeadGen Controller
 * @package    Grow CRM
 * @author     Custom Development
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadGen extends Controller
{
    /**
     * Display the LeadGen iframe page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Page data for navigation highlighting
        $page = [
            'mainmenu_leadgen' => 'active',
            'meta_title' => 'LeadGen',
            'heading' => 'LeadGen'
        ];

        // Log access for debugging
        Log::info('LeadGen page accessed by user: ' . auth()->user()->id);

        return view('pages.leadgen.wrapper', compact('page'));
    }
}
