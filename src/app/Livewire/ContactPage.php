<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Profile;
use Livewire\Component;

class ContactPage extends Component
{
    public string $name    = '';
    public string $email   = '';
    public string $subject = '';
    public string $message = '';

    protected $rules = [
        'name'    => 'required|min:3',
        'email'   => 'required|email',
        'subject' => 'required',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        Contact::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset();
        session()->flash('success', 'Pesan berhasil dikirim!');
    }

    public function render()
    {
        $profile = Profile::first();
        return view('livewire.contact-page', compact('profile'))
            ->layout('layouts.app');
    }
}
