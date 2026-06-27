@extends('layouts.admin')
@section('title', $education->id ? 'Edit Education' : 'Add Education')
@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.educations.index') }}"
       class="w-8 h-8 border border-white/[0.06] flex items-center justify-center text-text-secondary hover:text-text-primary hover:border-white/20 transition-all text-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">{{ $education->id ? 'Edit Education' : 'Add Education' }}</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">{{ $education->id ? 'Update education details' : 'Add your academic background' }}</p>
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
    <form action="{{ $education->id ? route('admin.educations.update', $education) : route('admin.educations.store') }}" method="POST">
        @csrf
        @if($education->id) @method('PUT') @endif

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Degree <span class="text-gold-base">*</span></label>
                <input type="text" name="degree" value="{{ old('degree', $education->degree) }}"
                       class="admin-input" required>
            </div>
            <div>
                <label class="admin-label">Institution <span class="text-gold-base">*</span></label>
                <input type="text" name="institution" value="{{ old('institution', $education->institution) }}"
                       class="admin-input" required>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Field of Study</label>
                <input type="text" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}"
                       class="admin-input">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="admin-label">Start Year <span class="text-gold-base">*</span></label>
                    <input type="number" name="start_year" value="{{ old('start_year', $education->start_year) }}"
                           class="admin-input" min="1900" max="2099" required>
                </div>
                <div>
                    <label class="admin-label">End Year</label>
                    <input type="number" name="end_year" value="{{ old('end_year', $education->end_year) }}"
                           class="admin-input" min="1900" max="2099">
                </div>
            </div>
        </div>

        <div class="mb-6">
            <label class="admin-label">Description</label>
            <textarea name="description" rows="3"
                      class="admin-input resize-none">{{ old('description', $education->description) }}</textarea>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $education->id ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.educations.index') }}" class="btn-admin-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection