<?php

/** --------------------------------------------------------------------------------
 * [NOTES Aug 2022]
 *   - The provider must run before all other servive providers in (config/app.php)
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Log;

class UpdateServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

        //do not run this if setup has not completed
        if (env('SETUP_STATUS') != 'COMPLETED') {
            //skip this provider
            return;
        }

        if (request()->ajax()) {
            return;
        }

        //get a list of all the sql files in the updates folder
        $path = BASE_DIR . "/updates";
        $files = File::files($path);
        $updated = false;
        foreach ($files as $file) {

            //file details
            $filename = $file->getFilename();
            $extension = $file->getExtension();
            $filepath = $file->getPathname();

            //runtime function name (e.g. updating_1_13)
            $function_name = str_replace('.sql', '', $filename);
            $function_name = str_replace('.', '_', "updating_" . $function_name);

            /** --------------------------------------------------------------------------------------------------------------------------------
             * APRIL 2025 - V2.9
             *
             * Starting this version, the SQL file is executed section by section.E.g. 2.9.1.sql; 2.9.2.sql; etc are all now one file 2.9.sql
             *  - Each section is identfied by '-- [SQL BLOCK]' tag
             *  - This enables only single failure points and not the whole file
             *  - The merged sql file is created by addining file to the Python combining app
             *  - Note, the merged file must end with a wrapping -- [SQL BLOCK] as the last line item
             *  - If the file does not have any '-- [SQL BLOCK]' sections, the entire file will be treated as one block and processed
             * --------------------------------------------------------------------------------------------------------------------------------*/
            if ($extension == 'sql') {
                if (\App\Models\Update::Where('update_mysql_filename', $filename)->doesntExist()) {

                    Log::info("the mysql file ($filename) has not previously been executed. Will now execute it", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);

                    // Read the contents of the SQL file
                    $sql_content = file_get_contents($filepath);

                    // Split the SQL content into blocks based on the "-- [SQL BLOCK]" marker found in the sal file
                    $sql_blocks = preg_split('/-- \[SQL BLOCK\].*?(?:\R|$)/', $sql_content, -1, PREG_SPLIT_NO_EMPTY);

                    // If there were no "-- [SQL BLOCK]" markers, treat the entire file as a single block
                    if (count($sql_blocks) == 0) {
                        $sql_blocks = [$sql_content];
                    }

                    // Loop through each version block and execute it
                    foreach ($sql_blocks as $sql_block) {
                        try {
                            // Skip empty blocks
                            if (trim($sql_block) === '') {
                                continue;
                            }

                            // Execute the entire version block as a single operation
                            DB::unprepared($sql_block);

                            //save record
                            $record = new \App\Models\Update();
                            $record->update_mysql_filename = $filename;
                            $record->save();

                            Log::info("the mysql file ($filename) executed ok - will now delete it", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                        } catch (Exception $e) {
                            Log::error("the mysql file ($filename) could not be executed", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                        }
                    }

                    //delete the file
                    try {
                        unlink($path . "/$filename");
                    } catch (Exception $e) {
                        Log::error("the mysql file ($filename) could not be deleted", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                    }

                    /** -------------------------------------------------------------------------
                     * Run any updating function, if it exists
                     * as found in the file - application/updating/updating_1.php ...etc
                     * -------------------------------------------------------------------------*/
                    Log::info("checking if a runtime function: [$function_name()] exists", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                    if (function_exists($function_name)) {

                        Log::info("runtime function: [$function_name()] was found. It will now be executed", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);

                        try {
                            call_user_func($function_name);
                            Log::info("the runtime function: [$function_name()] was executed", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                        } catch (Exception $e) {
                            Log::critical("updating runtime function: [$function_name()] could not be executed. Error: " . $e->getMessage(), ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                        }
                    }

                    //finish
                    Log::info("updating of mysql file ($filename) has been completed", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                } else {
                    try {
                        unlink($path . "/$filename");
                        Log::info("found a non mysql file ($filename) inside the updates folder. Will try to delete it", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                    } catch (Exception $e) {
                        Log::error("the file ($filename) could not be deleted", ['process' => '[updates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'filename' => $filename]);
                    }
                }
                //we have done an update
                $updated = true;
            }
        }

        //finish - clear cache
        if ($updated) {
            \Artisan::call('cache:clear');
            \Artisan::call('route:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
