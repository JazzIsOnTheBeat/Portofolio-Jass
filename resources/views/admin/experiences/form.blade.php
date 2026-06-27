@extends('layouts.admin')
@section('title', $experience->id ? 'Edit Experience' : 'Add Experience')
@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.experiences.index') }}"
       class="w-8 h-8 border border-white/[0.06] flex items-center justify-center text-text-secondary hover:text-text-primary hover:border-white/20 transition-all text-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">{{ $experience->id ? 'Edit Experience' : 'Add Experience' }}</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">{{ $experience->id ? 'Update work experience' : 'Add a new work experience' }}</p>
    </div>
</div>

@if ($errors->any())
    <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded mb-6 text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="admin-card p-6 lg:p-8 max-w-2xl">
    <form action="{{ $experience->id ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" method="POST">
        @csrf
        @if($experience->id) @method('PUT') @endif

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Title / Role <span class="text-gold-base">*</span></label>
                <input type="text" name="title" value="{{ old('title', $experience->title) }}"
                       class="admin-input" required>
            </div>
            <div>
                <label class="admin-label">Company <span class="text-gold-base">*</span></label>
                <input type="text" name="company" value="{{ old('company', $experience->company) }}"
                       class="admin-input" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="admin-label">Description <span class="text-gold-base">*</span></label>
            <textarea name="description" rows="4"
                      class="admin-input resize-none" required>{{ old('description', $experience->description) }}</textarea>
        </div>

        <div class="border-t border-white/[0.05] pt-6 mb-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="admin-label">Start Date <span class="text-gold-base">*</span></label>
                    <input type="date" name="start_date" value="{{ old('start_date', optional($experience->start_date)->format('Y-m-d')) }}"
                           class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', optional($experience->end_date)->format('Y-m-d')) }}"
                           class="admin-input">
                    <div class="mt-3">
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" name="is_current" id="is_current" value="1" {{ old('is_current') !== null ? (old('is_current') ? 'checked' : '') : ($experience->is_current ? 'checked' : '') }}
                                   class="admin-checkbox">
                            <span class="text-sm text-text-secondary/70 font-light">Currently working here</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $experience->id ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.experiences.index') }}" class="btn-admin-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection