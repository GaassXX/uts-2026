<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ContactPage extends Component
{
    #[Rule('required|min:3', message: 'Nama minimal 3 karakter.')]
    public string $name = '';

    #[Rule('required|email', message: 'Format email tidak valid.')]
    public string $email = '';

    #[Rule('required', message: 'Subject tidak boleh kosong.')]
    public string $subject = '';

    #[Rule('required|min:10', message: 'Pesan minimal 10 karakter.')]
    public string $message = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate();

        Contact::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'subject', 'message']);
        $this->submitted = true;
        session()->flash('success', 'Pesan berhasil dikirim!');
    }

    public function render()
    {
        return view('livewire.contact-page')
            ->layout('layouts.app');
    }
}
