<?php

/** -------------------------------------------------------------------------------------------------
 * TEMPLATE
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 * @package   SaaS Platform
 * @author     NextLoop
 *---------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs\Cleanup;
use Log;

class CleanUpCron {

    public function __invoke() {

        //Set the settings
        bootAdminSettings();

        //Set the language
        bootAdminLanguage();

        //email config
        bootAdminMmail();

        //clean old log files
        $this->cleanLogFiles();

    }

    /**
     * delete large log files
     */
    public function cleanLogFiles() {

        try {
            // Path to the logs directory
            $logsPath = storage_path('logs');

            // Check if logs directory exists
            if (!is_dir($logsPath)) {
                return;
            }

            // Get all files in the logs directory
            $logFiles = glob($logsPath . '/*');

            if (empty($logFiles)) {
                return;
            }

            $maxFileSize = 50 * 1024 * 1024; // 50MB in bytes

            foreach ($logFiles as $filePath) {

                // Skip if it's not a file
                if (!is_file($filePath)) {
                    continue;
                }

                // Get file size
                $fileSize = filesize($filePath);

                // Delete if file is larger than 50MB
                if ($fileSize > $maxFileSize) {
                    @unlink($filePath);
                }
            }
        } catch (\Exception $e) {
            Log::error("Error deleting log file: " . $e->getMessage(), ['cronjob' => 'cleanup','debug_ref' => config('app.debug_ref'), 'file' => basename(__FILE__), 'line' => __LINE__ ]);
        }
    }
}