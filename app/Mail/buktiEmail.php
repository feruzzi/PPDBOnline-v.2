<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class buktiEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $pdf;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $pdf)
    {
        $this->details = $details;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Syntax Error Dev')
            ->view('emails.bukti-daftar-mail')
            ->attachData($this->pdf->output(), 'Bukti_Pendaftaran.pdf');
    }
}
