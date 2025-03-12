<?php

namespace App\Mail;

use App\Models\ContactMarketing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMarketingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMarketing;

    public function __construct(ContactMarketing $contactMarketing)
    {
        $this->contactMarketing = $contactMarketing;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Konstultasiya mesajı')
                    ->html("
                        <h2>Konstultasiya mesajı</h2>
                        <p><strong>Ad:</strong> {$this->contactMarketing->name}</p>
                        <p><strong>E-posta:</strong> {$this->contactMarketing->email}</p>
                        <p><strong>Mesaj:</strong> {$this->contactMarketing->message}</p>
                    ");
    }
} 