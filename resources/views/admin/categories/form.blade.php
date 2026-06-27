@extends('layouts.admin')
@section('title', $category->id ? 'Edit Category' : 'Add Category')
@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.categories.index') }}"
       class="w-8 h-8 border border-white/[0.06] flex items-center justify-center text-text-secondary hover:text-text-primary hover:border-white/20 transition-all text-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">{{ $category->id ? 'Edit Category' : 'Add Category' }}</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">{{ $category->id ? 'Update category details' : 'Add a new skill category' }}</p>
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

<div class="admin-card p-6 lg:p-8 max-w-lg">
    <form action="{{ $category->id ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
        @csrf
        @if($category->id) @method('PUT') @endif

        <div class="mb-6">
            <label class="admin-label">Name <span class="text-gold-base">*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="admin-input" required autofocus>
            <p class="text-[10px] text-text-secondary/50 mt-1.5 font-light">Slug will be auto-generated from the name.</p>
        </div>

        <div class="mb-6">
            <label class="admin-label">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                   class="admin-input">
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $category->id ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-admin-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
