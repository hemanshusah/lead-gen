<?php

/** --------------------------------------------------------------------------------
 * This middleware set the global status of each module. Save the bool data in config
 * Handles menu generation for all enabled modules based on their config.json files
 *
 * [example] config('module.settings_modules_projects')
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Modules;
use Closure;
use Log;
use Nwidart\Modules\Facades\Module;

class Menus {

    //modules
    private $modules;

    /**
     * Handle incoming request and generate module menus
     * Skips processing for AJAX requests and when no enabled modules exist
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //exit if setup is not complete
        if (env('SETUP_STATUS') != 'COMPLETED') {
            return $next($request);
        }

        //skip for ajax calls
        if (request()->ajax()) {
            return $next($request);
        }

        //skip for guest
        if (!auth()->check()) {
            return $next($request);
        }

        try {
            //get all modules (status will be checked later)
            $this->modules = Module::all();
            if (count($this->modules) == 0) {
                return $next($request);
            }

            //generate menus
            foreach ($this->modules as $module) {

                //module name
                $module_name = $module->getName();

                //double check enabled status in database
                if (in_array($module_name, config('modules.enabled'))) {
                    $this->generateMenus($module);
                }

            }

            //return
            return $next($request);

        } catch (\Exception$e) {
            Log::error("MODULES - Menu middleware error: " . $e->getMessage());
            return $next($request);
        }
    }

    /** ---------------------------------------------------------------------------------
     * Process each module's menu configuration
     * - Reads and validates the module's config.json file
     * - Validates each menu structure
     * - Renders appropriate HTML for each valid menu type
     * - Handles both main menu and settings menu targets
     *
     * @param object $module Instance of enabled module
     * @return void
     *-----------------------------------------------------------------------------------*/
    public function generateMenus($module) {
        try {
            //set some basic information about this module
            $module_name = $module->getName();

            //check if the module is enabled in the database
            if (!in_array($module_name, config('modules.enabled'))) {
                Log::info("MODULES - Module [$module_name] is not enabled in the crm. Will skip it", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return;
            }

            //check if the module has a config.json file and if that file has valid menu objects
            if (!$menus = $this->getMenus($module)) {
                Log::info("MODULES - Module [$module_name] does not have a valid menus config.json file. Will skip it", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return;
            }

            //loop through the 'menus' object and render html for each menu found
            foreach ($menus as $menu) {
                //validate the minimum expected structure of each menu object
                if (!$menu = $this->validateMenu($menu, $module_name)) {
                    Log::info("MODULES - Module [$module_name] has an incorrectly formatted menu object. Will skip it", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    continue;
                }

                //render each menu
                switch ($menu['placement']) {
                case 'main':
                    $this->renderMainMenu($menu, $module_name);
                    break;
                case 'settings':
                    $this->renderSettingsMenu($menu, $module_name);
                    break;
                case 'tabs':
                    $this->renderTabsMenu($menu, $module_name);
                    break;
                case 'profile':
                    $this->renderProfileMenu($menu, $module_name);
                    break;
                case 'topnav':
                    $this->renderTopnavMenu($menu, $module_name);
                    break;
                }
            }
        } catch (\Exception$e) {
            Log::error("MODULES - generating module menus failed - error: " . $e->getMessage(), ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        }
    }

    /** ---------------------------------------------------------------------------------
     * Read and validate module's menu configuration
     * - Locates and reads the config.json file
     * - Validates JSON structure and format
     * - Extracts and returns menu configuration array
     *
     * @param object $module Module instance containing path and name
     * @return mixed Array of menu configurations if valid, false if invalid or missing
     *-----------------------------------------------------------------------------------*/
    private function getMenus($module) {
        try {
            //module path
            $module_path = $module->getPath();

            //module name
            $module_name = $module->getName();

            //module json file
            $module_config_file = $module_path . '/config.json';

            //check if file exists
            if (!file_exists($module_config_file)) {
                Log::error("MODULES - generating menus for module [$module_name] failed - config.json file not found", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //get file contents
            $json_contents = file_get_contents($module_config_file);
            if ($json_contents === false) {
                Log::error("MODULES - generating menus for module [$module_name] failed - unable to read config.json file", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //decode json
            $config = json_decode($json_contents, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error("MODULES - generating menus for module [$module_name] failed - invalid JSON format in config.json", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //validate menus object exists
            if (!isset($config['menus']) || !is_array($config['menus'])) {
                Log::info("MODULES - generating menus for module [$module_name
                ] - skipped - no menus found in the config file", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //return menus array
            return $config['menus'];

        } catch (\Exception$e) {
            Log::info("MODULES - generating menus for module [$module_name] failed - error: . $e->getMessage()", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /** ---------------------------------------------------------------------------------
     * Validate menu configuration structure
     * - Validates menu type (single/dropdown)
     * - Checks required fields presence (placement, parent, title, href)
     * - Adds default values for optional fields (icon, id, class)
     * - For dropdowns, validates submenu items structure
     *
     * @param array $menu Menu configuration array
     * @return mixed Validated and sanitized menu array or false if invalid
     *-----------------------------------------------------------------------------------*/
    private function validateMenu($menu = [], $module_name = '') {

        Log::info("MODULES - validating menu for module [$module_name] - started]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        try {
            //basic validation - check if type exists
            if (!isset($menu['type']) || empty($menu['type'])) {
                Log::error("MODULES - validating menu for module [$module_name] failed - menu type is missing]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //validate menu type
            $valid_types = [
                'single',
                'dropdown',
                'dropdown-child',
            ];

            if (!in_array($menu['type'], $valid_types)) {
                Log::error("MODULES - validating menu for module [$module_name] failed - menu type is invalid]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //required fields
            $required_fields = ['placement', 'parent', 'title'];
            foreach ($required_fields as $field) {
                if (!isset($menu[$field]) || empty($menu[$field])) {
                    Log::error("MODULES - validating menu for module [$module_name] failed - missing required field ($field) ]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    return false;
                }
            }

            //set optional fiels
            $menu = $this->setOptionalFields($menu);

            //set the title
            $menu['title'] = $this->setTitle($menu['title']);

            //set menu visibility
            $menu['visible'] = $this->setMenuVisibility($menu, $module_name);

            //validate dropdown menu type
            if ($menu['type'] == 'dropdown') {

                //validate submenu items
                if (!isset($menu['data']) || !is_array($menu['data'])) {
                    Log::error("MODULES - validating menu for module [$module_name] failed - missing or invalid dropdown submenu (data) array]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    return false;
                }

                //validate each submenu item
                foreach ($menu['data'] as $key => $submenu) {
                    //required fields
                    $required_fields = ['title', 'href'];
                    foreach ($required_fields as $field) {
                        if (!isset($submenu[$field]) || empty($submenu[$field])) {
                            Log::error("MODULES - validating menu for module [$module_name] failed - missing a required field ($field)]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                            unset($menu['data'][$key]);
                            continue;
                        }
                    }

                    //optional fields
                    $optional_fields = ['icon', 'id', 'class', 'user_type'];
                    foreach ($optional_fields as $field) {
                        if (!isset($submenu[$field])) {
                            $menu['data'][$key][$field] = null;
                        }
                    }

                    //set optional fiels
                    $menu['data'][$key] = $this->setOptionalFields($menu['data'][$key]);

                    //set the title
                    $menu['data'][$key]['title'] = $this->setTitle($menu['data'][$key]['title']);

                    //set menu visibility
                    $menu['data'][$key]['visible'] = $this->setMenuVisibility($menu['data'][$key], $module_name);

                    Log::info("MODULES - validating menu for module [$module_name] completed]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    Log::debug("menu for module [$module_name] - payload", ['menu' => $menu]);
                }

                //check if we have any valid submenu items left
                if (empty($menu['data'])) {
                    Log::error("MODULES - validating menu for module [$module_name] failed - dropdown menu has no submenu (data) items]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    return false;
                }
            }

            return $menu;

        } catch (\Exception$e) {
            Log::error("MODULES - validating menu for module [$module_name] failed. error: " . $e->getMessage(), ['process' => '[permissions]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /** ---------------------------------------------------------------------------------
     * Render [main] menu and store in config
     * - Handles both single and dropdown menu types
     * - Renders appropriate blade template based on menu type or uses specified HTML
     * - Appends rendered HTML to existing main menu configuration
     *
     * @type single | dropdown | dropdown-child
     * @param array $menu
     * @param array $module_name
     * @return void
     *-----------------------------------------------------------------------------------*/
    private function renderMainMenu($menu = [], $module_name = '') {

        //basic vars
        $menu_type = $menu['type'];
        $parent = $menu['parent'];

        Log::info("MODULES - rendering [main menu] - started]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        try {
            //render single menu
            if ($menu['type'] == 'single') {

                Log::info("MODULES - rendering [main menu][single] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.main.single', compact('menu'))->render();
            }

            //render dropdown menu
            if ($menu['type'] == 'dropdown') {

                Log::info("MODULES - rendering [main menu][dropdown] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.main.dropdown', compact('menu'))->render();
            }

            //render dropdown child menu
            if ($menu['type'] == 'dropdown-child') {

                Log::info("MODULES - rendering [main menu][dropdown-child] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.main.dropdown-child', compact('menu'))->render();
            }

            //append to the correct parent
            config([
                $parent => config($parent) . $menu_html,
            ]);

            Log::info("MODULES - rendering [main menu] ($menu_type) for module [$module_name] with parent [$parent] - completed]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        } catch (\Exception$e) {
            Log::error("MODULES - rendering a menu for [main menu] ($menu_type) for module [$module_name] with parent [$parent] - failed. error: " . $e->getMessage(), ['process' => '[permissions]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        }
    }

    /** ---------------------------------------------------------------------------------
     * Render [settings] menu and store in config
     * - Handles both single and dropdown menu types
     * - Renders appropriate blade template based on menu type or uses specified HTML
     * - Appends rendered HTML to existing main menu configuration
     *
     * @type single | dropdown | dropdown-child
     * @param array $menu
     * @param array $module_name
     * @return void
     *-----------------------------------------------------------------------------------*/
    private function renderSettingsMenu($menu = [], $module_name = '') {

        //basic vars
        $menu_type = $menu['type'];
        $parent = $menu['parent'];

        Log::info("MODULES - rendering [settings menu] - started]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        try {
            //render single menu
            if ($menu['type'] == 'single') {

                Log::info("MODULES - rendering [settings menu][single] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.settings.single', compact('menu'))->render();
            }

            //render dropdown menu
            if ($menu['type'] == 'dropdown') {

                Log::info("MODULES - rendering [settings menu][dropdown] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.settings.dropdown', compact('menu'))->render();
            }

            //render dropdown child menu
            if ($menu['type'] == 'dropdown-child') {

                Log::info("MODULES - rendering [main menu][dropdown-child] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.main.dropdown-child', compact('menu'))->render();
            }

            //append to the correct parent
            config([
                $parent => config($parent) . $menu_html,
            ]);

            Log::info("MODULES - rendering [main menu] ($menu_type) for module [$module_name] with parent [$parent] - completed]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        } catch (\Exception$e) {
            Log::error("MODULES - rendering a menu for [settings menu] ($menu_type) for module [$module_name] with parent [$parent] - failed. error: " . $e->getMessage(), ['process' => '[permissions]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        }

    }

    /** ---------------------------------------------------------------------------------
     * Render [tab] menu (e.g. client, project tab menus) and store in config
     * - Handles both single and dropdown menu types
     * - Renders appropriate blade template based on menu type or uses specified HTML
     * - Appends rendered HTML to existing main menu configuration
     *
     * @type single | dropdown | dropdown-child
     * @param array $menu
     * @param array $module_name
     * @return void
     *-----------------------------------------------------------------------------------*/
    private function renderTabsMenu($menu = [], $module_name = '') {

        //basic vars
        $menu_type = $menu['type'];
        $parent = $menu['parent'];

        Log::info("MODULES - rendering [tabs menu] - started]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        try {
            //render single menu
            if ($menu['type'] == 'single') {

                Log::info("MODULES - rendering [tabs menu][single] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.tabs.single', compact('menu'))->render();
            }

            //render dropdown menu
            if ($menu['type'] == 'dropdown') {

                Log::info("MODULES - rendering [tabs menu][dropdown] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.tabs.dropdown', compact('menu'))->render();
            }

            //render dropdown child menu
            if ($menu['type'] == 'dropdown-child') {

                Log::info("MODULES - rendering [tabs menu][dropdown-child] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.tabs.dropdown-child', compact('menu'))->render();
            }

            //append to the correct parent
            config([
                $parent => config($parent) . $menu_html,
            ]);

            Log::info("MODULES - rendering [tabs menu] ($menu_type) for module [$module_name] with parent [$parent] - completed]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        } catch (\Exception$e) {
            Log::error("MODULES - rendering a menu for [tabs menu] ($menu_type) for module [$module_name] with parent [$parent] - failed. error: " . $e->getMessage(), ['process' => '[permissions]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        }
    }

    /** ---------------------------------------------------------------------------------
     * Render [top nav] menu and store in config
     * - Handles both single and dropdown menu types
     * - Renders appropriate blade template based on menu type or uses specified HTML
     * - Appends rendered HTML to existing main menu configuration
     *
     * @type single | dropdown | dropdown-child
     * @param array $menu
     * @param array $module_name
     * @return void
     *-----------------------------------------------------------------------------------*/
    private function renderTopnavMenu($menu = [], $module_name = '') {

        //basic vars
        $menu_type = $menu['type'];
        $parent = $menu['parent'];

        Log::info("MODULES - rendering [topnav menu] - started]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        try {
            //render single menu
            if ($menu['type'] == 'single') {

                Log::info("MODULES - rendering [topnav menu][single] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.topnav.single', compact('menu'))->render();
            }

            //render dropdown menu
            if ($menu['type'] == 'dropdown') {

                Log::info("MODULES - rendering [topnav menu][dropdown] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.topnav.dropdown', compact('menu'))->render();
            }

            //render dropdown child menu
            if ($menu['type'] == 'dropdown-child') {

                Log::info("MODULES - rendering [topnav menu][dropdown-child] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.topnav.dropdown-child', compact('menu'))->render();
            }

            //append to the correct parent
            config([
                $parent => config($parent) . $menu_html,
            ]);

            Log::info("MODULES - rendering [topnav menu] ($menu_type) for module [$module_name] with parent [$parent] - completed]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        } catch (\Exception$e) {
            Log::error("MODULES - rendering a menu for [main menu] ($menu_type) for module [$module_name] with parent [$parent] - failed. error: " . $e->getMessage(), ['process' => '[permissions]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        }
    }

    /** ---------------------------------------------------------------------------------
     * Render [user profile] menu and store in config
     * - Handles both single and dropdown menu types
     * - Renders appropriate blade template based on menu type or uses specified HTML
     * - Appends rendered HTML to existing main menu configuration
     *
     * @type single
     * @param array $menu
     * @param array $module_name
     * @return void
     *-----------------------------------------------------------------------------------*/
    private function renderProfileMenu($menu = [], $module_name = '') {

        //basic vars
        $menu_type = $menu['type'];
        $parent = $menu['parent'];

        Log::info("MODULES - rendering [profile menu] ($menu_type) for module [$module_name] with parent [$parent] - started]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        try {
            //render single menu
            if ($menu['type'] == 'single') {

                Log::info("MODULES - rendering [profile menu][single] ($menu_type) for module [$module_name] with parent [$parent]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //render the html for this menu
                $menu_html = ($menu['html']) ? ($menu['html']) : view('modules.menus.profile.single', compact('menu'))->render();
            }

            //append to the correct parent
            config([
                $parent => config($parent) . $menu_html,
            ]);

            Log::info("MODULES - rendering [profile menu] ($menu_type) for module [$module_name] with parent [$parent] - completed]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        } catch (\Exception$e) {
            Log::error("MODULES - rendering a menu for [profile menu] ($menu_type) for module [$module_name] with parent [$parent] - failed. error: " . $e->getMessage(), ['process' => '[permissions]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        }
    }

    /** ---------------------------------------------------------------------------------
     * Check if a user role was specified and if the current user has that role
     * and use this to set the visibility of this menu item
     *
     * @param array $menu
     * @param array $module_name
     * @return bool
     *-----------------------------------------------------------------------------------*/
    private function setMenuVisibility($menu = [], $module_name) {

        Log::info("MODULES - setting menu visibility (permission check) for menu titled [$module_name][" . $menu['title'] . "] - (for logged in users) - started ]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        if (!auth()->check()) {
            return false;
        }

        $failed_count = 0;

        $user_id = auth()->id();
        $user_name = auth()->user()->full_name;

        //sanitize module name
        $sanitized_module_name = modulesSanitizeModuleName($module_name);

        //check visibility based on the user_type (i.e. team|client|all)
        if ($menu['user_type'] && $menu['user_type'] != 'all') {

            //admin
            if ($menu['user_type'] == 'admin' && !auth()->user()->is_admin) {
                $failed_count++;
            }

            //tean and client
            if (in_array($menu['user_type'], ['team', 'client']) && $menu['user_type'] != auth()->user()->type) {
                $failed_count++;
            }
        }

        //check based on user role permission setting (as set by admin in the 'roles' feature)
        if ((isset($menu['user_module_role']) && in_array($menu['user_module_role'], ['none', 'view', 'manage'])) && $sanitized_module_name != '') {
            Log::info("MODULES - menu titled [$module_name][" . $menu['title'] . "] requires a permission level of [" . $menu['user_module_role'] . "] - will now check if current user has permission]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            if (auth()->check()) {
                try {
                    //user does not have permission
                    if (auth()->user()->role->module->$sanitized_module_name == 'none' || auth()->user()->role->module->$sanitized_module_name == '') {
                        $failed_count++;
                    }
                } catch (Exception $e) {
                    Log::error("MODULES - unable to get users role permissions for this module", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    $failed_count++;
                }
            } else {
                $failed_count++;
            }

        }

        //no failed check
        if ($failed_count == 0) {
            Log::info("MODULES - current user id: ($user_id) name: ($user_name) has permission to the menu titled [$module_name][" . $menu['title'] . "] - it will now be set to visible]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return true;
        }

        //failed
        Log::info("MODULES - current user id: ($user_id) name: ($user_name) does not have permission to the menu titled [$module_name][" . $menu['title'] . "] - it will now be set to invisible]", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        return false;
    }

    /** ---------------------------------------------------------------------------------
     * Set the title based on actual text or language value
     *
     * @param string $title
     * @return title
     *-----------------------------------------------------------------------------------*/
    private function setTitle($title = []) {

        if (strpos($title, 'lang.') !== false) {
            return __($title);
        }

        return $title;
    }

    /** ---------------------------------------------------------------------------------
     * set these array keys if they are not already set and give them some defaul data
     * of just null
     *
     *
     * @param array $menu
     * @return array $menu
     *-----------------------------------------------------------------------------------*/
    private function setOptionalFields($menu = []) {

        $optional_fields = [
            'href',
            'id',
            'class',
            'html',
            'icon',
            'user_type',
            'user_module_role',
            'title',
            'target',
            'data-url',
            'data-toggle',
            'data-target',
            'data-modal-title',
            'data-action-url',
            'data-action-method',
            'data-loading-class',
            'data-loading-target',
            'data-type',
            'data-form-id',
            'data-ajax-type',
            'data-dynamic-url',
            'data-progress-bar',
            'data-footer-visibility',
            'data-notifications',
            'data-close-button-visibility',
        ];

        foreach ($optional_fields as $field) {
            if (!isset($menu[$field])) {
                switch ($field) {
                case 'href':
                    $menu[$field] = '#';
                    break;
                case 'target':
                    $menu[$field] = '_self';
                    break;
                default:
                    $menu[$field] = null;
                }
            }
        }

        return $menu;
    }

}