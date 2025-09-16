<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for starred
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Starred\IndexResponse;
use App\Http\Responses\Starred\StatusResponse;
use Illuminate\Http\Request;

class Starred extends Controller {

    /**
     * Display starred items
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //get the starred type from request
        $type = request('type', 'project-comments');

        //for project comments
        if ($type == 'project-comments') {
            return $this->projectComments();
        }

        //for notes
        if ($type == 'notes') {
            return $this->notes();
        }

        //for clients
        if ($type == 'clients') {
            return $this->clients();
        }

        //for projects
        if ($type == 'projects') {
            return $this->projects();
        }

        //for tasks
        if ($type == 'tasks') {
            return $this->tasks();
        }

        //default response for unknown types
        abort(404);
    }

/**
 * Get project comments for starred
 * @return \Illuminate\Http\Response
 */
    private function projectComments() {

        //get all starred entries for this user
        $starred = \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'project-comments')
            ->with(['starredresource.client', 'starredresource.comments' => function ($query) {
                $query->orderBy('comment_created', 'desc')->limit(1);
            }])
            ->get();

        //get sorting parameters
        $orderby = request('orderby', 'project_title');
        $sortorder = request('sortorder', 'asc');

        //sort the collection based on project relationship
        if ($orderby == 'project_title') {
            $starred = $starred->sortBy(function ($item) {
                return $item->starredresource->project_title ?? '';
            }, SORT_REGULAR, $sortorder == 'desc');
        } elseif ($orderby == 'recent_activity') {
            //for recent activity, we want newest first (descending)
            $starred = $starred->sortByDesc(function ($item) {
                if ($item->starredresource && $item->starredresource->comments->first()) {
                    return $item->starredresource->comments->first()->comment_created;
                }
                return '0000-00-00 00:00:00'; //return old date for items with no comments
            });
        }

        //convert to projects collection for the view
        $projects = collect();
        foreach ($starred as $item) {
            if ($item->starredresource) {
                //get unique commenters for this project
                $commenters = $item->starredresource->comments()
                    ->with('creator')
                    ->select('comment_creatorid')
                    ->distinct()
                    ->get()
                    ->pluck('creator')
                    ->filter();

                //add commenters to project
                $item->starredresource->commenters = $commenters;

                //add starred info to project
                $item->starredresource->starred_uniqueid = $item->starred_uniqueid;

                //add to projects collection
                $projects->push($item->starredresource);
            }
        }

        //reponse payload
        $payload = [
            'projects' => $projects,
            'response' => 'project-comments',
        ];

        //show the view
        return new IndexResponse($payload);
    }

/**
 * Get notes for starred
 * @return \Illuminate\Http\Response
 */
    private function notes() {

        //get all starred entries for this user for notes
        $starred = \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'note')
            ->with(['starredresource.creator', 'starredresource.noteresource'])
            ->get();

        //get sorting parameters
        $orderby = request('orderby', 'note_title');
        $sortorder = request('sortorder', 'asc');

        //sort the collection based on note properties
        if ($orderby == 'note_title') {
            $starred = $starred->sortBy(function ($item) {
                return $item->starredresource->note_title ?? '';
            }, SORT_REGULAR, $sortorder == 'desc');
        } elseif ($orderby == 'note_updated') {
            //for recent activity, we want newest first (descending)
            $starred = $starred->sortByDesc(function ($item) {
                if ($item->starredresource) {
                    return $item->starredresource->note_updated ?? $item->starredresource->note_created;
                }
                return '0000-00-00 00:00:00';
            });
        }

        //convert to notes collection for the view
        $notes = collect();
        foreach ($starred as $item) {
            if ($item->starredresource) {
                //add starred info to note
                $item->starredresource->starred_uniqueid = $item->starred_uniqueid;

                //add to notes collection
                $notes->push($item->starredresource);
            }
        }

        //reponse payload
        $payload = [
            'notes' => $notes,
            'response' => 'notes',
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Toggle star/unstar status of a resource
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus() {

        //get request parameters
        $action = request('action'); //star or unstar
        $resource_type = request('resource_type'); //e.g., project
        $resource_id = request('resource_id');

        //validate parameters
        if (!in_array($action, ['star', 'unstar']) || !$resource_type || !$resource_id) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //for star action
        if ($action == 'star') {
            //check if already exists
            $exists = \App\Models\Starred::where('starred_userid', auth()->id())
                ->where('starred_resource_type', $resource_type)
                ->where('starred_resource_id', $resource_id)
                ->exists();

            if (!$exists) {
                //create new starred entry
                $starred = new \App\Models\Starred();
                $starred->starred_uniqueid = str_unique();
                $starred->starred_userid = auth()->id();
                $starred->starred_resource_type = $resource_type;
                $starred->starred_resource_id = $resource_id;
                $starred->save();
            }
        }

        //for unstar action
        if ($action == 'unstar') {
            //delete the starred entry
            \App\Models\Starred::where('starred_userid', auth()->id())
                ->where('starred_resource_type', $resource_type)
                ->where('starred_resource_id', $resource_id)
                ->delete();
        }

        //reponse payload
        $payload = [
            'action' => $action,
            'id' => $resource_id,
        ];

        //generate a response
        return new StatusResponse($payload);
    }

    /**
     * Get clients for starred
     * @return \Illuminate\Http\Response
     */
    private function clients() {

        //get all starred entries for this user for clients
        $starred = \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'client')
            ->with(['starredresource.users', 'starredresource.category'])
            ->get();

        //get sorting parameters
        $orderby = request('orderby', 'client_company_name');
        $sortorder = request('sortorder', 'asc');

        //sort the collection based on client properties
        if ($orderby == 'client_company_name') {
            $starred = $starred->sortBy(function ($item) {
                return $item->starredresource->client_company_name ?? '';
            }, SORT_REGULAR, $sortorder == 'desc');
        } elseif ($orderby == 'last_seen') {
            //for last seen, we want newest first (descending)
            $starred = $starred->sortByDesc(function ($item) {
                if ($item->starredresource) {
                    return $item->starredresource->last_seen_user_time ?? '0000-00-00 00:00:00';
                }
                return '0000-00-00 00:00:00';
            });
        }

        //convert to clients collection for the view
        $clients = collect();
        foreach ($starred as $item) {
            if ($item->starredresource) {
                //add starred info to client
                $item->starredresource->starred_uniqueid = $item->starred_uniqueid;

                //add to clients collection
                $clients->push($item->starredresource);
            }
        }

        //reponse payload
        $payload = [
            'clients' => $clients,
            'response' => 'clients',
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Get projects for starred
     * @return \Illuminate\Http\Response
     */
    private function projects() {

        //get all starred entries for this user for projects
        $starred = \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'project')
            ->with(['starredresource.client', 'starredresource.category'])
            ->get();

        //get sorting parameters
        $orderby = request('orderby', 'project_title');
        $sortorder = request('sortorder', 'asc');

        //sort the collection based on project properties
        if ($orderby == 'project_title') {
            $starred = $starred->sortBy(function ($item) {
                return $item->starredresource->project_title ?? '';
            }, SORT_REGULAR, $sortorder == 'desc');
        } elseif ($orderby == 'latest_activity') {
            //for latest activity, we want newest first (descending)
            $starred = $starred->sortByDesc(function ($item) {
                if ($item->starredresource) {
                    return $item->starredresource->latest_activity->date ?? '';
                }
                return '0000-00-00 00:00:00';
            });
        }

        //convert to projects collection for the view
        $projects = collect();
        foreach ($starred as $item) {
            if ($item->starredresource) {
                //add starred info to project
                $item->starredresource->starred_uniqueid = $item->starred_uniqueid;

                //add to projects collection
                $projects->push($item->starredresource);
            }
        }

        //reponse payload
        $payload = [
            'projects' => $projects,
            'response' => 'projects',
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Get tasks for starred
     * @return \Illuminate\Http\Response
     */
    private function tasks() {

        //get all starred entries for this user for tasks
        $starred = \App\Models\Starred::where('starred_userid', auth()->id())
            ->where('starred_resource_type', 'task')
            ->with(['starredresource.project', 'starredresource.project.client', 'starredresource.assigned', 'starredresource.status'])
            ->get();

        //get sorting parameters
        $orderby = request('orderby', 'task_title');
        $sortorder = request('sortorder', 'asc');

        //sort the collection based on task properties
        if ($orderby == 'task_title') {
            $starred = $starred->sortBy(function ($item) {
                return $item->starredresource->task_title ?? '';
            }, SORT_REGULAR, $sortorder == 'desc');
        } elseif ($orderby == 'latest_activity') {
            //for latest activity, we want newest first (descending)
            $starred = $starred->sortByDesc(function ($item) {
                if ($item->starredresource) {
                    return $item->starredresource->latest_activity->date ?? '';
                }
                return '0000-00-00 00:00:00';
            });
        }

        //convert to tasks collection for the view
        $tasks = collect();
        foreach ($starred as $item) {
            if ($item->starredresource) {
                //add starred info to task
                $item->starredresource->starred_uniqueid = $item->starred_uniqueid;

                //add to tasks collection
                $tasks->push($item->starredresource);
            }
        }

        //reponse payload
        $payload = [
            'tasks' => $tasks,
            'response' => 'tasks',
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Remove item from starred feed
     *
     * @param string $id starred_uniqueid
     * @return \Illuminate\Http\Response
     */
    public function removeFromFeed($id) {

        //delete the starred entry
        \App\Models\Starred::where('starred_uniqueid', $id)
            ->where('starred_userid', auth()->id())
            ->delete();

    }

}