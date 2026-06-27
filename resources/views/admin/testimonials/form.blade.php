@extends('layouts.admin')
@section('title', $testimonial->id ? 'Edit Testimonial' : 'Add Testimonial')
@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.testimonials.index') }}"
       class="w-8 h-8 border border-white/[0.06] flex items-center justify-center text-text-secondary hover:text-text-primary hover:border-white/20 transition-all text-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">{{ $testimonial->id ? 'Edit Testimonial' : 'Add Testimonial' }}</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">{{ $testimonial->id ? 'Update testimonial details' : 'Share what others say about you' }}</p>
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
    <form action="{{ $testimonial->id ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($testimonial->id) @method('PUT') @endif

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Name <span class="text-gold-base">*</span></label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}"
                       class="admin-input" required>
            </div>
            <div>
                <label class="admin-label">Avatar</label>
                <input type="file" name="avatar" accept="image/*"
                       class="admin-input file:mr-3 file:py-1 file:px-3 file:border-0 file:bg-gold-base/10 file:text-gold-base file:text-[10px] file:font-accent file:uppercase file:tracking-wider hover:file:bg-gold-base/20">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Role / Position</label>
                <input type="text" name="role" value="{{ old('role', $testimonial->role) }}"
                       class="admin-input">
            </div>
            <div>
                <label class="admin-label">Company</label>
                <input type="text" name="company" value="{{ old('company', $testimonial->company) }}"
                       class="admin-input">
            </div>
        </div>

        <div class="mb-6">
            <label class="admin-label">Testimonial <span class="text-gold-base">*</span></label>
            <textarea name="content" rows="4"
                      class="admin-input resize-none" required>{{ old('content', $testimonial->content) }}</textarea>
        </div>

        <div class="border-t border-white/[0.05] pt-6 mb-6">
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label class="admin-label">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}"
                           class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}"
                           class="admin-input">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') !== null ? (old('is_featured') ? 'checked' : '') : ($testimonial->is_featured ? 'checked' : '') }}
                               class="admin-checkbox">
                        <span class="text-sm text-text-secondary/70 font-light">Featured</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $testimonial->id ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-admin-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection