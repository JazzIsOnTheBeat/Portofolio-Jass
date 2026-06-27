<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;
use App\Mail\ContactAutoReply;

class ContactController extends Controller {
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);
        $contact = Contact::create($validated);

        // Mail::to(config('mail.from.address'))->queue(new ContactReceived($contact));
        // Mail::to($contact->email)->queue(new ContactAutoReply($contact));

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
        }

        return back()->with('success', 'Message sent successfully!');
    }
}