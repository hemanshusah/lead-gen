<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for system settings
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use App\Http\Responses\Common\CommonResponse;
use App\Http\Responses\Settings\System\SystemResponse;
use App\Repositories\SettingsRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class System extends Controller {

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
     * show general system usage of the CRM
     *
     * @return view
     */
    public function systemInfo() {

        //get settings
        $settings = \App\Models\Settings::find(1);

        //count files and attachments
        $files_count = \App\Models\File::count();
        $attachments_count = \App\Models\Attachment::count();

        //get PHP info
        $php_version = phpversion();
        $memory_limit = ini_get('memory_limit');
        $upload_max_filesize = ini_get('upload_max_filesize');

        //reponse payload
        $payload = [
            'response' => 'system-info',
            'page' => $this->pageSettings(),
            'settings' => $settings,
            'files_count' => $files_count + $attachments_count,
            'php_version' => $php_version,
            'memory_limit' => $memory_limit,
            'upload_max_filesize' => $upload_max_filesize,
        ];

        //show the view
        return new SystemResponse($payload);
    }

    /**
     * show the disc usage by the CRM
     *
     * @return bool
     */
    public function discUsage() {

        //calculate disc usage
        $disc = $this->calculateDiscUsage();

        //reponse payload
        $payload = [
            'response' => 'disc-usage',
            'disc' => $disc,
        ];

        //response
        return new SystemResponse($payload);
    }

    /**
     * calculate disc usage
     *
     * @return array
     */
    public function calculateDiscUsage() {

        $disc = [];

        try {
            //storage directory
            $storage_path = BASE_DIR . "/storage/";
            $disc['storage'] = $this->getDirectorySize($storage_path);

            //storage directory
            $temp_path = BASE_DIR . "/storage/temp";
            $disc['temp'] = $this->getDirectorySize($temp_path);

            //logs directory
            $logs_path = base_path('storage/logs');
            $disc['logs'] = $this->getDirectorySize($logs_path);

            //cache directory
            $cache_path = base_path('storage/cache');
            $disc['cache'] = $this->getDirectorySize($cache_path);

            //total usage
            $disc['total'] = $disc['storage'];

        } catch (\Exception$e) {
            Log::error("failed to calculate disc usage", ['system.disc_usage', config('app.debug_ref'), basename(__FILE__), __line__, $e->getMessage()]);
            $disc = [
                'storage' => 0,
                'temp' => 0,
                'logs' => 0,
                'cache' => 0,
                'total' => 0,
            ];
        }

        return $disc;
    }

    /**
     * get directory size
     *
     * @param string $path
     * @return int
     */
    private function getDirectorySize($path) {
        $size = 0;

        if (!is_dir($path)) {
            return $size;
        }

        foreach (File::allFiles($path) as $file) {
            $size += $file->getSize();
        }

        return $size;
    }

    /**
     * clean up disc space
     *
     * @return \Illuminate\Http\Response
     */
    public function cleanUpSpace() {

        $cleaned = [];

        try {
            //clear cache
            \Artisan::call('cache:clear');

            //clear logs
            $logs = File::allFiles(base_path('storage/logs'));
            foreach ($logs as $log) {
                File::delete($log);
            }

            //clear temp files
            $temp_path = BASE_DIR . "/storage/temp";
            if (is_dir($temp_path)) {
                // Get all files and directories inside temp folder
                $files = File::allFiles($temp_path);
                $directories = File::directories($temp_path);

                // Delete all files
                File::delete($files);

                // Delete all subdirectories and their contents
                foreach ($directories as $directory) {
                    File::deleteDirectory($directory);
                }
            }

        } catch (\Exception$e) {
            Log::error("failed to clean up disc space", ['system.cleanup', config('app.debug_ref'), basename(__FILE__), __line__, $e->getMessage()]);
        }

        //recalculate disc usage
        $disc = $this->calculateDiscUsage();

        //reponse payload
        $payload = [
            'response' => 'disc-usage',
            'disc' => $disc,
            'cleaned' => true,
        ];

        //response
        return new SystemResponse($payload);
    }

    /**
     * delete directory and its contents
     *
     * @param string $dir
     * @return bool
     */
    private function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }

    /**
     * Clear system cache
     *
     * @return \Illuminate\Http\Response
     */
    public function clearLaravelCache() {

        $settings = \App\Models\Settings::find(1);

        //clear cache
        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:clear');

        //reponse payload
        $payload = [
            'type' => 'success-notification',
        ];

        //show the view
        return new CommonResponse($payload);
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
                __('lang.general_settings'),
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