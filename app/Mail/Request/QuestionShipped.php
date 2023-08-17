<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuestionShipped extends Mailable
{
    use Queueable, SerializesModels;

	protected $question;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($question)
    {
       $this->question = $question;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
	{
        return new Envelope(
            subject: 'Новый вопрос',
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
            markdown: 'filament.requests.emails.questions.shipped',
			with: [
				'questionSubject' => $this->question->subject,
				'questionText' => $this->question->text,
				'questionTelephone' => $this->question->telephone,
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

		if ($this->question->getMedia('maintenance-question-images')) {
			foreach ($this->question->getMedia('maintenance-question-images') as $image) {
				$attachments[] = $image->getPath();
			}
		}

        return $attachments;
    }
}
