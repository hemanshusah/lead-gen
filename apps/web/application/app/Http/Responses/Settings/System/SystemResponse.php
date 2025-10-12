<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for various controllers
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Settings\System;
use Illuminate\Contracts\Support\Responsable;

class SystemResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * various common responses
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //show the system information table
        if ($response == 'system-info') {

            config(['response.show' => true]);

            $html = view('pages/settings/sections/system/system-info', compact('settings', 'page', 'files_count', 'php_version', 'memory_limit', 'upload_max_filesize'))->render();

            $jsondata['dom_html'][] = array(
                'selector' => "#settings-wrapper",
                'action' => 'replace',
                'value' => $html);

            //ajax response
            return response()->json($jsondata);
        }

        //update the disc usage information
        if ($response == 'disc-usage') {

            //show disc usage section
            $jsondata['dom_visibility'][] = [
                'selector' => '#system-info-disc-usage',
                'action' => 'show',
            ];

            //update storage usage
            $jsondata['dom_html'][] = [
                'selector' => '#system-info-disc-usage-loading',
                'action' => 'replace',
                'value' => humanFileSize($disc['storage']),
            ];

            //update temp usage
            $jsondata['dom_html'][] = [
                'selector' => '#system-info-disc-usage-temp',
                'action' => 'replace',
                'value' => humanFileSize($disc['temp']),
            ];

            //update logs usage
            $jsondata['dom_html'][] = [
                'selector' => '#system-info-disc-usage-logs',
                'action' => 'replace',
                'value' => humanFileSize($disc['logs']),
            ];

            //update cache usage
            $jsondata['dom_html'][] = [
                'selector' => '#system-info-disc-usage-cache',
                'action' => 'replace',
                'value' => humanFileSize($disc['cache']),
            ];

            //update total usage
            $jsondata['dom_html'][] = [
                'selector' => '#system-info-disc-usage-total',
                'action' => 'replace',
                'value' => humanFileSize($disc['total']),
            ];

            //if we just cleaned up, show notification
            if (isset($cleaned) && $cleaned) {
                $jsondata['notification'] = [
                    'type' => 'success',
                    'value' => __('lang.request_has_been_completed'),
                ];
            }

            //ajax response
            return response()->json($jsondata);
        }
    }

}