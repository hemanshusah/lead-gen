<?php

/** -------------------------------------------------------------------------------------------------------------------
 * @description
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *
 * @details
 * It runs various updates and fixes, usually as a result of an update but can be used for anything esle also.
 *
 * @package    Grow CRM
 * @author     NextLoop
 *
 *------------------------------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs\Cleanup;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\DB;

class FixesCron {

    protected $projectrepo;

    public function __invoke(
        ProjectRepository $projectrepo
    ) {

        $this->projectrepo = $projectrepo;

        //[MT] - tenants only
        if (env('MT_TPYE')) {
            if (\Spatie\Multitenancy\Models\Tenant::current() == null) {
                return;
            }
        }

        //boot system settings
        middlewareBootSettings();

        //[MT] boot mail settings
        env('MT_TPYE') ? middlewareSaaSBootMail() : middlewareBootMail();

        //run the updates
        $this->projectTemplateFolders();

        $this->missingUniqueID();

        $this->missingTimezones();

    }

    /**
     * @release_ververion : 2.6
     * @created_date : 19 May 2024
     *
     * @details :
     *   - looks for projects and project templates that do not have a (default folder) for files
     *   - create a default folder and updates all files to this folder
     *
     * @execution
     *   - fixes the issue when first run and any other times the issue resurfaces
     *
     * @system_impact
     *   - negligable sql queries but will take time to run if there are many such projects. If it times out, it will just continue on next run
     *
     *
     */
    public function projectTemplateFolders() {

        //get the system's default folder
        if (!$default_folder = \App\Models\FileFolder::Where('filefolder_default', 'yes')->Where('filefolder_system', 'yes')->first()) {
            return;
        }

        //get all [project templates] that do not have a [default file folder]
        if ($projects = \App\Models\Project::leftJoin('file_folders', 'file_folders.filefolder_projectid', '=', 'projects.project_id')
            ->whereNull('file_folders.filefolder_projectid')
            ->get()) {

            //update all projects and create adefault folder
            foreach ($projects as $project) {

                $folder = new \App\Models\FileFolder();
                $folder->filefolder_creatorid = 0;
                $folder->filefolder_projectid = $project->project_id;
                $folder->filefolder_name = $default_folder->filefolder_name;
                $folder->filefolder_default = 'yes';
                $folder->filefolder_system = 'no';
                $folder->save();

                //update all files for this project to this new folder
                \App\Models\File::where('fileresource_type', 'project')
                    ->where('fileresource_id', $project->project_id)
                    ->update(['file_folderid' => $folder->filefolder_id]);

            }
        }
    }

    /**
     * @release_ververion : none
     * @created_date : 8 June 2024
     *
     * @details :
     *   - update all database records that are missing unique id's
     *
     * @system_impact
     *   - negligable sql queries
     *
     */
    public function missingUniqueID() {

        // update tasks
        DB::statement('UPDATE tasks SET task_uniqueid = REPLACE(UUID(), "-", "") WHERE task_uniqueid IS NULL OR task_uniqueid = ""');

        // update projects
        DB::statement('UPDATE projects SET project_uniqueid = REPLACE(UUID(), "-", "") WHERE project_uniqueid IS NULL OR project_uniqueid = ""');

        // update contracts
        DB::statement('UPDATE contracts SET doc_unique_id = REPLACE(UUID(), "-", "") WHERE doc_unique_id IS NULL OR doc_unique_id = ""');

        // update proposals
        DB::statement('UPDATE proposals SET doc_unique_id = REPLACE(UUID(), "-", "") WHERE doc_unique_id IS NULL OR doc_unique_id = ""');

        // update estimates
        DB::statement('UPDATE estimates SET bill_uniqueid = REPLACE(UUID(), "-", "") WHERE bill_uniqueid IS NULL OR bill_uniqueid = ""');

        // update invoices
        DB::statement('UPDATE invoices SET bill_uniqueid = REPLACE(UUID(), "-", "") WHERE bill_uniqueid IS NULL OR bill_uniqueid = ""');

        // update files
        DB::statement('UPDATE files SET file_uniqueid = REPLACE(UUID(), "-", "") WHERE file_uniqueid IS NULL OR file_uniqueid = ""');

        // update leads
        DB::statement('UPDATE leads SET lead_uniqueid = REPLACE(UUID(), "-", "") WHERE lead_uniqueid IS NULL OR lead_uniqueid = ""');

    }

    /**
     * @release_ververion : 2.6
     * @created_date : July 2024
     *
     * @details :
     *   - update all database records that are missing a timezone
     *
     * @system_impact
     *   - negligable sql queries
     *
     */
    public function missingTimezones() {

        //users
        \App\Models\User::whereNull('timezone')
        ->orWhere('timezone', '')
        ->update(['timezone' => config('system.settings_system_timezone')]);
        
        //tasks
        \App\Models\Task::whereNull('task_calendar_timezone')
        ->orWhere('task_calendar_timezone', '')
        ->update(['task_calendar_timezone' => config('system.settings_system_timezone')]);
        
        //projects
        \App\Models\Project::whereNull('project_calendar_timezone')
        ->orWhere('project_calendar_timezone', '')
        ->update(['project_calendar_timezone' => config('system.settings_system_timezone')]);

    }

}