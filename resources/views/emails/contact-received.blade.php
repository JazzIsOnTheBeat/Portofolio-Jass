<div>
    <h2>New Message from {{ $contact->name }}</h2>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Subject:</strong> {{ $contact->subject }}</p>
    <hr>
    <p>{!! nl2br(e($contact->message)) !!}</p>
</div>
