<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for templates
 *
 * Category Table Column Mapping
 * These are additional columns in the category table that are used for tickets
 *    -------------------------------------------
 *    imap_status              - category_meta_4
 *    email                    - category_meta_5
 *    username                 - category_meta_6
 *    password                 - category_meta_7
 *    host                     - category_meta_8
 *    port                     - category_meta_9
 *    encryption               - category_meta_10
 *    post_action              - category_meta_11
 *    mailbox_id               - category_meta_12
 *    last_fetched_mail_id     - category_meta_13
 *    fecthing_status          - category_meta_14
 *    last_fetched_timestamp   - category_meta_22
 *    last_fetched_date        - category_meta_2
 *    last_fetched_count       - category_meta_23
 *    email_total_count        - category_meta_24
 *    -------------------------------------------
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;
use App\Repositories\AttachmentRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
use Log;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Exceptions\AuthFailedException;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;

class TicketsImapRepository {

    protected $data;
    protected $userrepo;
    protected $eventrepo;
    protected $trackingrepo;
    protected $attachmentrepo;

    /**
     * Inject dependecies
     */
    public function __construct(
        UserRepository $userrepo,
        EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo,
        AttachmentRepository $attachmentrepo) {

        $this->userrepo = $userrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->trackingrepo = $trackingrepo;
    }

    /** ----------------------------------------------------
     * connect to imap server and get latest messages
     * @param array $data imap connection payload
     * @return bool
     * ---------------------------------------------------*/
    public function fetchEmails($data = [], $category = []) {

        $payload = [];

        Log::info("IMAP - fetching new emails for tickets in category id (" . $category->category_id . ") - started", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'data' => $data]);

        //validate data
        if (!$this->validateData($data)) {
            Log::error("IMAP - fetching new emails- failed", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //connect to server and fetch from inbox
        try {

            Log::info("IMAP - attempting to connect to the imap email server.....", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            $imap = new ClientManager();

            $client = $imap->make([
                'host' => $data['host'],
                'port' => $data['port'],
                'encryption' => $data['encryption'],
                'username' => $data['username'],
                'password' => $data['password'],
                'validate_cert' => false,
                'protocol' => 'imap',
                'timeout' => $data['timeout'], //seconds
            ]);

            $client->connect();
            Log::info("IMAP - connected to the imap server successfully", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - connecting to the imap server failed - error: $error_message", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //Fetch the inbox
        try {
            Log::info("IMAP - opening mail box [INBOX]", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            $folder = $client->getFolder('INBOX');
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - opening mail box [INBOX] failed - error: $error_message", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //Fetch the email folder status
        try {

            Log::info("IMAP - starting to fecth email from the mail box [INBOX]", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            //defaults
            $emails = false;

            //mark category 'fecthing_status' as processing
            $category->category_meta_14 = 'processing';
            $category->save();

            //get mailboc meta information
            $info = $folder->examine();

            //mailbox id
            $mailbox_id = $info['uidvalidity'];

            //fetch the emails
            try {
                //determine which emails to fetch - if we have fetched email from this mailbox before or if its the first time
                if ($mailbox_id == $data['mailbox_id']) {
                    //have we fetched email from this mail box before
                    if ($category->category_meta_24 > 0) {
                        $emails = $this->getNextEmails($folder, $category);
                    } else {
                        //fetch a single initial email to [set up] the mail box
                        $emails = $this->getInitialEmail($folder, $category);
                    }
                } else {
                    //fetch a single initial email to [set up] the mail box
                    $emails = $this->getInitialEmail($folder, $category);
                }
            } catch (Exception $e) {
                //mark category 'fecthing_status' as completed
                $category->category_meta_14 = 'completed';
                $category->save();
            }

            //mark category 'fecthing_status' as completed
            $category->category_meta_14 = 'completed';
            $category->save();

            //process emails into tickets
            if ($emails && count($emails) > 0) {
                return $this->processEmailsToTickets($emails, $category, $folder);
            }

            //end
            Log::info("IMAP - fetching new emails for tickets category id (" . $category->category_id . ") - finished", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - fetching new emails for tickets category id (" . $category->category_id . ") - failed - error: $error_message", ['process' => '[tickets-imap-fetch-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        return;

    }

    /** -------------------------------------------------------------------------------------------------------
     * This is the first time fetching from this mail box
     *    - get only a single message (the very latest). this will be the starting point for this mail box
     *    - If the single message was fecthed:
     *            - update the category with mail box identifier
     *            - update the category as last fetched now()
     *            - update the id of the last fetched email
     *            - send the message for ticket processing
     *    - if no message was fetched
     *            - update mailbox id to null
     *            - update the category as last fetched now()
     * @param object $folder imap mailbox instance
     * @param array $data
     * @return mixed
     * ------------------------------------------------------------------------------------------------------*/
    public function getInitialEmail($folder = [], $category = []) {

        Log::info("IMAP - this is the first time fetching email from this mailbox. will try and fetch the latest single email", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        try {

            //get mailbox meta information
            $info = $folder->examine();

            //new query
            $query = $folder->messages();
            $query->setFetchOrder("desc");
            $query->markAsRead();

            //get only a single message
            $emails = $emails = $query->all()->limit(1)->get();

            //check emails
            if ($emails->count() == 0) {

                $category->category_meta_22 = now(); //last_fetched_timestamp
                $category->category_meta_2 = now(); //last_fetched_date
                $category->category_meta_24 = 0;
                $category->save();

                Log::info("IMAP - there are no emails in this mailbox, will try again next time", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //get the single message
            $email = $emails[0];

            //update category
            $category->category_meta_12 = $info['uidvalidity']; //mailbox_id
            $category->category_meta_13 = $email->getUid(); //last_fetched_mail_id
            $category->category_meta_22 = now(); //last_fetched_timestamp
            $category->category_meta_2 = now(); //last_fetched_date
            $category->category_meta_23 = 1; //last_fetched_count
            $category->category_meta_24 += $emails->count(); //email_total_count
            $category->save();

            Log::info("IMAP - mails (" . count($emails) . ") were successfully fetched from the mailbox", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            return $emails;

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - fetching email failed - error: $error_message", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /** -------------------------------------------------------------------------------------------------------
     * fetch emails from this mail box
     *    - get emails with an id greater than the last one fetched (last_fetched_mail_id | category_meta_13)
     *    - limit the number fetched as per the supplied limit ($data['limit'])
     *    - update the tickets category with the last fetched email id (last_fetched_mail_id | category_meta_13)
     * @param object $folder imap mailbox instance
     * @param array $data
     * @return mixed
     * ------------------------------------------------------------------------------------------------------*/
    public function getNextEmails($folder = [], $category = []) {

        Log::info("IMAP - fetching email from mailbox - started", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //do we have a last fecthed id
        try {

            //get mailbox meta information
            $info = $folder->examine();
            $last_fetched_mail_id = $category->category_meta_13;

            //new query
            $query = $folder->messages();
            $query->setFetchOrder("asc");
            $query->markAsRead();

            //update category 'last_fetched_date'
            $category->category_meta_22 = now(); //last_fetched_timestamp
            $category->save();

            $fetch_limit = is_numeric(config('system.settings2_tweak_imap_tickets_import_limit')) ? config('system.settings2_tweak_imap_tickets_import_limit') : 5;
            $emails = $query->unseen()->limit($fetch_limit)->get();

            //check emails
            if ($emails->count() == 0) {

                $category->category_meta_22 = now(); //last_fetched_timestamp
                $category->category_meta_2 = now(); //last_fetched_date
                $category->save();

                Log::info("IMAP - there are no emails in this mailbox, will try again next time", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            //get the last email in the list
            $email = $emails->last();

            //update category
            $category->category_meta_12 = $info['uidvalidity']; //mailbox_id
            $category->category_meta_13 = $email->getUid(); //last_fetched_mail_id
            $category->category_meta_22 = now(); //last_fetched_timestamp
            $category->category_meta_2 = now(); //last_fetched_date
            $category->category_meta_23 = 1; //last_fetched_count
            $category->category_meta_24 += $emails->count(); //email_total_count
            $category->save();

            Log::info("IMAP - mails (" . count($emails) . ") were successfully fetched from the mailbox", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            return $emails;

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - fetching email failed - error: $error_message", ['process' => '[tickets-imap-get-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /** -------------------------------------------------------------------------------------------------------
     * This is the first time fetching from this mail box
     *    - get only a single message (the very latest)
     *    - If there a message was fecthed
     *            - update the category with mail box identifier
     *            - update the id of the last fetched email
     *    - if there is no message to fetch
     *            - update mailbox id to null
     * @param object $folder imap mailbox instance
     * @param array $data
     * @return mixed
     * --------------------------------------------------------------------------*/
    public function processEmailsToTickets($emails = [], $category = [], $folder = []) {

        Log::info("IMAP - processing emails into tickets - started", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //extended debug output
        Log::debug("IMAP - emails payload -->", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'emails' => $emails]);

        try {
            //loop through each message
            foreach ($emails as $email) {

                Log::info("IMAP - processing email with id (" . $email->getMessageId() . ") - subject (" . $email->getSubject() . ") - started", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                //chek if we have a ticket already with this message id
                if ($ticket = $this->trackEmail($email, $folder, $category)) {
                    $this->newReply($email, $ticket);
                } else {
                    $this->newTicket($email, $category);
                }

                Log::info("IMAP - processing email with id (" . $email->getMessageId() . ") - subject (" . $email->getSubject() . ") - finished", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                $this->postAction($email);
            }
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - processing emails into tickets failed - error: $error_message", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /** -------------------------------------------------------------------------------------------------------
     * Keep a log of this email
     * @param object $email imap mailbox instance
     * @param object $category ticket category instance
     * @return bool
     * --------------------------------------------------------------------------*/
    public function trackEmail($email, $folder, $category) {

        //get email header
        $header = $email->getHeader();

        //some data
        $email_id = $email->getMessageId();
        $headers = $email->getHeaders()->toArray();
        $email_subject = $email->getSubject();
        $email_body = $email->getHTMLBody(true);
        $from = $email->getFrom();
        $to = $email->getTo();
        $from_email = $from[0]->mail;
        $from_name = $from[0]->personal;
        $to_email = $to[0]->mail;
        $in_reply_to = $header->get('in_reply_to')->first() ?? null;
        $attachments = $email->getAttachments();
        $attachments_count = $attachments->count();

        //get mailboc meta information
        $info = $folder->examine();
        $mailbox_id = $info['uidvalidity'];

        //save
        $imaplog = new \App\Models\ImapLog();
        $imaplog->imaplog_categoryid = $category->category_id;
        $imaplog->imaplog_to_email = $to_email;
        $imaplog->imaplog_mailbox_id = $mailbox_id;
        $imaplog->imaplog_from_email = $from_email;
        $imaplog->imaplog_from_name = $from_name;
        $imaplog->imaplog_subject = $email_subject;
        $imaplog->imaplog_email_uid = $email_id;
        $imaplog->imaplog_body = $email_body;
        $imaplog->imaplog_attachments_count = $attachments_count;
        $imaplog->imaplog_header_in_reply_to = $in_reply_to;
        $imaplog->imaplog_payload_header = json_encode($headers);
        $imaplog->save();

        //get main thread ticket based on references header
        if ($references = $this->getHeaderReferences($header)) {
            if ($ticket = $this->getThreadTicket($references)) {
                return $ticket;
            }
        }

        return false;
    }

    /**
     * get all the reference email id's from the references email header
     *
     * @return bool
     */
    public function getHeaderReferences($header) {

        Log::info("IMAP - getting the <references> email header - started", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //get from the email header
        $references_header = $header->get('references')->first();

        //convert into an array
        if ($references_header != '' || $references_header != null) {

            // remove angle brackets
            $references_header = preg_replace('/[<>]/', '', $references_header);

            // split into an array of message IDs
            $references = preg_split('/\s+/', trim($references_header));

            // Filter out any empty elements (just in case)
            $references = array_filter($references, fn($value) => !empty($value));

            if (empty($references)) {
                Log::info("IMAP - no <references> were found in this email", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }

            Log::info("IMAP - some <references> were found in this email", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'references' => $references]);
            return $references;
        }

        Log::info("IMAP - no <references> were found in this email", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        return false;
    }

    /**
     * see if there is a ticket that matches the email id's found in the references email header
     *
     * @return bool
     */
    public function getThreadTicket($references = []) {

        Log::info("IMAP - identifying ticket email thread - started", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //look for a ticket reply with a message id that matches the reference array
        if ($ticket = \App\Models\Ticket::whereIn('ticket_imap_sender_email_id', $references)->first()) {
            Log::info("IMAP - a ticket was found that matches this email thread - ticket id (" . $ticket->ticket_id . ")", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return $ticket;
        }

        //look for a ticket reply with a message id that matches the reference array
        if ($ticket_reply = \App\Models\TicketReply::whereIn('ticketreply_imap_sender_email_id', $references)->first()) {
            if ($ticket = \App\Models\Ticket::where('ticket_id', $ticket_reply->ticketreply_ticketid)->first()) {
                Log::info("IMAP - a ticket was found that matches this email thread - ticket id (" . $ticket->ticket_id . ")", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return $ticket;
            }
        }

        return false;

    }

    /** -------------------------------------------------------------------------------------------------------
     * This email is a new ticket
     * @param object $email imap mailbox instance
     * @param object $category ticket category instance
     * @return bool
     * --------------------------------------------------------------------------*/
    public function newTicket($email = '', $category = '') {

        try {

            //email data
            $email_id = $email->getMessageId();
            $email_subject = $email->getSubject();
            $email_body = $email->getHTMLBody(true);
            $attachments = $email->getAttachments();
            $from = $email->getFrom();
            $from_email = $from[0]->mail; // Email address
            $from_name = $from[0]->personal; // Name

            Log::info("IMAP - creating a new ticket from ($from_email) - started", ['process' => '[tickets-imap-new-ticket]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            //clean the body and get just the new reply part
            $email_body = $this->getOnlyReplyBody($email_body);

            //get the local user
            $user = $this->getUser($email);

            //create a new ticket
            $ticket = new \App\Models\Ticket();
            $ticket->ticket_source = 'email';
            $ticket->ticket_categoryid = $category->category_id;
            $ticket->ticket_creatorid = $user->id;
            $ticket->ticket_clientid = $user->clientid;
            $ticket->ticket_subject = $email_subject;
            $ticket->ticket_message = $email_body;
            $ticket->ticket_imap_sender_email_id = $email_id;
            $ticket->ticket_imap_sender_email_address = $from_email;
            $ticket->ticket_status = 1;
            $ticket->save();

            //process attachments
            Log::info("IMAP - checking if the email had attachments", ['process' => '[tickets-imap-new-ticket]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            foreach ($attachments as $attachment) {
                try {
                    //get file details
                    $filename = $attachment->getName();
                    $file_extension = $attachment->getExtension();
                    $file_size = $attachment->getSize();
                    $file_content_id = $attachment->getId();
                    $file_content_disposition = $attachment->getDisposition();

                    //create directory in storage
                    $directory = Str::random(40);
                    Storage::makeDirectory("files/$directory");
                    $directory_path = BASE_DIR . "/storage/files/$directory";
                    $file_path = BASE_DIR . "/storage/files/$directory/$filename";
                    $file_absolute_url = "/storage/files/$directory/$filename"; //cannot use url() in cron so will use absolute path

                    $attachment->save($directory_path, $filename);

                    //create a thumbnail (if its an image)
                    $thumb_name = $this->createImageThumbNail($attachment, $directory, $file_path);

                    //was this attachment used as an [embedded or inline] image in the email body
                    if ($file_content_id && $file_content_disposition == 'inline') {

                        $cid_placeholder = "cid:$file_content_id";
                        //repalce the placeholder with actuakl new path in the ticket body
                        $email_body = str_replace($cid_placeholder, $file_absolute_url, $email_body);
                        $ticket->ticket_message = $email_body;
                        $ticket->save();

                        Log::info("IMAP - an [embedded] image (filename: $filename -- embed_id: $file_content_id) in this email was added to the email body successfully", ['process' => '[tickets-imap-new-ticket]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                    } else {

                        //this is a regular attachment - save to database
                        $new_attachment = new \App\Models\Attachment();
                        $new_attachment->attachment_uniqiueid = $directory;
                        $new_attachment->attachment_creatorid = $user->id;
                        $new_attachment->attachment_clientid = $ticket->ticket_clientid;
                        $new_attachment->attachment_directory = $directory;
                        $new_attachment->attachment_filename = $filename;
                        $new_attachment->attachment_extension = $file_extension;
                        $new_attachment->attachment_type = ($thumb_name) ? 'image' : 'file';
                        $new_attachment->attachment_size = humanFileSize($file_size);
                        $new_attachment->attachment_thumbname = $thumb_name ?? '';
                        $new_attachment->attachmentresource_type = 'ticket';
                        $new_attachment->attachmentresource_id = $ticket->ticket_id;
                        $new_attachment->save();

                        Log::info("IMAP - an attachment ($filename) in this email was saved successfully", ['process' => '[tickets-imap-new-ticket]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    }
                } catch (Exception $e) {
                    $error_message = $e->getMessage();
                    Log::error("IMAP - an attachment in the email could not be processed -  error ($error_message)", ['process' => '[tickets-imap-new-ticket]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                }
            }
            //email notifications
            //$users = $this->userrepo->getTeamMembers('ids');

            Log::info("IMAP - creating a ticket id (" . $ticket->ticket_id . ") - completed", ['process' => '[tickets-imap-new-ticket]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            return true;
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - creating a new ticket failed - error: $error_message", ['process' => '[tickets-imap-new-ticket]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /** -------------------------------------------------------------------------------------------------------
     * This email is a reply to an existing ticket. Post the message
     * @param object $email imap mailbox instance
     * @param object $ticket support ticket instance
     * @return bool
     * --------------------------------------------------------------------------*/
    public function newReply($email = '', $ticket = '') {

        try {

            //email data
            $email_id = $email->getMessageId();
            $email_subject = $email->getSubject();
            $attachments = $email->getAttachments();
            $from = $email->getFrom();
            $from_email = $from[0]->mail; // Email address
            $from_name = $from[0]->personal; // Name

            //get message body and decode special characters correctly
            //$charset = $email->getHeader()->get('content-type')->getParameter('charset') ?? 'UTF-8';
            $email_body = $email->getHTMLBody(true);
            //$email_body = mb_convert_encoding($email_body, 'UTF-8');

            Log::info("IMAP - creating a new ticket reply from ($from_email) - started", ['process' => '[tickets-imap-new-reply]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            //clean the body and get just the new reply part
            $email_body = $this->getOnlyReplyBody($email_body);
            Log::info("foo bar", ['email_body' => $email_body]);

            //get the local user
            $user = $this->getUser($email);

            //create a new ticket reply
            $reply = new \App\Models\TicketReply();
            $reply->ticketreply_creatorid = $user->id;
            $reply->ticketreply_ticketid = $ticket->ticket_id;
            $reply->ticketreply_clientid = $ticket->ticket_clientid;
            $reply->ticketreply_text = $email_body;
            $reply->ticketreply_source = 'email';
            $reply->ticketreply_type = 'reply';
            $reply->ticketreply_imap_sender_email_id = $email_id;
            $reply->save();

            //update ticket status
            if ($status = \App\Models\TicketStatus::Where('ticketstatus_use_for_client_replied', 'yes')->first()) {
                $ticket->ticket_status = $status->ticketstatus_id;
                $ticket->save();
            }

            //process attachments
            Log::info("IMAP - checking if the email had attachments", ['process' => '[tickets-imap-new-reply]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            foreach ($attachments as $attachment) {
                try {
                    //get file details
                    $filename = $attachment->getName();
                    $file_extension = $attachment->getExtension();
                    $file_size = $attachment->getSize();
                    $file_content_id = $attachment->getId();
                    $file_content_disposition = $attachment->getDisposition();

                    //create directory in storage
                    $directory = Str::random(40);
                    Storage::makeDirectory("files/$directory");
                    $directory_path = BASE_DIR . "/storage/files/$directory";
                    $file_path = BASE_DIR . "/storage/files/$directory/$filename";
                    $file_absolute_url = "/storage/files/$directory/$filename"; //cannot use url() in cron so will use absolute path

                    $attachment->save($directory_path, $filename);

                    //create a thumbnail (if its an image)
                    $thumb_name = $this->createImageThumbNail($attachment, $directory, $file_path);

                    //was this attachment used as an [embedded or inline] image in the email body
                    if ($file_content_id && $file_content_disposition == 'inline') {

                        $cid_placeholder = "cid:$file_content_id";
                        //repalce the placeholder with actuakl new path in the ticket body
                        $email_body = str_replace($cid_placeholder, $file_absolute_url, $email_body);
                        $reply->ticketreply_text = $email_body;
                        $reply->save();

                        Log::info("IMAP - an [embedded] image (filename: $filename -- embed_id: $file_content_id) in this email was added to the email body successfully", ['process' => '[tickets-imap-new-reply]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

                    } else {

                        //this is a regular attachment - save to database
                        $new_attachment = new \App\Models\Attachment();
                        $new_attachment->attachment_uniqiueid = $directory;
                        $new_attachment->attachment_creatorid = $user->id;
                        $new_attachment->attachment_clientid = $ticket->ticket_clientid;
                        $new_attachment->attachment_directory = $directory;
                        $new_attachment->attachment_filename = $filename;
                        $new_attachment->attachment_extension = $file_extension;
                        $new_attachment->attachment_type = ($thumb_name) ? 'image' : 'file';
                        $new_attachment->attachment_size = humanFileSize($file_size);
                        $new_attachment->attachment_thumbname = $thumb_name ?? '';
                        $new_attachment->attachmentresource_type = 'ticketreply';
                        $new_attachment->attachmentresource_id = $reply->ticketreply_id;
                        $new_attachment->save();

                        Log::info("IMAP - an attachment ($filename) in this email was saved successfully", ['process' => '[tickets-imap-new-reply]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                    }
                } catch (Exception $e) {
                    $error_message = $e->getMessage();
                    Log::error("IMAP - an attachment in the email could not be processed -  error ($error_message)", ['process' => '[tickets-imap-new-reply]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                }
            }

            //notification
            //$users = $this->userrepo->getTeamMembers('ids');

            Log::info("IMAP - creating a ticket reply from ($from_email) to ticket id (" . $ticket->ticket_id . ") - completed", ['process' => '[tickets-imap-new-reply]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return true;

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - creating a ticket reply failed - error: $error_message", ['process' => '[tickets-imap-new-reply]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

    }

    /**
     * get the local user, based on the [from] email address. If none is found, create one
     *
     * @return bool
     */
    public function getUser($email) {

        //email details
        $from = $email->getFrom();
        $from_email = $from[0]->mail;
        $from_name = $from[0]->personal;

        Log::info("IMAP - looking for local user with this email ($from_email) - started", ['process' => '[tickets-imap-get-user]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        if ($user = \App\Models\User::Where('email', $from_email)->first()) {
            Log::info("IMAP - a user was found", ['process' => '[tickets-imap-get-user]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return $user;
        } else {
            Log::info("IMAP - a user was not found - will now create one", ['process' => '[tickets-imap-get-user]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            $user = new \App\Models\User();
            $user->type = 'contact';
            $user->creatorid = 0;
            $user->email = $from_email;
            $user->first_name = $from_name;
            $user->save();
            return $user;
        }
    }

    /**
     * create an email thumbnail
     *
     * @return bool
     */
    public function createImageThumbNail($attachment, $directory, $file_path) {

        //file details
        $filename = $attachment->getName();
        $file_extension = $attachment->getExtension();
        $filename = $attachment->getName();
        $thumb_name = generateThumbnailName($filename);
        $thumb_path = BASE_DIR . "/storage/files/$directory/$thumb_name";
        $thumb_width = 90; //px

        Log::info("IMAP - checking if the email attachment ($filename) is an image in order to create a thumbnail", ['process' => '[tickets-imap-image-thumbnail]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //if the file type is an image, create a thumb by default
        $skip_image_types = ['psd', 'tiff', 'indd', 'eps', 'ai'];
        if (is_array(@getimagesize($file_path)) && !in_array($file_extension, $skip_image_types)) {
            Log::info("IMAP - the attachment is an image and will now create a thumbnail", ['process' => '[tickets-imap-image-thumbnail]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            try {
                $img = Image::make($file_path)->resize(null, $thumb_width, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save($thumb_path);
                Log::info("IMAP - thumbnail has been created ($thumb_name)", ['process' => '[tickets-imap-image-thumbnail]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return $thumb_name;
            } catch (Exception $e) {
                $message = $e->getMessage();
                Log::error("IMAP - creating attachment thumbnail - failed - error ($message)", ['process' => '[tickets-imap-image-thumbnail]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
                return false;
            }
        } else {
            Log::info("IMAP - this attachment is not an image. will skip creating a thumbnail", ['process' => '[tickets-imap-image-thumbnail]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

    }

    /** -------------------------------------------------------------------------------------------------------
     * get only the visible message body and not quoted text (as commonly found in reply messages)
     *
     *  (1) Remove anything after the marker that we added to each reply 'nextloop-start-of-crm-reply'
     *  (2) If we have PHP Dom enabled, strip out other common content found in replies
     *  (3) If PHP Dom is not available, fallback to regex
     * @param object $emai_body the email body
     * @return string
     * --------------------------------------------------------------------------*/
    public function getOnlyReplyBodyOld($email_body) {

        Log::info("IMAP - parsing email body to strip out just the reply - started", ['process' => '[tickets-imap-parse-email-body]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //(1) strip out the last reply as tagged by mycrm
        $cleaned_email_body = preg_replace('/<div class="nextloop-start-of-crm-reply"><\/div>.*/s', '', $email_body);
        $cleaned_email_body = trim($cleaned_email_body);

        // Check if DOMDocument is available
        if (class_exists('DOMDocument')) {

            Log::info("IMAP - PHP Dom extension exists - will use it to parse the email", ['process' => '[tickets-imap-parse-email-body]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            // Use DOMDocument for parsing and cleaning the email body
            $dom = new \DOMDocument();

            // Suppress errors due to malformed HTML
            libxml_use_internal_errors(true);
            $dom->loadHTML($cleaned_email_body);
            libxml_clear_errors();

            // Initialize XPath to query the DOM
            $xpath = new \DOMXPath($dom);

            // Patterns to remove common reply content
            //'//div[contains(text(), "On ")]', // Divs starting with "On " (generic reply format)
            $patterns_to_remove = [
                '//blockquote', // General <blockquote> tags
                '//div[contains(@class, "gmail_quote")]', // Gmail-specific quote
                '//div[contains(@style, "border-left")]', // Divs with border-left style
                '//div[contains(@class, "gmail_attr")]', // Gmail-specific attributes
                '//span[contains(@style, "border-left")]', // Spans with border-left style
                '//span[contains(@style, "padding-left")]', // Spans with padding-left style
                '//div[contains(text(), "wrote:")]', // Divs containing "wrote:"
                '//div[contains(text(), "Original Message")]', // Divs containing "Original Message"
            ];

            // Remove elements matching the patterns
            foreach ($patterns_to_remove as $pattern) {
                $nodes = $xpath->query($pattern);
                foreach ($nodes as $node) {
                    $node->parentNode->removeChild($node);
                }
            }

            // Save the cleaned-up body (customer's reply only)
            $cleaned_email_body = $dom->saveHTML();

        } else {

            Log::info("IMAP - PHP Dom extension does not exists - will regex to parse the email", ['process' => '[tickets-imap-parse-email-body]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            // Fallback to remove common reply content with regular expressions
            $patterns_to_remove = [
                '/<blockquote.*?>.*?<\/blockquote>/si', // General <blockquote> tags
                '/<div[^>]*style=["\'][^"\']*border-left[^"\']*["\'][^>]*>.*?<\/div>/si', // Divs with border-left style
                '/<div[^>]*class=["\'][^"\']*gmail_quote[^"\']*["\'][^>]*>.*?<\/div>/si', // Gmail-specific quote
                '/<div[^>]*class=["\'][^"\']*gmail_attr[^"\']*["\'][^>]*>.*?<\/div>/si', // Gmail-specific attributes
                '/<span[^>]*style=["\'][^"\']*border-left[^"\']*["\'][^>]*>.*?<\/span>/si', // Spans with border-left style
                '/<span[^>]*style=["\'][^"\']*padding-left[^"\']*["\'][^>]*>.*?<\/span>/si', // Spans with padding-left style
                '/<div[^>]*>.*?wrote:.*?<\/div>/si', // Divs containing "wrote:"
                '/<div[^>]*>.*?Original Message.*?<\/div>/si', // Divs containing "Original Message"
                //'/<div[^>]*>.*?On .*?<\/div>/si', // Divs starting with "On " (generic reply format)
            ];

            // Apply each pattern to remove the matching content
            foreach ($patterns_to_remove as $pattern) {
                $cleaned_email_body = preg_replace($pattern, '', $cleaned_email_body);
            }
        }

        Log::info("IMAP - parsing email body - finished", ['process' => '[tickets-imap-parse-email-body]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        return $cleaned_email_body;

    }

    /** -------------------------------------------------------------------------------------------------------
     * get only the visible message body and not quoted text (as commonly found in reply messages)
     *
     *  (1) Remove anything after the marker that we added to each reply 'nextloop-start-of-crm-reply'
     *  (2) If we have PHP Dom enabled, strip out other common content found in replies
     *  (3) If PHP Dom is not available, fallback to regex
     * @param object $emai_body the email body
     * @return string
     * --------------------------------------------------------------------------*/

    public function getOnlyReplyBody($email_body = '') {

        Log::info("IMAP - parsing email body to strip out just the reply - started", ['process' => '[tickets-imap-parse-email-body]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        if (empty($email_body)) {
            return '';
        }

        // Initialize UTF-8 handling
        mb_internal_encoding('UTF-8');

        // Detect and normalize initial encoding
        $detected_encoding = mb_detect_encoding($email_body, ['UTF-8', 'ISO-8859-1', 'ISO-8859-15', 'ASCII', 'JIS', 'EUC-JP', 'SJIS'], true);
        Log::info("IMAP - initial encoding detected", ['encoding' => $detected_encoding]);

        // Normalize to UTF-8 if needed
        if ($detected_encoding && $detected_encoding !== 'UTF-8') {
            $email_body = mb_convert_encoding($email_body, 'UTF-8', $detected_encoding);
        }

        // Pre-process emojis and special characters
        $email_body = preg_replace_callback('/[\x{1F300}-\x{1F64F}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u',
            function ($matches) {
                return mb_convert_encoding($matches[0], 'UTF-8', 'UTF-8');
            },
            $email_body
        );

        // Check if DOMDocument is available
        if (class_exists('DOMDocument')) {
            Log::info("IMAP - PHP Dom extension exists - will use it to parse the email", ['process' => '[tickets-imap-parse-email-body]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            // Create new DOMDocument
            $dom = new \DOMDocument('1.0', 'UTF-8');
            $dom->preserveWhiteSpace = true;
            $dom->formatOutput = false;

            // Prepare content with full Unicode support
            if (!preg_match('/<html/i', $email_body)) {
                $email_body = '<!DOCTYPE html><html><head>'
                    . '<meta charset="UTF-8">'
                    . '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'
                    . '</head><body>' . $email_body . '</body></html>';
            }

            // Load HTML with UTF-8 encoding handling
            libxml_use_internal_errors(true);
            $success = $dom->loadHTML('<?xml encoding="UTF-8"?>' . $email_body,
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOENT);
            $errors = libxml_get_errors();
            libxml_clear_errors();

            if (!empty($errors)) {
                Log::error("IMAP - DOM loading produced warnings", ['errors' => $errors]);
            }

            $xpath = new \DOMXPath($dom);

            // Extract content
            $body_node = $xpath->query('//body')->item(0);

            if ($body_node) {
                // Remove reply patterns (keeping the same patterns as before)
                $patterns_to_remove = [
                    //'//blockquote', // <blockquote> (some valid email content may be in blockquote and will get stripped out in error)
                    '//div[contains(@class, "gmail_quote")]', // Gmail-specific quote
                    '//div[contains(@style, "border-left")]', // Divs with border-left style
                    '//div[contains(@class, "gmail_attr")]', // Gmail-specific attributes
                    '//span[contains(@style, "border-left")]', // Spans with border-left style
                    '//span[contains(@style, "padding-left")]', // Spans with padding-left style
                    '//div[contains(text(), "wrote:")]', // Divs containing "wrote:"
                    '//div[contains(text(), "Original Message")]', // Divs containing "Original Message"
                    '//div[contains(@id, "yahoo_quoted")]', // Yahoo-specific quoted text
                    '//div[contains(@class, "yahoo_quoted")]', // Yahoo-specific quoted text
                    '//blockquote[@type="cite"]', // Apple Mail quoted replies
                    '//div[contains(@id, "AOLMsgPart")]', // AOL Mail quoted replies
                    '//div[contains(@id, "divRplyFwdMsg")]', // Outlook.com reply/forward message headers
                    '//div[contains(@class, "OutlookMessageHeader")]', // Outlook message headers
                    '//div[contains(@class, "ms-outlook-cite")]', // Outlook message cites
                    '//div[contains(@class, "gmail_extra")]', // Zoho mail quoted text
                    '//div[contains(text(), "This message is confidential")]', // Confidentiality footers
                    '//div[contains(text(), "Click here to unsubscribe")]', // Unsubscribe links
                    '//div[contains(text(), "Forwarded message")]', // Forwarded message headers
                    '//div[contains(text(), "This email has been scanned")]', // Virus scan messages
                    '//div[contains(text(), "Please do not print this email unless necessary")]', // Environmental footers
                ];

                foreach ($patterns_to_remove as $pattern) {
                    $elements = $xpath->query($pattern);
                    foreach ($elements as $element) {
                        if ($element->parentNode) {
                            $element->parentNode->removeChild($element);
                        }
                    }
                }

                // Remove content after markers
                $markers = ['//div[@id="appendonsend"]', '//div[contains(@class, "nextloop-start-of-crm-reply")]'];
                foreach ($markers as $marker) {
                    $element = $xpath->query($marker)->item(0);
                    if ($element) {
                        while ($element->nextSibling) {
                            $element->parentNode->removeChild($element->nextSibling);
                        }
                        $element->parentNode->removeChild($element);
                    }
                }

                // Get content while preserving UTF-8 encoding
                $body_content = '';
                foreach ($body_node->childNodes as $child) {
                    $fragment = $dom->saveHTML($child);
                    if ($fragment !== false) {
                        $body_content .= $fragment;
                    }
                }

            } else {
                $body_content = $email_body;
            }

        } else {
            // Fallback to regex method
            Log::info("IMAP - using regex fallback method");
            if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $email_body, $matches)) {
                $body_content = $matches[1];
            } else {
                $body_content = $email_body;
            }

            // Clean using regex patterns
            $patterns_to_remove = [
                //'/<blockquote\b[^>]*>.*?<\/blockquote>/is', // <blockquote> (some valid email content may be in blockquote and will get stripped out in error)
                '/<div[^>]*class="[^"]*gmail_quote[^"]*"[^>]*>.*?<\/div>/is', // Gmail-specific quote
                '/<div[^>]*style="[^"]*border-left[^"]*"[^>]*>.*?<\/div>/is', // Divs with border-left style
                '/<div[^>]*class="[^"]*gmail_attr[^"]*"[^>]*>.*?<\/div>/is', // Gmail-specific attributes
                '/<span[^>]*style="[^"]*border-left[^"]*"[^>]*>.*?<\/span>/is', // Spans with border-left style
                '/<span[^>]*style="[^"]*padding-left[^"]*"[^>]*>.*?<\/span>/is', // Spans with padding-left style
                '/<div[^>]*>[^<]*(wrote:|Original Message)[^<]*<\/div>/is', // Divs containing "wrote:" or "Original Message"
                '/<div[^>]*id="yahoo_quoted"[^>]*>.*?<\/div>/is', // Yahoo-specific quoted text
                '/<div[^>]*class="[^"]*yahoo_quoted[^"]*"[^>]*>.*?<\/div>/is', // Yahoo-specific quoted text
                '/<blockquote[^>]*type="cite"[^>]*>.*?<\/blockquote>/is', // Apple Mail quoted replies
                '/<div[^>]*id="AOLMsgPart"[^>]*>.*?<\/div>/is', // AOL Mail quoted replies
                '/<div[^>]*id="divRplyFwdMsg"[^>]*>.*?<\/div>/is', // Outlook.com reply/forward message headers
                '/<div[^>]*class="[^"]*OutlookMessageHeader[^"]*"[^>]*>.*?<\/div>/is', // Outlook message headers
                '/<div[^>]*class="[^"]*ms-outlook-cite[^"]*"[^>]*>.*?<\/div>/is', // Outlook message cites
                '/<div[^>]*class="[^"]*gmail_extra[^"]*"[^>]*>.*?<\/div>/is', // Zoho mail quoted text
                '/<div[^>]*>[^<]*(This message is confidential|Click here to unsubscribe)[^<]*<\/div>/is', // Footers
                '/<div[^>]*>[^<]*(Forwarded message|Message from)[^<]*<\/div>/is', // Forwarded message headers
                '/<div[^>]*>[^<]*(This email has been scanned|Please do not print this email unless necessary)[^<]*<\/div>/is', // Virus scan and environmental footers
            ];

            foreach ($patterns_to_remove as $pattern) {
                $body_content = preg_replace($pattern, '', $body_content);
            }
        }

        // Final cleanup and normalization
        $body_content = mb_convert_encoding($body_content, 'UTF-8', 'UTF-8');

        // Special handling for emoji and other special characters
        $body_content = preg_replace_callback('/[\x{1F300}-\x{1F64F}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u',
            function ($matches) {
                return mb_convert_encoding($matches[0], 'UTF-8', 'UTF-8');
            },
            $body_content
        );

        // Log final content encoding check
        Log::info("IMAP - final content encoding check", [
            'detected_encoding' => mb_detect_encoding($body_content, ['UTF-8', 'ISO-8859-1', 'ISO-8859-15', 'ASCII'], true),
            'contains_special_chars' => preg_match('/[À-ÿ]/', $body_content) ? 'yes' : 'no',
        ]);

        return $body_content;
    }

    /** -------------------------------------------------------------------------------------------------------
     * get the email encoding used in the email, to avoid breaking special characters like é á ű
     * @param array $data
     * @return mixed the encoding used (e.g. UTF-8) or null
     * --------------------------------------------------------------------------*/
    protected function getDeclaredEncoding($email_body) {
        // Check XML declaration
        if (preg_match('/<\?xml[^>]+encoding=["\']([^"\']+)["\'].*\?>/i', $email_body, $matches)) {
            return strtoupper($matches[1]);
        }

        // Check meta charset (expanded patterns)
        if (preg_match('/<meta[^>]+charset=["\']([^"\']+)["\']|<meta\s+charset=["\']([^"\']+)["\']|<meta[^>]+charset=([^\s>"\']+)/i', $email_body, $matches)) {
            return strtoupper(end(array_filter($matches)));
        }

        // Check content-type header
        if (preg_match('/content-type:[^;]+;\s*charset=([^;\s]+)/i', $email_body, $matches)) {
            return strtoupper($matches[1]);
        }

        return 'UTF-8';
    }

    /** -------------------------------------------------------------------------------------------------------
     * This is the first time fetching from this mail box
     *    - get only a single message (the very latest)
     *    - If there a message was fecthed
     *            - update the category with mail box identifier
     *            - update the id of the last fetched email
     *    - if there is no message to fetch
     *            - update mailbox id to null
     * @param object $folder imap mailbox instance
     * @param array $data
     * @return mixed
     * --------------------------------------------------------------------------*/
    public function postAction($email) {

        Log::info("IMAP - post message action - started", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //delete the message

        //just mark it as read

        Log::info("IMAP - post message action - completed", ['process' => '[tickets-imap-process-emails]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

    }

    /** ----------------------------------------------------
     * validate the imap email account data
     * @param array $data imap email account data
     * @return bool
     * ---------------------------------------------------*/
    public function validateData($data = []) {

        Log::info("IMAP - validating imap data - started", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'data' => $data]);

        if (!is_array($data)) {
            Log::error("IMAP - validating imap data - failed", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //validate the data payload
        $validator = Validator::make($data, [
            'limit' => 'required|numeric',
            'email' => 'required|email',
            'host' => 'required',
            'port' => 'required|numeric',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'required',
            'post_action' => 'required',
            'mailbox_id' => 'present|nullable',
            'last_fetched_mail_id' => 'present|nullable',
            'last_fetched_date' => 'present|nullable',
        ]);

        //errors
        if ($validator->fails()) {
            Log::error("IMAP - validating imap data - failed", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        Log::info("IMAP - validating imap data - completed", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        return true;
    }

    /** ----------------------------------------------------
     * attempt to connect to an imap server
     * @param array $data information payload
     * @return bool
     * ---------------------------------------------------*/
    public function testConnection($data = []) {

        Log::info("IMAP - testing an imap email connection - started", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'data' => $data]);

        //validate the data payload
        $validator = Validator::make($data, [
            'host' => 'required',
            'port' => 'required|numeric',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'required',
        ]);

        //errors
        if ($validator->fails()) {
            Log::error("IMAP - testing an imap email connection failed - invalid data", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //try to connect to imap server
        try {

            $imap = new ClientManager();

            $client = $imap->make([
                'host' => $data['host'],
                'port' => $data['port'],
                'encryption' => $data['encryption'],
                'username' => $data['username'],
                'password' => $data['password'],
                'validate_cert' => false,
                'protocol' => 'imap',
                'timeout' => 30, //seconds
            ]);

            $client->connect();
            Log::info("IMAP - testing an imap email connection passed", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return [
                'status' => true,
                'message' => null,
            ];
        } catch (ConnectionFailedException $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - testing an imap email failed - connection error: $error_message", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return [
                'status' => false,
                'message' => __('lang.imap_connection_failed_message'),
            ];
        } catch (AuthFailedException $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - testing an imap email failed - authentication error: $error_message", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return [
                'status' => false,
                'message' => __('lang.invalid_login_details'),
            ];
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            Log::error("IMAP - testing an imap email failed - general error: $error_message", ['process' => '[tickets-imap-test-connection]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            //login failed
            if (trim($error_message) == 'NO Login failed.') {
                return [
                    'status' => false,
                    'message' => __('lang.imap_connection_failed_general') . ': ' . __('lang.invalid_login_details'),
                ];
            }

            return [
                'status' => false,
                'message' => __('lang.imap_connection_failed_general') . ": ($error_message)",
            ];
        }
    }
}