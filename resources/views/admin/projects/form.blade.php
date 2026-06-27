@extends('layouts.admin')
@section('title', $project->id ? 'Edit Project' : 'Create Project')
@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.projects.index') }}"
       class="w-8 h-8 border border-white/[0.06] flex items-center justify-center text-text-secondary hover:text-text-primary hover:border-white/20 transition-all text-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">{{ $project->id ? 'Edit Project' : 'Create Project' }}</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">{{ $project->id ? 'Update project details' : 'Add a new project to your portfolio' }}</p>
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

<div class="admin-card p-6 lg:p-8 max-w-4xl">
    <form action="{{ $project->id ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($project->id) @method('PUT') @endif

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Title <span class="text-gold-base">*</span></label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}"
                       class="admin-input" required>
            </div>
            <div>
                <label class="admin-label">Category <span class="text-gold-base">*</span></label>
                <input type="text" name="category" value="{{ old('category', $project->category) }}"
                       class="admin-input" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="admin-label">Short Description <span class="text-gold-base">*</span></label>
            <textarea name="description" rows="2"
                      class="admin-input resize-none" required>{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="mb-6">
            <label class="admin-label">Long Description</label>
            <textarea name="long_description" rows="5"
                      class="admin-input resize-y">{{ old('long_description', $project->long_description) }}</textarea>
            <p class="text-text-secondary/40 text-[10px] font-accent uppercase tracking-wider mt-1">Markdown &amp; HTML supported</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Tech Stack</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : '') }}"
                       class="admin-input" placeholder="Laravel, Vue, Tailwind">
            </div>
            <div>
                <label class="admin-label">Thumbnail</label>
                <input type="file" name="thumbnail" accept="image/*"
                       class="admin-input file:mr-3 file:py-1 file:px-3 file:border-0 file:bg-gold-base/10 file:text-gold-base file:text-[10px] file:font-accent file:uppercase file:tracking-wider hover:file:bg-gold-base/20">
                @if($project->thumbnail)
                    <div class="mt-2 flex items-center gap-3 text-sm text-text-secondary">
                        <span class="text-[10px] font-accent uppercase tracking-wider text-text-secondary/50">Current:</span>
                        <img src="{{ Storage::url($project->thumbnail) }}" class="h-10 rounded border border-white/[0.05]">
                    </div>
                @endif
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="admin-label">Live URL</label>
                <input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}"
                       class="admin-input" placeholder="https://">
            </div>
            <div>
                <label class="admin-label">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}"
                       class="admin-input" placeholder="https://github.com/">
            </div>
        </div>

        <div class="border-t border-white/[0.05] pt-6 mb-6">
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label class="admin-label">Status</label>
                    <select name="status" class="admin-select">
                        <option value="published" {{ old('status', $project->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $project->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div>
                    <label class="admin-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}"
                           class="admin-input">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') !== null ? (old('is_featured') ? 'checked' : '') : ($project->is_featured ? 'checked' : '') }}
                               class="admin-checkbox">
                        <span class="text-sm text-text-secondary/70 font-light">Featured Project</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $project->id ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn-admin-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection