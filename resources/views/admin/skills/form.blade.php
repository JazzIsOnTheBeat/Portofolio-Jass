@extends('layouts.admin')
@section('title', $skill->id ? 'Edit Skill' : 'Add Skill')
@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.skills.index') }}"
       class="w-8 h-8 border border-white/[0.06] flex items-center justify-center text-text-secondary hover:text-text-primary hover:border-white/20 transition-all text-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">{{ $skill->id ? 'Edit Skill' : 'Add Skill' }}</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">{{ $skill->id ? 'Update skill details' : 'Add a new skill to your portfolio' }}</p>
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
    <form action="{{ $skill->id ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST">
        @csrf
        @if($skill->id) @method('PUT') @endif

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Name <span class="text-gold-base">*</span></label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}"
                       class="admin-input" required>
            </div>
            <div>
                <label class="admin-label">Category <span class="text-gold-base">*</span></label>
                <select name="category_id" class="admin-select">
                    <option value="">— Select —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $skill->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="admin-label">Icon</label>
                <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}"
                       class="admin-input" placeholder="fa-brands fa-laravel or bi bi-laptop">
                <p class="text-[10px] text-text-secondary/50 mt-1.5 font-light">
                    <span class="text-gold-base">Font Awesome</span>: <code class="text-text-secondary">fa-brands fa-laravel</code>
                    &nbsp;·&nbsp;
                    <span class="text-gold-base">Bootstrap Icons</span>: <code class="text-text-secondary">bi bi-laptop</code>
                </p>
            </div>
            <div>
                <label class="admin-label">Proficiency (%)</label>
                <input type="number" name="proficiency" min="0" max="100" value="{{ old('proficiency', $skill->proficiency ?? 80) }}"
                       class="admin-input">
            </div>
            <div>
                <label class="admin-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}"
                       class="admin-input">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $skill->id ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.skills.index') }}" class="btn-admin-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection