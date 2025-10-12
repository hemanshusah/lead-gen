<?php

/**
 * [STANDALONE] & [SAAS]
 * Bootstrap the application services.
 *
 * @return void
 */
function middlewareBootSettings() {

    //do not run this for SETUP path
    if (env('SETUP_STATUS') != 'COMPLETED') {
        //skip this provider
        return;
    }

    //save system settings into config array
    $settings = \App\Models\Settings::leftJoin('settings2', 'settings2.settings2_id', '=', 'settings.settings_id')
        ->Where('settings_id', 1)
        ->first();

    //save system settings into config array
    $currencies = \App\Models\Currencies::orderBy('currency_code', 'asc')->get();
    config(['currencies' => $currencies]);

    //set timezone
    date_default_timezone_set($settings->settings_system_timezone);

    //currency symbol position setting
    if ($settings->settings_system_currency_position == 'left') {
        $settings['currency_symbol_left'] = $settings->settings_system_currency_symbol;
        $settings['currency_symbol_right'] = '';
    } else {
        $settings['currency_symbol_right'] = $settings->settings_system_currency_symbol;
        $settings['currency_symbol_left'] = '';
    }

    //lead statuses
    $settings['lead_statuses'] = [];
    $settings['lead_custom_statuses'] = [];
    foreach (\App\Models\LeadStatus::get() as $status) {
        $id = $status->leadstatus_id;
        $color = $status->leadstatus_color;
        $title = $status->leadstatus_title;
        $settings['lead_statuses'] += [
            $id => $color,
        ];
        $settings['lead_custom_statuses'] += [
            $id => $title,
        ];
    }

    //task custom statuses
    $settings['task_statuses'] = [];
    $settings['task_custom_statuses'] = [];
    foreach (\App\Models\TaskStatus::get() as $status) {
        $id = $status->taskstatus_id;
        $color = $status->taskstatus_color;
        $title = $status->taskstatus_title;
        $settings['task_statuses'] += [
            $id => $color,
        ];
        $settings['task_custom_statuses'] += [
            $id => $title,
        ];
    }

    //ticket custom statuses
    $settings['ticket_statuses'] = [];
    $settings['ticket_custom_statuses'] = [];
    foreach (\App\Models\TicketStatus::get() as $status) {
        $id = $status->ticketstatus_id;
        $color = $status->ticketstatus_color;
        $title = $status->ticketstatus_title;
        $settings['ticket_statuses'] += [
            $id => $color,
        ];
        $settings['ticket_custom_statuses'] += [
            $id => $title,
        ];
    }

    //Just a list of all payment geteways - used in dropdowns and filters
    $settings['gateways'] = [
        'Paypal',
        'Stripe',
        'Bank',
        'Cash',
    ];

    //cronjob path
    $settings['cronjob_path'] = '/usr/local/bin/php ' . BASE_DIR . '/application/artisan schedule:run >> /dev/null 2>&1';

    //all team members
    $settings['team_members'] = \App\Models\User::Where('type', 'team')->Where('status', 'active')->get();

    //the main admin user
    $settings['main_admin_user'] = \App\Models\User::Where('id', 1)->first();

    //javascript file versioning to avoid caching when making updates
    $settings['versioning'] = $settings->settings_system_javascript_versioning;

    //[saas] set the customers 'from' email address for users using [local] email
    if (env('MT_TPYE')) {
        if ($settings->settings_saas_email_server_type == 'local') {
            $settings['settings_email_from_address'] = $settings->settings_saas_email_local_address;
        }
    }

    //save once to config
    config(['system' => $settings]);

    $categories = \App\Models\Category::Where('category_type', 'project')->orderBy('category_name', 'asc')->get();
    config(['projects_categories' => $categories]);

    //recaptcha
    config([
        'recaptcha.api_site_key' => $settings->settings2_captcha_api_site_key,
        'recaptcha.api_secret_key' => $settings->settings2_captcha_api_secret_key,
    ]);

    /**
     * how many rows to show in settings. Defaults to a hard set value, if not present
     * fallback value: 5
     */
    config(['settings.custom_fields_display_limit' => config('settings.custom_fields_display_limit') ?? 5]);

    //custom css froms database
    $settings2_theme_css = '<style>' . $settings->settings2_theme_css . '</style>';
    config(['css.application' => $settings2_theme_css]);

    //[modules] - enabled modules
    $enabled_modules = \App\Models\Module::where('module_status', 'enabled')->pluck('module_name')->toArray();
    config(['modules.enabled' => $enabled_modules]);

}

/**
 * [STANDALONE]
 * bootstrap the application email service (standalone version).
 *
 * @return void
 */
function middlewareBootMail() {

    //do not run this for SETUP path
    if (env('SETUP_STATUS') != 'COMPLETED') {
        return;
    }

    //get settings
    $settings = \App\Models\Settings::find(1);

    //defaults
    $email_signature = '';
    $email_footer = '';

    //get email signature
    if ($template = \App\Models\EmailTemplate::Where('emailtemplate_name', 'Email Signature')->first()) {
        $email_signature = $template->emailtemplate_body;
    }

    //get email footer
    if ($template = \App\Models\EmailTemplate::Where('emailtemplate_name', 'Email Footer')->first()) {
        $email_footer = $template->emailtemplate_body;
    }

    //save to config
    config([
        'mail.default' => $settings->settings_email_server_type,
        'mail.mailers.smtp' => [
            'transport' => 'smtp',
            'host' => $settings->settings_email_smtp_host,
            'port' => $settings->settings_email_smtp_port,
            'encryption' => ($settings->settings_email_smtp_encryption == 'none') ? '' : $settings->settings_email_smtp_encryption,
            'username' => $settings->settings_email_smtp_username,
            'password' => $settings->settings_email_smtp_password,
            'url' => env('MAIL_URL'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],
        'mail.data' => [
            'company_name' => config('system.settings_company_name'),
            'todays_date' => runtimeDate(date('Y-m-d')),
            'email_signature' => $email_signature,
            'email_footer' => $email_footer,
            'dashboard_url' => url('/'),
        ],
    ]);
}

/**
 * [SAAS]
 * bootstrap the application email service (SaaS version).
 *
 * @return void
 */
function middlewareSaaSBootMail() {

    //get tenant settings
    $settings = \App\Models\Settings::find(1);

    //get landlord settings
    $landlord_settings = \App\Models\Landlord\Settings::On('landlord')->Where('settings_id', 'default')->first();

    //defaults
    $email_signature = '';
    $email_footer = '';

    //get email signature
    if ($template = \App\Models\EmailTemplate::Where('emailtemplate_name', 'Email Signature')->first()) {
        $email_signature = $template->emailtemplate_body;
    }

    //get email footer
    if ($template = \App\Models\EmailTemplate::Where('emailtemplate_name', 'Email Footer')->first()) {
        $email_footer = $template->emailtemplate_body;
    }

    //customer is using their own SMTP servr
    if ($settings->settings_saas_email_server_type == 'smtp') {
        config([
            'mail.default' => $settings->settings_email_server_type,
            'mail.mailers.smtp' => [
                'transport' => 'smtp',
                'host' => $settings->settings_email_smtp_host,
                'port' => $settings->settings_email_smtp_port,
                'encryption' => ($settings->settings_email_smtp_encryption == 'none') ? '' : $settings->settings_email_smtp_encryption,
                'username' => $settings->settings_email_smtp_username,
                'password' => $settings->settings_email_smtp_password,
                'url' => env('MAIL_URL'),
                'timeout' => null,
                'local_domain' => env('MAIL_EHLO_DOMAIN'),
            ],
            'mail.data' => [
                'company_name' => config('system.settings_company_name'),
                'todays_date' => runtimeDate(date('Y-m-d')),
                'email_signature' => $email_signature,
                'email_footer' => $email_footer,
                'dashboard_url' => url('/'),
            ],
        ]);
    }

    //customer is using local (landlord) mail settings
    if ($settings->settings_saas_email_server_type == 'local') {
        //save to config
        config([
            'mail.default' => $landlord_settings->settings_email_server_type,
            'mail.mailers.smtp' => [
                'transport' => 'smtp',
                'host' => $landlord_settings->settings_email_smtp_host,
                'port' => $landlord_settings->settings_email_smtp_port,
                'encryption' => ($landlord_settings->settings_email_smtp_encryption == 'none') ? '' : $landlord_settings->settings_email_smtp_encryption,
                'username' => $landlord_settings->settings_email_smtp_username,
                'password' => $landlord_settings->settings_email_smtp_password,
                'url' => env('MAIL_URL'),
                'timeout' => null,
                'local_domain' => env('MAIL_EHLO_DOMAIN'),
            ],
            'mail.data' => [
                'company_name' => config('system.settings_company_name'),
                'todays_date' => runtimeDate(date('Y-m-d')),
                'email_signature' => $email_signature,
                'email_footer' => $email_footer,
                'dashboard_url' => url('/'),
            ],
        ]);
    }
}

/**
 * [STANDALONE] & [SAAS]
 * Bootstrap the application services.
 *
 * @return void
 */
function middlewareBootTheme() {

    //do not run this for SETUP path
    if (env('SETUP_STATUS') != 'COMPLETED') {
        //set default theme
        config([
            'theme.selected_theme_css' => 'public/themes/default/css/style.css?v=1',
        ]);
        //skip this provider
        return;
    }

    //get settings
    $settings = \App\Models\Settings::find(1);

    //get all directories in themes folder
    $directories = Storage::disk('root')->directories('public/themes');

    //clean up directory names
    array_walk($directories, function (&$value, $key) {
        $value = str_replace('public/themes/', '', $value);
    });

    //check if default theme exists
    if (!in_array($settings->settings_theme_name, $directories)) {
        Log::critical("The selected theme directory could not be found", ['process' => '[validating theme]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'Theme Directory: ' => '/public/themes/' . $settings->settings_theme_name]);
        abort(409, __('lang.default_theme_not_found') . ' [' . runtimeThemeName($settings->settings_theme_name) . ']');
    }

    //check if css file exists
    if (!is_file(BASE_DIR . '/public/themes/' . $settings->settings_theme_name . '/css/style.css')) {
        Log::critical("The selected theme does not seem to have a style.css files", ['process' => '[validating theme]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'Theme Directory: ' => '/public/themes/' . $settings->settings_theme_name]);
        abort(409, __('lang.selected_theme_is_invalid'));
    }

    //validate if the folders in the /public/themes/ directory have a style.css file
    $list = [];
    foreach ($directories as $directory) {
        if (is_file(BASE_DIR . "/public/themes/$directory/css/style.css")) {
            $list[] = $directory;
        }
    }

    //set global theme (used for users who are not logged in)
    config([
        'theme.list' => $list,
        'theme.selected_name' => $settings->settings_theme_name,
        //main css file
        'theme.selected_theme_css' => 'public/themes/' . $settings->settings_theme_name . '/css/style.css?v=' . $settings->settings_system_javascript_versioning,
        //invoice/estimate pdf (web preview)
        //[8 Aug 2021] all themes should now use the 'default' theme's bill-pdf.css file (public/themes/default/css/bill-pdf.css)
        'theme.selected_theme_pdf_css' => 'public/themes/default/css/bill-pdf.css?v=' . $settings->settings_system_javascript_versioning,
        //[MT]
        'theme.selected_theme_saas_css' => 'public/themes/' . $settings->settings_theme_name . '/css/saas.css?v=' . $settings->settings_system_javascript_versioning,
    ]);

    //save active theme to config
    $active_theme = auth()->check() ? auth()->user()->pref_theme : $settings->settings_theme_name;
    if (is_file(BASE_DIR . "/public/themes/$active_theme/css/style.css")) {
        config(['active_theme' => $active_theme]);
    } else {
        config(['active_theme' => $settings->settings_theme_name]);
    }

    //[user custom theme] - set the theme for the current user (apply to all views)
    view()->composer('*', function ($view) {
        if (auth()->check()) {
            //validate current theme
            if (!is_file(BASE_DIR . '/public/themes/' . auth()->user()->pref_theme . '/css/style.css')) {
                //set use to default system theme
                auth()->user()->pref_theme = $settings->settings_theme_name;
                auth()->user()->save();
            }
        }
    });
}