<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StrukPengembalianMail extends Mailable
{
    public $loan;
    public $pdf;

    public function __construct($loan, $pdf)
    {
        $this->loan = $loan;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Struk Pengembalian')
            ->view('emails.struk_pengembalian')
            ->attachData(
                $this->pdf->output(),
                'Struk-Return-' . $this->loan->id . '.pdf',
                [
                    'mime' => 'application/pdf',
                ]
            );
    }
}