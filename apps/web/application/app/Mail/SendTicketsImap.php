<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;

class SendTicketsImap extends Mailable {
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data) {
        $this->data = $data;

        middlewareBootSettings();
        
        //[MT] boot mail settings
        env('MT_TPYE') ? middlewareSaaSBootMail() : middlewareBootMail();

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope() {
        return new Envelope(
            subject:$this->data['subject'],
            from:new Address($this->data['from'], $this->data['from_name']),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content() {
        return new Content(
            view:'temp::'.$this->data['temp_blade_view'],
            with:[
                'content' => $this->data['body'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        //loop through all attachments
        if (!empty($this->data['attachments'])) {
            foreach ($this->data['attachments'] as $attachment) {
                $file_path = BASE_DIR . "/storage/files/" . $attachment->attachment_directory . "/" . $attachment->attachment_filename;
                if (file_exists($file_path)) {
                    $attachments[] = Attachment::fromPath($file_path);
                }
            }
        }

        return $attachments;
    }

    /**
     * Get the message headers.
     *
     * @return \Illuminate\Mail\Mailables\Headers
     */

    public function headers(): Headers {
        return new Headers(
            text:[
                'In-Reply-To' => $this->data['in_reply_to'],
            ],
            messageId:$this->data['message_id'],
            references:$this->data['references'],
        );
    }

    

}