<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Project;

class DeadlineNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $daysLeft; // Add this line

    /**
     * Create a new message instance.
     */
    public function __construct(Project $project, $daysLeft)
    {
        $this->project = $project;
        $this->daysLeft = $daysLeft; // And this line
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Deadline Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.deadline_notification',
            with: [
                'project' => $this->project,
                'daysLeft' => $this->daysLeft, // And this line
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
