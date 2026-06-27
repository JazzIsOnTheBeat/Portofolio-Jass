@extends('layouts.admin')
@section('title', 'Message from ' . $contact->name)
@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.contacts.index') }}"
       class="w-8 h-8 border border-white/[0.06] flex items-center justify-center text-text-secondary hover:text-text-primary hover:border-white/20 transition-all text-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">Message</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">From {{ $contact->name }}</p>
    </div>
</div>

<div class="admin-card p-6 lg:p-8 max-w-4xl">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-4 mb-6 pb-6 border-b border-white/[0.05]">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-gradient-gold flex items-center justify-center text-brand-primary font-heading font-bold text-lg flex-shrink-0">
                {{ substr($contact->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-base font-heading font-bold text-text-primary">{{ $contact->subject }}</h2>
                <p class="text-sm text-text-secondary font-light mt-0.5">
                    <span class="font-medium text-text-primary">{{ $contact->name }}</span>
                    <span class="mx-1.5 text-text-secondary/30">·</span>
                    <a href="mailto:{{ $contact->email }}" class="text-gold-base hover:text-gold-light transition">{{ $contact->email }}</a>
                </p>
            </div>
        </div>
        <span class="text-[10px] font-accent uppercase tracking-wider text-text-secondary/40 whitespace-nowrap">{{ $contact->created_at->format('M d, Y — h:i A') }}</span>
    </div>

    <div class="text-text-primary text-sm leading-relaxed whitespace-pre-wrap bg-white/[0.02] p-6 border border-white/[0.04]">
        {{ $contact->message }}
    </div>

    <div class="mt-6 pt-6 border-t border-white/[0.05]">
        <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject) }}"
           class="btn-admin">
            <i class="fa-solid fa-reply"></i>
            Reply via Email
        </a>
    </div>
</div>
@endsection