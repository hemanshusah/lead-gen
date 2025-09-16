<?php

/** ---------------------------------------------------------------------------------------------------
 * Email Cron
 * Send emails that are stored in the email queue (database)
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *      - the scheduler is set to run this every minuted
 *      - the schedler itself is evoked by the signle cronjob set in cpanel (which runs every minute)
 * @package    Grow CRM
 * @author     NextLoop
 *-----------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs;
use App\Mail\SendTicketsImap;
use Illuminate\Support\Facades\Mail;
use Log;

class ImapTicketRepliesCron {

    public function __invoke() {

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

        //delete emails without an email address
        \App\Models\EmailQueue::Where('emailqueue_to', '')->delete();

        Log::info("IMAP - cronjob for sending support ticket replies via imap email - started", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        /**
         * Send emails
         *   These emails are being sent every minute. You can set a higher or lower sending limit.
         */
        $limit = 5;
        if ($emails = \App\Models\EmailQueue::where(function ($query) {
            $query->where('emailqueue_type', 'imap-ticket-reply')
            ->where('emailqueue_status', 'new');
        })->orWhere(function ($query) {
            $query->where('emailqueue_type', 'imap-ticket-reply')
            ->where('emailqueue_status', 'processing')
            ->where('emailqueue_attempts', '<', 4);
        })->take($limit)->get()) {

            Log::info("IMAP - some email have been found in the queue - will now process", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            //mark all emails in the batch as processing - to avoid batch duplicates/collisions
            foreach ($emails as $email) {
                $email->update([
                    'emailqueue_status' => 'processing',
                    'emailqueue_started_at' => now(),
                ]);
            }

            //now process
            foreach ($emails as $email) {

                //validation - missing ticketreply id
                if (!is_numeric($email->emailqueue_resourceid)) {
                    Log::error("IMAP - this queued email is missing the emailqueue_resourceid to reference the ticket_reply. will now delete the email from the queue", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    \App\Models\EmailQueue::Where('emailqueue_id', $email->emailqueue_id)->delete();
                    continue;
                }

                //validation - get the reply
                if (!$reply = \App\Models\TicketReply::Where('ticketreply_id', $email->emailqueue_resourceid)->first()) {
                    Log::error("IMAP - the original ticket_reply for this queued email nolonger exists - will now delete the email from the queue", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    \App\Models\EmailQueue::Where('emailqueue_id', $email->emailqueue_id)->delete();
                    continue;
                }

                //validation - get the ticket
                if (!$ticket = \App\Models\Ticket::Where('ticket_id', $reply->ticketreply_ticketid)->first()) {
                    Log::error("IMAP - the original ticket for this queued ticket_reply email nolonger exists - will now delete the email from the queue", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    \App\Models\EmailQueue::Where('emailqueue_id', $email->emailqueue_id)->delete();
                    continue;
                }

                //get the payload
                if (!$data = $this->getPayload($email, $ticket, $reply)) {
                    Log::error("IMAP - unable to generate the payload for sending the emeil - will now delete the email from the queue", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    \App\Models\EmailQueue::Where('emailqueue_id', $email->emailqueue_id)->delete();
                    continue;
                }

                //send the email (only to a valid email address)

                //add this in the namespace at the top - ( use Exception; )
                try {

                    //send email
                    $mail = Mail::to($data['to'])->send(new SendTicketsImap($data));

                    //update ticket reply with message is
                    $reply->ticketreply_imap_sender_email_id = $data['message_id'];
                    $reply->save();

                    //log email
                    $log = new \App\Models\EmailLog();
                    $log->emaillog_email = $email->emailqueue_to;
                    $log->emaillog_subject = $email->emailqueue_subject;
                    $log->emaillog_body = $email->emailqueue_message;
                    $log->save();

                    //delete from queue
                    \App\Models\EmailQueue::Where('emailqueue_id', $email->emailqueue_id)->delete();

                    //delete temp blade view
                    if($data['temp_blade_view_path'] != '' && is_file($data['temp_blade_view_path'])){
                       @unlink($blade_view['temp_blade_view_path']);
                    }

                    Log::info("IMAP - email has been sent to (" . $data['to'] . "). email message id: (" . $data['message_id'] . ")", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                } catch (Exception $e) {
                    $error_message = $e->getMessage();

                    //increase attempts
                    $email->emailqueue_attempts = $email->emailqueue_attempts + 1;
                    $email->save();
                    Log::error("IMAP - error sending email. error: $error_message", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                    //if max sending attempts have been reached
                    if ($email->emailqueue_attempts >= 3) {
                        Log::error("IMAP - maximum sending attempts for this email have been reached. will now mark it as failed", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                        $email->emailqueue_status = 'failed';
                        $email->emailqueue_notes = __('lang.email_sending_error') . ' (' . __('lang.error_log') . ': ' . config('app.debug_ref') . ')';
                        $email->save();
                    }
                }

            }

            Log::info("IMAP - cronjob for sending support ticket replies via imap email - completed", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            //reset last cron run data
            \App\Models\Settings::where('settings_id', 1)
                ->update([
                    'settings_cronjob_has_run' => 'yes',
                    'settings_cronjob_last_run' => now(),
                ]);
        }

    }

    /**
     * get the following items
     *  - reference email id's for previous emails linked to this ticket/reply
     *  - get the in-reply-to value from the latest email that came in
     *  - prepare the data payload for sending email
     *
     * Category Table Column Mapping
     * These are additional columns in the category table that are used for tickets
     *    -------------------------------------------
     *    imap_status              - category_meta_4
     *    email                    - category_meta_5
     *    -------------------------------------------
     *
     * @return array
     */
    public function getPayload($email, $ticket, $reply) {

        Log::info("IMAP - preparing email payload - started", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //defaults
        $in_reply_to = $ticket->ticket_imap_sender_email_id;
        $references = [];
        $marker = '<div class="nextloop-start-of-crm-reply"></div>';

        //get the ticket category and validate that it is enabled for imap
        if (!$category = \App\Models\Category::Where('category_type', 'ticket')->Where('category_id', $ticket->ticket_categoryid)->first()) {
            Log::error("IMAP - the ticket category could not be loaded", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //validate the email address to send
        if ($ticket->ticket_imap_sender_email_address == '') {
            Log::error("IMAP - the senders email address is missing from the original ticket", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //validate imap status
        $imap_status = $category->category_meta_4;
        $imap_from_email_address = $category->category_meta_5;
        if ($imap_status != 'enabled' || $imap_from_email_address == '') {
            Log::error("IMAP - iamp is disabled on this ticket category or it is missing a from_email_addrees", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //get the latest reply with a sender email_id
        if ($last_reply = \App\Models\TicketReply::Where('ticketreply_ticketid', $ticket->ticket_id)
            ->Where('ticketreply_source', 'email')
            ->Where('ticketreply_imap_sender_email_id', '!=', '')
            ->orderBy('ticketreply_id', 'desc')
            ->first()) {
            $in_reply_to = $last_reply->ticketreply_imap_sender_email_id;
        }

        //generate the references
        if ($ticket->ticket_imap_sender_email_id != '') {
            $references[] = $ticket->ticket_imap_sender_email_id;
        }
        if ($ticket_replies = \App\Models\TicketReply::Where('ticketreply_ticketid', $ticket->ticket_id)->get()) {
            foreach ($ticket_replies as $ticket_reply) {
                if ($ticket_reply->ticketreply_imap_sender_email_id != '') {
                    $references[] = $ticket_reply->ticketreply_imap_sender_email_id;
                }
            }
        }

        //create a message id for this messahe
        $from_domain = strrchr($imap_from_email_address, '@');
        $message_id = uniqid('', true) . '@' . substr($from_domain, 1);

        //get attachments
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'ticketreply')->Where('attachmentresource_id', $reply->ticketreply_id)->get();

        //the message body
        $email_body = $marker . $reply->ticketreply_text;
        $email_body = $this->replaceEmbeddedImages($email_body);

        //create a temp email blade view
        if (!$blade_view = $this->tempBladeView($email_body)) {
            return false;
        }

        //set the imap settings for this
        $data = [
            'to' => $ticket->ticket_imap_sender_email_address,
            'from' => $imap_from_email_address,
            'from_name' => config('system.settings_email_from_name'),
            'subject' => 'Re: ' . $ticket->ticket_subject,
            'message_id' => $message_id,
            'in_reply_to' => $in_reply_to,
            'references' => $references,
            'attachments' => $attachments,
            'body' => $email_body,
            'temp_blade_view' => $blade_view['temp_blade_view'],
            'temp_blade_view_path' => $blade_view['temp_blade_view_path'],
        ];

        Log::info("IMAP - preparing email payload - finished", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'data' => $data]);

        return $data;
    }

    /**
     * replace all image src with the laravel inline images genaration code
     *
     * replace this:
     *
     * <img src="storage/files/foo/bar.jpg">
     *
     * with this:
     *
     * <img src="{{ $message->embed('/home/domain.com/storage/files/foo/bar.jpg') }}">
     *
     * @return bool
     */
    public function replaceEmbeddedImages($email_body = '') {

        Log::info("IMAP - replacing embedded imaged - started", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //replacement pattern
        $pattern = '/<img\s+src="([^"]+)"([^>]*)>/i';
        $replacement = '<img src="{{ $message->embed(\'' . BASE_DIR . '/$1\') }}"$2>';

        $email_body = preg_replace($pattern, $replacement, $email_body);

        Log::info("IMAP - replacing embedded imaged - ended", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        return $email_body;

    }

    /**
     * create a temp blade view for this email. we are doing this to get laravel to deal with inline images correctly
     *
     * @return bool
     */
    public function tempBladeView($body) {

        Log::info("IMAP - creating a temp blade view for this email - started", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //do somethings
        $directory = path_storage('temp');

        //temp file name
        $temp_blade_view = strtolower(str_alphnumeric(20));

        $temp_blade_view_path = $directory . '/' . $temp_blade_view . '.blade.php';

        //save body to temp file
        if (file_put_contents($temp_blade_view_path, $body)) {
            Log::info("IMAP - creating a temp blade view ($temp_blade_view) for this email - completed", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return [
                'temp_blade_view' => $temp_blade_view,
                'temp_blade_view_path' => $temp_blade_view_path,                
            ];
        } else {
            Log::info("IMAP - creating a temp blade view for this email failed", ['process' => '[imap-ticket-replies-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}