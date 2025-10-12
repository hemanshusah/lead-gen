<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for checklists
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Log;

//use DB;
//use Illuminate\Support\Facades\Schema;

class ChecklistRepository {

    /**
     * The checklists repository instance.
     */
    protected $checklists;

    /**
     * Inject dependecies
     */
    public function __construct(Checklist $checklists) {
        $this->checklists = $checklists;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object checklists collection
     */
    public function search($id = '') {

        //new query
        $checklists = $this->checklists->newQuery();

        // all client fields
        $checklists->selectRaw('*');

        //default where
        $checklists->whereRaw("1 = 1");

        //limit by id
        if (is_numeric($id)) {
            $checklists->where('checklist_id', $id);
        }

        //filters: resource type
        if (request()->filled('checklistresource_type')) {
            $checklists->where('checklistresource_type', request('checklistresource_type'));
        }

        //filters: resource type
        if (request()->filled('checklistresource_id')) {
            $checklists->where('checklistresource_id', request('checklistresource_id'));
        }

        //filter clients
        if (request()->filled('filter_checklist_clientid')) {
            $invoices->where('checklist_clientid', request('filter_checklist_clientid'));
        }

        //default sorting
        $checklists->orderBy('checklist_position', 'asc');

        return $checklists->paginate(1000);
    }

    /**
     * Create a new record
     * @return mixed object|bool object or process outcome
     */
    public function create($position = 0) {

        //save new user
        $checklist = new $this->checklists;

        //data
        $checklist->checklist_creatorid = auth()->id();
        $checklist->checklist_text = request('checklist_text');
        $checklist->checklistresource_type = request('checklistresource_type');
        $checklist->checklistresource_id = request('checklistresource_id');
        $checklist->checklist_position = $position;

        //save and return id
        if ($checklist->save()) {
            return $checklist->checklist_id;
        } else {
            Log::error("creating record failed - database error", ['process' => '[ChecklistRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /**
     * Import a text file list into checklist items (generic method for any resource type)
     *
     * @param string $filepath Path to the text file
     * @param string $checklistresource_type Resource type (task, lead, project, etc.)
     * @param int $checklistresource_id Resource ID to associate checklist items with
     * @param int $import_limit the maximum number or items to import
     * @return array Array with import results ['success' => bool, 'imported' => int, 'skipped' => int, 'message' => string]
     */
    public function importTextChecklist($filepath, $checklistresource_type, $checklistresource_id, $import_limit) {

        // Initialize counters
        $imported = 0;
        $skipped = 0;

        try {
            // Validate file exists
            if (!file_exists($filepath)) {
                Log::error("Text checklist import failed - file not found: {$filepath}", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File not found',
                ];
            }

            // Validate file is readable
            if (!is_readable($filepath)) {
                Log::error("Text checklist import failed - file not readable: {$filepath}", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File is not readable',
                ];
            }

            // Check if it's a text file by extension
            $file_extension = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
            if (!in_array($file_extension, ['txt', 'text'])) {
                Log::error("Text checklist import failed - invalid file type: {$file_extension}", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'Invalid file type. Only .txt files are supported',
                ];
            }

            // Read file content
            $content = file_get_contents($filepath);

            if ($content === false) {
                Log::error("Text checklist import failed - could not read file content", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'Could not read file content',
                ];
            }

            // Check if file is empty
            if (empty(trim($content))) {
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File is empty',
                ];
            }

            // Split content into lines
            $lines = explode("\n", $content);

            // Get starting position for new checklist items
            $query = \App\Models\Checklist::where('checklistresource_type', $checklistresource_type)
                ->where('checklistresource_id', $checklistresource_id);

            // Add client filter for leads (matching the existing pattern)
            if ($checklistresource_type == 'lead' && request('access_control_customer_unique_id')) {
                $query->where('checklist_clientid', request('access_control_customer_unique_id'));
            }

            $last_checklist = $query->orderBy('checklist_position', 'desc')->first();
            $position = $last_checklist ? $last_checklist->checklist_position + 1 : 1;

            // Process each line
            foreach ($lines as $line) {
                // Skip if we've reached max items
                if ($imported >= $import_limit) {
                    $skipped++;
                    continue;
                }

                // Clean up the line
                $line = trim($line);

                // Skip empty lines
                if (empty($line)) {
                    $skipped++;
                    continue;
                }

                // Parse the line to extract text and status
                $parsed = $this->parseTextChecklistLine($line);

                if ($parsed['text']) {
                    // Create new checklist item
                    $checklist = new $this->checklists;
                    $checklist->checklist_creatorid = auth()->id();
                    $checklist->checklist_text = $parsed['text'];
                    $checklist->checklist_status = $parsed['status'];
                    $checklist->checklistresource_type = $checklistresource_type;
                    $checklist->checklistresource_id = $checklistresource_id;
                    $checklist->checklist_position = $position;

                    // Add client ID for leads (matching the existing pattern)
                    if ($checklistresource_type == 'lead' && request('access_control_customer_unique_id')) {
                        $checklist->checklist_clientid = request('access_control_customer_unique_id');
                    }

                    if ($checklist->save()) {
                        $imported++;
                        $position++;
                    } else {
                        Log::error("Failed to save checklist item during text import", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                        $skipped++;
                    }
                } else {
                    $skipped++;
                }
            }

            return [
                'success' => true,
                'imported' => $imported,
                'skipped' => $skipped,
                'message' => "Successfully imported {$imported} checklist items",
            ];

        } catch (\Exception$e) {
            Log::error("Text checklist import failed with exception: " . $e->getMessage(), ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
            return [
                'success' => false,
                'imported' => $imported,
                'skipped' => $skipped,
                'message' => 'Import failed due to an error',
            ];
        }
    }

    /**
     * Import a text file list into checklist items
     *
     * @param string $filepath Path to the text file
     * @param int $task_id Task ID to associate checklist items with
     * @param int $import_limit the maximum number or items to import
     * @return array Array with import results ['success' => bool, 'imported' => int, 'skipped' => int, 'message' => string]
     */
    public function importTextChecklistTask($filepath, $task_id, $import_limit) {

        // Initialize counters
        $imported = 0;
        $skipped = 0;

        try {
            // Validate file exists
            if (!file_exists($filepath)) {
                Log::error("Text checklist import failed - file not found: {$filepath}", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File not found',
                ];
            }

            // Validate file is readable
            if (!is_readable($filepath)) {
                Log::error("Text checklist import failed - file not readable: {$filepath}", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File is not readable',
                ];
            }

            // Check if it's a text file by extension
            $file_extension = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
            if (!in_array($file_extension, ['txt', 'text'])) {
                Log::error("Text checklist import failed - invalid file type: {$file_extension}", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'Invalid file type. Only .txt files are supported',
                ];
            }

            // Read file content
            $content = file_get_contents($filepath);

            if ($content === false) {
                Log::error("Text checklist import failed - could not read file content", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'Could not read file content',
                ];
            }

            // Check if file is empty
            if (empty(trim($content))) {
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File is empty',
                ];
            }

            // Split content into lines
            $lines = explode("\n", $content);

            // Get starting position for new checklist items
            $last_checklist = \App\Models\Checklist::where('checklistresource_type', 'task')
                ->where('checklistresource_id', $task_id)
                ->orderBy('checklist_position', 'desc')
                ->first();

            $position = $last_checklist ? $last_checklist->checklist_position + 1 : 1;

            // Process each line
            foreach ($lines as $line) {
                // Skip if we've reached max items
                if ($imported >= $import_limit) {
                    $skipped++;
                    continue;
                }

                // Clean up the line
                $line = trim($line);

                // Skip empty lines
                if (empty($line)) {
                    $skipped++;
                    continue;
                }

                // Parse the line to extract text and status
                $parsed = $this->parseTextChecklistLine($line);

                if ($parsed['text']) {
                    // Create new checklist item
                    $checklist = new $this->checklists;
                    $checklist->checklist_creatorid = auth()->id();
                    $checklist->checklist_text = $parsed['text'];
                    $checklist->checklist_status = $parsed['status'];
                    $checklist->checklistresource_type = 'task';
                    $checklist->checklistresource_id = $task_id;
                    $checklist->checklist_position = $position;

                    if ($checklist->save()) {
                        $imported++;
                        $position++;
                    } else {
                        Log::error("Failed to save checklist item during text import", ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
                        $skipped++;
                    }
                } else {
                    $skipped++;
                }
            }

            return [
                'success' => true,
                'imported' => $imported,
                'skipped' => $skipped,
                'message' => "Successfully imported {$imported} checklist items",
            ];

        } catch (\Exception$e) {
            Log::error("Text checklist import failed with exception: " . $e->getMessage(), ['checklist.import.text', config('app.debug_ref'), basename(__FILE__), __line__]);
            return [
                'success' => false,
                'imported' => $imported,
                'skipped' => $skipped,
                'message' => 'Import failed due to an error',
            ];
        }
    }

    /**
     * Import a text file list into checklist items for leads
     *
     * @param string $filepath Path to the text file
     * @param int $lead_id Lead ID to associate checklist items with
     * @param int $import_limit the maximum number or items to import
     * @return array Array with import results ['success' => bool, 'imported' => int, 'skipped' => int, 'message' => string]
     */
    public function importTextChecklistLead($filepath, $lead_id, $import_limit) {

        //initialize counters
        $imported = 0;
        $skipped = 0;

        try {
            //validate file exists
            if (!file_exists($filepath)) {
                Log::error("Text checklist import failed - file not found: {$filepath}", ['checklist.import.text.lead', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File not found',
                ];
            }

            //validate file is readable
            if (!is_readable($filepath)) {
                Log::error("Text checklist import failed - file not readable: {$filepath}", ['checklist.import.text.lead', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File is not readable',
                ];
            }

            //check if it's a text file by extension
            $file_extension = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
            if (!in_array($file_extension, ['txt', 'text'])) {
                Log::error("Text checklist import failed - invalid file type: {$file_extension}", ['checklist.import.text.lead', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'Invalid file type. Only .txt files are supported',
                ];
            }

            //read file content
            $content = file_get_contents($filepath);

            if ($content === false) {
                Log::error("Text checklist import failed - could not read file content", ['checklist.import.text.lead', config('app.debug_ref'), basename(__FILE__), __line__]);
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'Could not read file content',
                ];
            }

            //check if file is empty
            if (empty(trim($content))) {
                return [
                    'success' => false,
                    'imported' => 0,
                    'skipped' => 0,
                    'message' => 'File is empty',
                ];
            }

            //split content into lines
            $lines = explode("\n", $content);

            //get starting position for new checklist items
            $last_checklist = \App\Models\Checklist::where('checklistresource_type', 'lead')
                ->where('checklistresource_id', $lead_id)
                ->where('checklist_clientid', request('access_control_customer_unique_id'))
                ->orderBy('checklist_position', 'desc')
                ->first();

            $position = $last_checklist ? $last_checklist->checklist_position + 1 : 1;

            //process each line
            foreach ($lines as $line) {
                //skip if we've reached max items
                if ($imported >= $import_limit) {
                    $skipped++;
                    continue;
                }

                //clean up the line
                $line = trim($line);

                //skip empty lines
                if (empty($line)) {
                    $skipped++;
                    continue;
                }

                //parse the line to extract text and status
                $parsed = $this->parseTextChecklistLine($line);

                if ($parsed['text']) {
                    //create new checklist item
                    $checklist = new $this->checklists;
                    $checklist->checklist_creatorid = auth()->id();
                    $checklist->checklist_text = $parsed['text'];
                    $checklist->checklist_status = $parsed['status'];
                    $checklist->checklistresource_type = 'lead';
                    $checklist->checklistresource_id = $lead_id;
                    $checklist->checklist_clientid = request('access_control_customer_unique_id');
                    $checklist->checklist_position = $position;

                    if ($checklist->save()) {
                        $imported++;
                        $position++;
                    } else {
                        Log::error("Failed to save checklist item during text import", ['checklist.import.text.lead', config('app.debug_ref'), basename(__FILE__), __line__]);
                        $skipped++;
                    }
                } else {
                    $skipped++;
                }
            }

            return [
                'success' => true,
                'imported' => $imported,
                'skipped' => $skipped,
                'message' => "Successfully imported {$imported} checklist items",
            ];

        } catch (\Exception$e) {
            Log::error("Text checklist import failed with exception: " . $e->getMessage(), ['checklist.import.text.lead', config('app.debug_ref'), basename(__FILE__), __line__]);
            return [
                'success' => false,
                'imported' => $imported,
                'skipped' => $skipped,
                'message' => 'Import failed due to an error',
            ];
        }
    }

    /**
     * Parse a single line of text to extract checklist text
     *
     * @param string $line The line to parse
     * @return array ['text' => string, 'status' => string]
     */
    private function parseTextChecklistLine($line) {

        $text = '';
        $status = 'pending';

        // Trim the line to handle whitespace at beginning and end
        $line = trim($line);

        // Pattern 3: - text or -text (dash with or without space)
        if (preg_match('/^\s*-\s*(.+)$/', $line, $matches)) {
            $text = trim($matches[1]);
        }
        // Pattern 4: * text or *text (asterisk with or without space)
        elseif (preg_match('/^\s*\*\s*(.+)$/', $line, $matches)) {
            $text = trim($matches[1]);
        }
        // Pattern 5: 1. text or 1.text (numbered list with or without space)
        elseif (preg_match('/^\s*\d+\.\s*(.+)$/', $line, $matches)) {
            $text = trim($matches[1]);
        }
        // Pattern 6: Plain text (no prefix)
        else {
            $text = trim($line);
        }

        // Additional cleanup - remove excessive whitespace from checklist text
        $text = preg_replace('/\s+/', ' ', $text);

        // Trim again to ensure clean text
        $text = trim($text);

        // Limit text length for database constraints
        if (strlen($text) > 500) {
            $text = substr($text, 0, 500);
        }

        return [
            'text' => $text,
            'status' => $status,
        ];
    }

}