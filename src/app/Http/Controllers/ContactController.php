<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('contact.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact->update(['is_read' => true]);

        return view('contact.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}
