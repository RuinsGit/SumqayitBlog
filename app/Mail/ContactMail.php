<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactRequest;

    public function __construct(ContactRequest $contactRequest)
    {
        $this->contactRequest = $contactRequest;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Yeni Əlaqə Tələbi')
                    ->html("
                        <h2>Yeni Əlaqə Tələbi</h2>
                        <p><strong>Ad:</strong> {$this->contactRequest->name}</p>
                        <p><strong>E-poçt:</strong> {$this->contactRequest->email}</p>
                        <p><strong>Telefon:</strong> {$this->contactRequest->number}</p>
                        <p><strong>Mesaj:</strong> {$this->contactRequest->text}</p>
                        <p><strong>Tarix:</strong> " . now()->format('d.m.Y H:i:s') . "</p>
                    ");
    }
} 