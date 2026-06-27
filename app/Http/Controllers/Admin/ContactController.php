<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function markRead(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        return back();
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted.');
    }
}
