<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contacts')->with('success', 'Message deleted successfully');
    }

    public function reply($id)
    {
        $contact = Contact::find($id);
        return view('admin.contacts.reply', compact('contact'));
    }

    public function updateReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::find($id);
        $contact->reply = $request->reply;
        $contact->replied_at = now();
        $contact->save();

        return redirect()->route('admin.contacts')->with('success', 'Reply sent successfully!');
    }
}
