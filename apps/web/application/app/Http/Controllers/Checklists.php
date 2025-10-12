<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for checklists
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Checklists\ChecklistCommentsResponse;
use App\Http\Responses\Checklists\ChecklistResponse;
use App\Http\Responses\Checklists\ImportChecklistResponse;
use App\Http\Responses\Checklists\IndexResponse;
use App\Http\Responses\Checklists\StoreResponse;
use App\Http\Responses\Common\UpdateErrorResponse;
use App\Imports\ChecklistImport;
use App\Models\Checklist;
use App\Models\Comment;
use App\Permissions\ChecklistPermissions;
use App\Repositories\ChecklistRepository;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Checklists extends Controller {

    /**
     * The checklist repository instance.
     */
    protected $checklistrepo;

    /**
     * The checklist permissions instance.
     */
    protected $checklistpermissions;

    /**
     * Inject dependecies
     */
    public function __construct(
        ChecklistRepository $checklistrepo,
        ChecklistPermissions $checklistpermissions
    ) {

        $this->checklistrepo = $checklistrepo;
        $this->checklistpermissions = $checklistpermissions;

    }

    /**
     * Display a listing of checklists
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //get resource details
        $checklistresource_type = request('checklistresource_type', '');
        $checklistresource_id = request('checklistresource_id', '');

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //get checklists
        request()->merge([
            'checklistresource_type' => $checklistresource_type,
            'checklistresource_id' => $checklistresource_id,
        ]);
        $checklists = $this->checklistrepo->search();

        //apply permissions to each checklist
        foreach ($checklists as $checklist) {
            $this->applyChecklistPermissions($checklist);
        }

        //get progress
        $progress = $this->checklistProgress($checklists);

        //check if user can manage checklists
        $can_manage_checklists = $this->checklistpermissions->check('create', $checklistresource_id);

        //reponse payload
        $payload = [
            'checklists' => $checklists,
            'progress' => $progress,
            'can_manage_checklists' => $can_manage_checklists,
        ];

        //generate a response
        return new IndexResponse($payload);
    }

    /**
     * import checklists via csv or excel file
     * @return \Illuminate\Http\Response
     */
    public function importChecklists() {

        //get resource details
        $checklistresource_type = request('checklistresource_type', '');
        $checklistresource_id = request('checklistresource_id', '');

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //limit checklists items to import
        $import_limit = 500;

        //check if attachments array exists
        if (!request('attachments') || !is_array(request('attachments'))) {
            abort(409, __('lang.no_file_uploaded'));
        }

        // Get the first (and only) uploaded file from attachments array
        $attachments = request('attachments');
        $directory = key($attachments);
        $filename = reset($attachments);

        // Build file path from temp directory where file was uploaded
        $file_path = BASE_DIR . "/storage/temp/$directory/$filename";

        // Check if file exists
        if (!file_exists($file_path)) {
            abort(409, __('lang.file_not_found'));
        }

        // Get file extension
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_extensions = ['xlsx', 'xls', 'csv', 'txt'];
        if (!in_array($extension, $allowed_extensions)) {
            abort(409, __('lang.invalid_file_type'));
        }

        // Initialize results
        $import_results = [
            'success' => false,
            'imported' => 0,
            'skipped' => 0,
            'message' => '',
        ];

        try {
            // Handle different file types
            if (in_array($extension, ['xlsx', 'xls', 'csv'])) {
                // Handle Excel/CSV files using ChecklistImport class
                $import = new ChecklistImport($checklistresource_type, $checklistresource_id, $import_limit);

                try {
                    $import->import($file_path);

                    $import_results = [
                        'success' => true,
                        'imported' => $import->getRowCount(),
                        'skipped' => $import->getSkippedCount(),
                        'message' => "Successfully imported {$import->getRowCount()} checklist items",
                    ];

                    if ($import->maxLimitReached()) {
                        $import_results['message'] .= __('lang.maximum_importing_limit_reached') . ": " . $import->getMaxItems();
                    }

                } catch (Exception $e) {
                    $import_results = [
                        'success' => false,
                        'imported' => 0,
                        'skipped' => 0,
                        'message' => 'Import failed: ' . $e->getMessage(),
                    ];
                    Log::error("Excel/CSV checklist import failed: " . $e->getMessage(), ['process' => '[checklist][import]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                }

            } elseif ($extension === 'txt') {
                // Handle text files using repository method
                $import_results = $this->checklistrepo->importTextChecklist($file_path, $checklistresource_type, $checklistresource_id, $import_limit);
            }

        } catch (Exception $e) {
            $import_results = [
                'success' => false,
                'imported' => 0,
                'skipped' => 0,
                'message' => 'Import failed due to an error',
            ];
            Log::error("Checklist import failed: " . $e->getMessage(), ['process' => '[checklist][import]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        }

        // Clean up - delete the temporary file
        if (Storage::exists("temp/$directory")) {
            Storage::deleteDirectory("temp/$directory");
        }

        // Get updated checklists and progress after import
        request()->merge([
            'checklistresource_type' => $checklistresource_type,
            'checklistresource_id' => $checklistresource_id,
        ]);
        $checklists = $this->checklistrepo->search();
        foreach ($checklists as $checklist) {
            $this->applyChecklistPermissions($checklist);
        }

        //get new progress
        $progress = $this->checklistProgress($checklists);

        //check if user can manage checklists
        $can_manage_checklists = $this->checklistpermissions->check('create', $checklistresource_id);

        //reponse payload
        $payload = [
            'import_results' => $import_results,
            'checklists' => $checklists,
            'progress' => $progress,
            'can_manage_checklists' => $can_manage_checklists,
        ];

        //generate a response
        return new ImportChecklistResponse($payload);
    }

    /**
     * Store a newly created checklist comment
     * @return \Illuminate\Http\Response
     */
    public function storeChecklistComment(CommentRepository $commentrepo) {

        //validate input
        if (!request()->filled('checklist-comment')) {
            abort(409, __('lang.comment_is_required'));
        }

        //get checklist id from form
        $checklist_id = request('checklist-comments-checklist-id');

        //get the checklist
        $checklist = \App\Models\Checklist::Where('checklist_id', $checklist_id)->first();

        //checklist must exist
        if (!$checklist) {
            abort(404);
        }

        //resources
        $checklistresource_type = $checklist->checklistresource_type;
        $checklistresource_id = $checklist->checklistresource_id;

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //create the comment
        $comment = new \App\Models\Comment();
        $comment->comment_creatorid = auth()->id();
        $comment->comment_text = convertTextareaToHtml(request('checklist-comment'));
        $comment->commentresource_type = 'checklist';
        $comment->commentresource_id = $checklist_id;
        $comment->save();

        //get complete comment
        $comments = $commentrepo->search($comment->comment_id);
        $comment = $comments->first();

        //get comments for this checklist
        $comments = $commentrepo->search();

        //apply permissions to each comment
        foreach ($comments as $comment) {
            $this->applyCommentPermissions($comment);
        }

        //get the checklist again
        $checklist = \App\Models\Checklist::Where('checklist_id', $checklist_id)->first();

        //reponse payload
        $payload = [
            'checklist' => $checklist,
            'checklist_id' => $checklist_id,
        ];

        //show the form
        return new ChecklistCommentsResponse($payload);
    }


    /**
     * Remove the specified checklist comment
     * @return \Illuminate\Http\Response
     */
    public function destroyChecklistComment($id) {

        //get the comment
        $comment = \App\Models\Comment::Where('comment_id', $id)->first();

        //comment must exist
        if (!$comment) {
            abort(404);
        }

        //get checklist
        $checklist = \App\Models\Checklist::Where('checklist_id', $comment->commentresource_id)->first();

        //checklist must exist
        if (!$checklist) {
            abort(404);
        }

        //resources
        $checklistresource_type = $checklist->checklistresource_type;
        $checklistresource_id = $checklist->checklistresource_id;

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //delete comment
        $comment->delete();

        //ajax response
        $jsondata['dom_visibility'][] = [
            'selector' => "#checklist_comment_$id",
            'action' => 'hide-remove',
        ];

        //response
        return response()->json($jsondata);
    }

    /**
     * Toggle checklist status
     * @return \Illuminate\Http\Response
     */
    public function toggleChecklistStatus(ChecklistRepository $checklistrepo) {

        //get checklist id
        $id = request()->route('checklistid');

        //get checklist
        $checklist = \App\Models\Checklist::Where('checklist_id', $id)->first();

        //checklist must exist
        if (!$checklist) {
            abort(404);
        }

        //resources
        $checklistresource_type = $checklist->checklistresource_type;
        $checklistresource_id = $checklist->checklistresource_id;

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //toggle status
        if (request("card_checklist.$id") == 'on') {
            $checklist->checklist_status = 'completed';
        } else {
            $checklist->checklist_status = 'pending';
        }

        //save
        $checklist->save();

        //get updated checklists
        request()->merge([
            'checklistresource_type' => $checklist->checklistresource_type,
            'checklistresource_id' => $checklist->checklistresource_id,
        ]);
        $checklists = $checklistrepo->search();

        //reponse payload
        $payload = [
            'progress' => $this->checklistProgress($checklists),
        ];

        //show the form
        return new ChecklistResponse($payload);
    }

    /**
     * Remove the specified checklist
     * @return \Illuminate\Http\Response
     */
    public function deleteChecklist(ChecklistRepository $checklistrepo) {

        //get checklist id
        $checklist_id = request()->route('checklistid');

        //get checklist
        $checklist = \App\Models\Checklist::Where('checklist_id', $checklist_id)->first();

        //checklist must exist
        if (!$checklist) {
            abort(404);
        }

        //resources
        $checklistresource_type = $checklist->checklistresource_type;
        $checklistresource_id = $checklist->checklistresource_id;

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //delete
        $checklist->delete();

        //delete checklist comments
        \App\Models\Comment::Where('commentresource_type', 'checklist')->Where('commentresource_id', $checklist_id)->delete();

        //get updated checklists
        request()->merge([
            'checklistresource_type' => $checklistresource_type,
            'checklistresource_id' => $checklistresource_id,
        ]);
        $checklists = $checklistrepo->search();

        //reponse payload
        $payload = [
            'progress' => $this->checklistProgress($checklists),
            'action' => 'delete',
            'checklistid' => $checklist_id,
        ];

        //show the form
        return new ChecklistResponse($payload);
    }

    /**
     * update checklist item positions
     * @return \Illuminate\Http\Response
     */
    public function updateChecklistPositions() {

        //update position
        $position = 0;
        if (is_array(request('card_checklist'))) {
            foreach (request('card_checklist') as $key => $value) {
                if (is_numeric($key)) {
                    \App\Models\Checklist::where('checklist_id', $key)
                        ->update(['checklist_position' => $position]);
                }
                $position++;
            }
        }

        //return success
        return response()->json(['success' => true]);
    }

    /**
     * update a checklist
     * @return \Illuminate\Http\Response
     */
    public function Update(ChecklistRepository $checklistrepo, $id) {

        //get checklist
        $checklist = \App\Models\Checklist::Where('checklist_id', $id)->first();

        //checklist must exist
        if (!$checklist) {
            abort(404);
        }

        //resources
        $checklistresource_type = $checklist->checklistresource_type;
        $checklistresource_id = $checklist->checklistresource_id;

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //validate
        $validator = Validator::make(request()->all(), [
            'checklist_text' => [
                'required',
            ],
        ]);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }
            return new UpdateErrorResponse([
                'type' => 'update-checklist',
                'error_message' => $messages,
            ]);
        }

        //update checklist
        $checklist->checklist_text = request('checklist_text');
        $checklist->save();

        //get refreshed checklist
        $checklists = $checklistrepo->search($id);
        $this->applyChecklistPermissions($checklists->first());

        return response()->json(array(
            'skip_dom_reset' => true,
        ));
    }

    /**
     * store a new checklist
     * @return \Illuminate\Http\Response
     */
    public function Store(ChecklistRepository $checklistrepo) {

        //get resource details
        $checklistresource_type = request('checklistresource_type', '');
        $checklistresource_id = request('checklistresource_id', '');

        //check permissions
        if (!$this->checklistpermissions->gneral($checklistresource_type, $checklistresource_id)) {
            abort(403);
        }

        //validate
        $validator = Validator::make(request()->all(), [
            'checklist_text' => [
                'required',
            ],
        ]);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }
            return new UpdateErrorResponse([
                'type' => 'store-checklist',
                'error_message' => $messages,
            ]);
        }

        //we are creating a new list
        request()->merge([
            'checklistresource_type' => $checklistresource_type,
            'checklistresource_id' => $checklistresource_id,
            'checklist_text' => request('checklist_text'),
        ]);

        //get next position
        if ($last = \App\Models\Checklist::Where('checklistresource_type', $checklistresource_type)
            ->Where('checklistresource_id', $checklistresource_id)
            ->orderBy('checklist_position', 'desc')
            ->first()) {
            $position = $last->checklist_position + 1;
        } else {
            //default position
            $position = 1;
        }

        //save checklist
        $checklist_id = $checklistrepo->create($position);

        //get complete checklist
        $checklists = $checklistrepo->search($checklist_id);
        $this->applyChecklistPermissions($checklists->first());

        //get updated checklists for progress
        request()->merge([
            'checklistresource_type' => $checklistresource_type,
            'checklistresource_id' => $checklistresource_id,
        ]);
        $all_checklists = $checklistrepo->search();

        //check if user can manage checklists
        $can_manage_checklists = $this->checklistpermissions->check('create', $checklistresource_id);

        //reponse payload
        $payload = [
            'checklists' => $checklists,
            'progress' => $this->checklistProgress($all_checklists),
            'can_manage_checklists' => $can_manage_checklists,
        ];

        //show the form
        return new StoreResponse($payload);
    }

    /**
     * apply permissions to checklists
     * @param object $checklist instance of the checklist model object
     * @return object
     */
    private function applyChecklistPermissions($checklist = '') {

        //sanity - make sure this is a valid object
        if ($checklist instanceof \App\Models\Checklist) {
            //delete permissions
            $checklist->permission_edit_delete_checklist = $this->checklistpermissions->check('edit-delete', $checklist);
        }
    }

    /**
     * apply permissions to each comment
     * @param object $comment instance of the comment model object
     * @return object
     */
    private function applyCommentPermissions($comment = '') {

        //sanity - make sure this is a valid object
        if ($comment instanceof \App\Models\Comment) {

            if (auth()->user()->is_admin || $comment->comment_creatorid == auth()->id()) {
                $comment->permission_delete_comment = true;
                return;
            }
            //delete permissions
            $comment->permission_delete_comment = false; // Basic permission for now
        }
    }

    /**
     * create the checklists progress bar data
     * @param object checklists instance of the checklists model object
     * @return object
     */
    private function checklistProgress($checklists) {

        $progress['bar'] = 'w-0'; //css width %
        $progress['completed'] = '---';

        //sanity - make sure this is a valid checklists object
        if ($checklists instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $count = 0;
            $completed = 0;
            foreach ($checklists as $checklist) {
                if ($checklist->checklist_status == 'completed') {
                    $completed++;
                }
                $count++;
            }
            //finial
            $progress['completed'] = "$completed/$count";
            if ($count > 0) {
                $percentage = round(($completed / $count) * 100);
                $progress['bar'] = "w-$percentage";
            }
        }

        return $progress;
    }

}