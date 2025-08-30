<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for general settings
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Tweak\TweakValidation;
use App\Http\Responses\Settings\Tweak\IndexResponse;
use App\Http\Responses\Settings\Tweak\UpdateResponse;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;

class Tweak extends Controller {

    /**
     * The settings repository instance.
     */
    protected $settingsrepo;

    public function __construct(SettingsRepository $settingsrepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        //settings general
        $this->middleware('settingsMiddlewareIndex');

        $this->settingsrepo = $settingsrepo;

    }

    /**
     * Display general settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //crumbs, page data & stats
        $page = $this->pageSettings();

        $settings = \App\Models\Settings2::find(1);

        //reponse payload
        $payload = [
            'page' => $page,
            'settings' => $settings,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TweakValidation $request) {

        //update
        \App\Models\Settings2::where('settings2_id', 1)
            ->update([
                'settings2_tweak_reports_truncate_long_text' => (request('settings2_tweak_reports_truncate_long_text') == 'on') ? 'yes' : 'no',
                'settings2_tweak_imap_tickets_import_limit' => request('settings2_tweak_imap_tickets_import_limit'),
                'settings2_tweak_imap_connection_timeout' => request('settings2_tweak_imap_connection_timeout'),
            ]);

        //reset imap category processing status
        if (request('settings2_tweak_imap_reset_stuck_in_processing') == 'on') {
            \App\Models\Category::where('category_type', 'ticket')
                ->update([
                    'category_meta_14' => 'completed',
                    'category_meta_22' => now(),
                ]);
        }

        //reponse payload
        $payload = [];

        //generate a response
        return new UpdateResponse($payload);
    }
    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        $page = [
            'crumbs' => [
                __('lang.settings'),
                __('lang.tweak_settings'),
            ],
            'crumbs_special_class' => 'main-pages-crumbs',
            'page' => 'settings',
            'meta_title' => __('lang.settings'),
            'heading' => __('lang.settings'),
            'settingsmenu_main' => 'active',
            'submenu_main_general' => 'active',
        ];
        return $page;
    }

}
