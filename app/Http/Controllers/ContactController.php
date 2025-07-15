<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Content;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index()
    {
        // Get contact page content from CMS
        $contactContents = Content::active()->bySection('contact')->orderBy('order')->get();

        return view('contact.index', compact('contactContents'));
    }

    /**
     * Display contacts for admin management.
     */
    public function admin()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Store a newly created contact message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => false
        ]);

        return redirect()->route('contact')->with('success', 'Pesan Anda telah berhasil terkirim! Kami akan segera menghubungi Anda kembali.');
    }

    /**
     * Mark a contact message as read.
     */
    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => !$contact->is_read]);

        $status = $contact->is_read ? 'read' : 'unread';
        return redirect()->route('admin.contacts.index')->with('success', "Message marked as {$status}!");
    }

    /**
     * Remove the specified contact message.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully!');
    }
}
