<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [log] process for the leads
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Leads;
use Illuminate\Contracts\Support\Responsable;

class LogResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //full payload array
        $payload = $this->payload;

        /** -------------------------------------------------------------------------
         * show the main logs page
         * -------------------------------------------------------------------------*/
        if ($type == 'show-logs') {

            config(['response.show' => true]);

            $html = view('pages/lead/content/logs/show', compact('logs', 'lead'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#card-leads-left-panel',
                'action' => 'replace',
                'value' => $html,
            ];
        }

        /** -------------------------------------------------------------------------
         * store new log - append to list
         * -------------------------------------------------------------------------*/
        if ($type == 'store-log') {

            config(['response.store' => true]);

            //render the new log
            $html = view('pages/lead/content/logs/log', compact('logs', 'lead'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#lead-logs-container',
                'action' => 'prepend',
                'value' => $html,
            ];

            //reset tinymce
            $jsondata['tinymce_reset'][] = [
                'selector' => 'card-comment-tinmyce',
            ];

            //reset form
            $jsondata['dom_val'][] = [
                'selector' => '#lead_log_type',
                'value' => 'general',
            ];

            //hide editor
            $jsondata['dom_visibility'][] = [
                'selector' => '#card-comment-tinmyce-container',
                'action' => 'hide',
            ];

            //show placeholder
            $jsondata['dom_visibility'][] = [
                'selector' => '#card-coment-placeholder-input-container',
                'action' => 'show',
            ];

            //remove no results found
            $jsondata['dom_visibility'][] = [
                'selector' => '.x-no-result',
                'action' => 'hide',
            ];
            
            $jsondata['skip_dom_reset'] = true;
            $jsondata['skip_dom_tinymce'] = true;

            //success notification
            $jsondata['notification'] = [
                'type' => 'success',
                'value' => __('lang.request_has_been_completed'),
            ];
        }

        /** -------------------------------------------------------------------------
         * show the form to 'edit log' wrapper
         * -------------------------------------------------------------------------*/
        if ($type == 'edit-log') {

            config(['response.edit' => true]);

            //render edit form
            $html = view('pages/lead/content/logs/edit', compact('log', 'lead'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#lead_log_editing_wrapper_' . $log->lead_log_uniqueid,
                'action' => 'replace',
                'value' => $html,
            ];

            //show edit wrapper
            $jsondata['dom_visibility'][] = [
                'selector' => '#lead_log_editing_wrapper_' . $log->lead_log_uniqueid,
                'action' => 'show',
            ];

            //hide original log
            $jsondata['dom_visibility'][] = [
                'selector' => '#lead_log_container_' . $log->lead_log_uniqueid,
                'action' => 'hide',
            ];
        }

        /** -------------------------------------------------------------------------
         * the log has been updated
         * -------------------------------------------------------------------------*/
        if ($type == 'update-log') {

            config(['response.update' => true]);

            //render updated log
            $html = view('pages/lead/content/logs/log-ajax', compact('log', 'lead'))->render();
            $jsondata['dom_html'][] = [
                'selector' => '#lead_log_container_' . $log->lead_log_uniqueid,
                'action' => 'replace-with',
                'value' => $html,
            ];

            //hide edit wrapper
            $jsondata['dom_visibility'][] = [
                'selector' => '#lead_log_editing_wrapper_' . $log->lead_log_uniqueid,
                'action' => 'hide',
            ];

            //success notification
            $jsondata['notification'] = [
                'type' => 'success',
                'value' => __('lang.request_has_been_completed'),
            ];
        }

        /** -------------------------------------------------------------------------
         * delete the log
         * -------------------------------------------------------------------------*/
        if ($type == 'delete-log') {

            config(['response.destroy' => true]);

            //remove log container
            $jsondata['dom_visibility'][] = [
                'selector' => '#lead_log_container_' . $log->lead_log_uniqueid,
                'action' => 'fadeout-remove',
            ];

            $jsondata['skip_dom_reset'] = true;
            $jsondata['skip_dom_tinymce'] = true;

        }

        //ajax response
        return response()->json($jsondata);
    }
}