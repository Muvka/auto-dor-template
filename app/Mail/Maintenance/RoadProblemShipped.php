<?php

namespace App\Mail\Maintenance;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RoadProblemShipped extends Mailable
{
    use Queueable, SerializesModels;

	protected $problem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($problem)
    {
		$this->problem = $problem;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
	{
        return new Envelope(
            subject: 'Новое замечание',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
	{
        return new Content(
			markdown: 'filament.requests.emails.problems.shipped',
			with: [
				'problemAddress' => $this->problem->address,
				'problemComment' => $this->problem->comment,
				'problemTelephone' => $this->problem->telephone,
			]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
	{
		$attachments = [];

		if ($this->problem->getMedia('maintenance-road-problem-images')) {
			foreach ($this->problem->getMedia('maintenance-road-problem-images') as $image) {
				$attachments[] = $image->getPath();
			}
		}

		return $attachments;
    }
}
