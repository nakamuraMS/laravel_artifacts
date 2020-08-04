<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendRemindMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendInfo)
    {
        $this->sendInfo = $sendInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@example.com')
            ->subject($this->sendInfo[0]['title'])
            ->text('admin.emails.remind')
            ->to('admin@example.com')
            ->with(['sendInfo' => $this->sendInfo[0]]);
    }
}
