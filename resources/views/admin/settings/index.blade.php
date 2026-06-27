@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-heading font-bold text-text-primary">Site Settings</h1>
    <p class="text-text-secondary text-sm mt-0.5 font-light">Manage your portfolio configuration</p>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded mb-6 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="admin-card p-6 lg:p-8 mb-5">
        <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold mb-6 pb-4 border-b border-white/[0.05] flex items-center gap-2">
            <i class="fa-solid fa-globe text-gold-base/60 text-xs"></i>
            General
        </h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="admin-label">Site Title</label>
                <input type="text" name="site_title" value="{{ $settings['site_title'] ?? '' }}"
                       class="admin-input">
            </div>
            <div>
                <label class="admin-label">Site Description (SEO)</label>
                <input type="text" name="site_description" value="{{ $settings['site_description'] ?? '' }}"
                       class="admin-input">
            </div>
            <div>
                <label class="admin-label">Contact Email</label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                       class="admin-input">
            </div>
        </div>
    </div>

    <div class="admin-card p-6 lg:p-8 mb-5">
        <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold mb-6 pb-4 border-b border-white/[0.05] flex items-center gap-2">
            <i class="fa-solid fa-house text-gold-base/60 text-xs"></i>
            Hero Section
        </h2>
        <div>
            <label class="admin-label">Hero Title</label>
            <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}"
                   class="admin-input">
        </div>
    </div>

    <div class="admin-card p-6 lg:p-8 mb-5">
        <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold mb-6 pb-4 border-b border-white/[0.05] flex items-center gap-2">
            <i class="fa-solid fa-user text-gold-base/60 text-xs"></i>
            About Section
        </h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="admin-label">About Text</label>
                <textarea name="about_text" rows="5"
                          class="admin-input resize-none">{{ $settings['about_text'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="admin-label">Resume File (PDF)</label>
                <input type="file" name="resume_file" accept=".pdf"
                       class="admin-input file:mr-3 file:py-1 file:px-3 file:border-0 file:bg-gold-base/10 file:text-gold-base file:text-[10px] file:font-accent file:uppercase file:tracking-wider hover:file:bg-gold-base/20">
                @if(isset($settings['resume_path']))
                    <p class="text-[10px] font-accent uppercase tracking-wider text-text-secondary/40 mt-2">Current file exists. Uploading a new one will replace it.</p>
                @endif
            </div>
        </div>
    </div>

    <button type="submit" class="btn-admin">
        <i class="fa-solid fa-floppy-disk"></i>
        Save All Settings
    </button>
</form>
@endsection