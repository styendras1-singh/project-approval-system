<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class ProjectStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $status;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct($project, $status, $reason = null)
    {
        $this->project = $project;
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * Build the message
     */
    public function build()
    {
        return $this->subject('Project Status Update')
                    ->view('emails.project-status');
    }
}