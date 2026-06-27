@extends('layouts.admin')
@section('title', 'Inbox')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-heading font-bold text-text-primary">Inbox</h1>
    <p class="text-text-secondary text-sm mt-0.5 font-light">Messages from your visitors</p>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded mb-6 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left admin-table">
            <thead>
                <tr>
                    <th>From</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr class="{{ !$contact->is_read ? 'bg-gold-base/[0.03]' : '' }}">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-gold flex items-center justify-center text-brand-primary font-heading font-bold text-sm flex-shrink-0">
                                {{ substr($contact->name, 0, 1) }}
                            </div>
                            <div>
                                <span class="text-sm {{ !$contact->is_read ? 'font-medium text-text-primary' : 'text-text-secondary' }}">{{ $contact->name }}</span>
                                <br>
                                <span class="text-[10px] font-accent uppercase tracking-wider text-text-secondary/40">{{ $contact->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-sm {{ !$contact->is_read ? 'font-medium text-text-primary' : 'text-text-secondary' }}">{{ $contact->subject }}</span>
                        @if(!$contact->is_read)
                            <span class="ml-2 w-2 h-2 rounded-full bg-gold-base inline-block align-middle"></span>
                        @endif
                    </td>
                    <td class="text-sm text-text-secondary font-light">{{ $contact->created_at->diffForHumans() }}</td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.contacts.show', $contact->id) }}"
                               class="btn-admin-sm bg-gold-base/10 text-gold-base hover:bg-gold-base/20">
                                <i class="fa-solid fa-envelope-open-text"></i>Read
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Delete this message?');" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="btn-admin-sm bg-red-500/10 text-red-400 hover:bg-red-500/20">
                                    <i class="fa-solid fa-trash-can"></i>Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="text-center py-12">
                            <p class="text-text-secondary/50 text-sm font-light">Inbox is empty.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($contacts, 'links'))
    <div class="p-4 border-t border-white/[0.05]">
        {{ $contacts->links('vendor.pagination.admin') }}
    </div>
    @endif
</div>
@endsection