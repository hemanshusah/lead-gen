<?php

/** --------------------------------------------------------------------------------
 * This classes renders the [ticket reply] email and stores it in the queue
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class TicketImapReply extends Mailable {
    use Queueable;

    /**
     * The data for merging into the email
     */
    public $data;

    /**
     * Model instance
     */
    public $obj;

    public $emailerrepo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = [], $obj = []) {

        $this->data = $data;
        $this->obj = $obj;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {


        //validate
        if (!$this->obj instanceof \App\Models\Ticket) {
            return false;
        }

        //add reply tag for imap parsing
        $body = '<div class="nextloop-start-of-crm-reply"></div>' . $this->data['ticketreply_text'];

        //reply subject
        
        //save in the database queue
        $queue = new \App\Models\EmailQueue();
        $queue->emailqueue_to = $this->obj->ticket_imap_sender_email_address;
        $queue->emailqueue_subject = 'Re: ' . $this->obj->ticket_subject;
        $queue->emailqueue_message = $body;
        $queue->emailqueue_type = 'imap-ticket-reply';
        $queue->emailqueue_resourcetype = 'ticket-reply';
        $queue->emailqueue_resourceid = $this->data['ticketreply_id'];

        $queue->save();
    }
}
