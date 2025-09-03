<?php

/** --------------------------------------------------------------------------------
 * Boostraps various parts of modules
 *
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Modules;
use Closure;
use Exception;
use Log;
use Nwidart\Modules\Facades\Module;

class Bootstrap {

    /**
     * handle various boostrapping for modules
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //exit if setup is not complete
        if (env('SETUP_STATUS') != 'COMPLETED') {
            return $next($request);
        }

        //skip for ajax request
        if (request()->ajax()) {
            return $next($request);
        }

        try {

            //get all modules (status will be checked later)
            $modules = Module::all();
            if (count($modules) == 0) {
                return $next($request);
            }

            //set header and footer include files
            $this->setHeaderFooter($modules);

            //return
            return $next($request);

        } catch (\Exception$e) {
            Log::error("MODULES -  - bootstrapping modules - failed - error: " . $error_message, ['middleware.modules.bootstrap', config('app.debug_ref'), basename(__FILE__), __line__]);
            return $next($request);
        }

    }

    /**
     * include any headers and footers
     *
     * @return \Illuminate\Http\Response
     */
    public function setHeaderFooter($modules) {

        Log::info("MODULES -  Bootstraping [css][js] - setting head and footer css and js includes for modules - started", ['middleware.modules.bootstrap', config('app.debug_ref'), basename(__FILE__), __line__]);

        try {

            //generate menus
            foreach ($modules as $module) {

                //set some basic information about this module
                $module_name = $module->getName();

                $module_path = $module->getPath();

                //expected files
                $module_css = $module_path . '/Resources/assets/css/module.css';
                $module_custom_css = $module_path . '/Resources/assets/css/custom.css';
                $module_js = $module_path . '/Resources/assets/js/module.js';

                //place holders
                $css = '';
                $js = '';
                $custom_css = '';

                //check if the module is enabled in the database
                if (!in_array($module_name, config('modules.enabled'))) {
                    Log::info("MODULES -  Bootstraping [css][js] - [$module_name] is not enabled in the crm. Will skip it", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    continue;
                }

                //check if a head css file exists
                if (file_exists($module_css)) {
                    Log::info("MODULES -  Bootstraping [css][js] - [$module_name] has a css file [module.css]. it has been added to the <head>", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    $css = '<link rel="stylesheet" href="/application/modules/' . strtolower($module_name) . '/resources/assets/css/module.css">';
                } else {
                    Log::info("MODULES -  Bootstraping [css][js] - [$module_name] - include file not found (module.css) - will skip - ($module_css)", ['middleware.modules.bootstrap', config('app.debug_ref'), basename(__FILE__), __line__]);
                }

                //check if a head css file exists
                if (file_exists($module_custom_css)) {
                    Log::info("MODULES -  Bootstraping [css][js] - [$module_name] has a custom.css file [module.css]. it has been added to the <head>", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    $custom_css = '<link rel="stylesheet" href="/application/modules/' . strtolower($module_name) . '/resources/assets/css/custom.css">';
                } else {
                    Log::info("MODULES -  Bootstraping [css][js] - [$module_name] - include file not found (custom.css) - will skip - ($module_custom_css)", ['middleware.modules.bootstrap', config('app.debug_ref'), basename(__FILE__), __line__]);
                }

                //check if a head css file exists
                if (file_exists($module_js)) {
                    Log::info("MODULES -  Bootstraping [css][js] - [$module_name] has a js file [module.js]. it has been added to the <footer>", ['process' => 'middleware.modules.menus', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    $js = '<script src="/application/modules/' . strtolower($module_name) . '/resources/assets/js/module.js"></script>';
                } else {
                    Log::info("MODULES -  Bootstraping [css][js] - [$module_name] - include file not found (module.js) - will skip - ($module_js)", ['middleware.modules.bootstrap', config('app.debug_ref'), basename(__FILE__), __line__]);
                }

                //append to the head and footer
                if ($css != "") {
                    config([
                        'css.modules' => config('css.modules') . "\n" . $css,
                    ]);
                }

                if ($custom_css != "") {
                    config([
                        'css.modules' => config('css.modules') . "\n" . $custom_css,
                    ]);
                }

                if ($js != "") {
                    config([
                        'js.modules' => config('js.modules') . "\n" . $js,
                    ]);
                }
            }
            Log::info("MODULES -  Bootstraping [css][js] -setting head and footer css and js includes for modules - finished", ['middleware.modules.bootstrap', config('app.debug_ref'), basename(__FILE__), __line__]);

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("MODULES -  Bootstraping [css][js] -setting head and footer css and js includes for modules - failed - error: " . $error_message, ['middleware.modules.bootstrap', config('app.debug_ref'), basename(__FILE__), __line__]);
        }

    }
}