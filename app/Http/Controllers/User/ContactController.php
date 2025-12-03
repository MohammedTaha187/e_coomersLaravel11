<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contactUser()
    {
        return view('user.contacts.index');
    }

    public function userMessages()
    {
        $contacts = Contact::where('user_id', Auth::id())->orWhere('email', Auth::user()->email)->orderBy('created_at', 'DESC')->get();
        return view('user.contacts.history', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'comment' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comment' => $request->comment,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
