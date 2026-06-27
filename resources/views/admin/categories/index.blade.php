@extends('layouts.admin')
@section('title', 'Categories')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">Categories</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">Manage skill categories</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn-admin">
        <i class="fa-solid fa-plus"></i>
        New Category
    </a>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded mb-6 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded mb-6 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-exclamation"></i>
        {{ session('error') }}
    </div>
@endif

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Skills</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>
                        <span class="text-sm font-medium text-text-primary">{{ $category->name }}</span>
                    </td>
                    <td>
                        <code class="text-[10px] text-text-secondary/60">{{ $category->slug }}</code>
                    </td>
                    <td>
                        <span class="text-xs text-text-secondary">{{ $category->skills->count() }}</span>
                    </td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="btn-admin-sm bg-gold-base/10 text-gold-base hover:bg-gold-base/20">
                                <i class="fa-solid fa-pen-to-square"></i>Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Delete this category?');" class="inline">
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
                            <p class="text-text-secondary/50 text-sm font-light">No categories yet.</p>
                            <a href="{{ route('admin.categories.create') }}" class="text-gold-base hover:text-gold-light text-sm mt-2 inline-block">Create your first category →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
