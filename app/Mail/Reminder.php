<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\FilariasisMedication; // 追加

class Reminder extends Mailable
{
    use Queueable, SerializesModels;
    
    public $medicationId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FilariasisMedication $medicationId)
    {
        $this->id = $medicationId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "フィラリア投薬リマインダー {$this->id->start_date->format('Y/m/d') }";
        return $this->subject($subject)
            ->view('emails.med_reminder');
    }
}
