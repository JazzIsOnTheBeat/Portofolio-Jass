@extends('layouts.admin')
@section('title', 'Projects')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">Projects</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">Manage your portfolio projects</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn-admin">
        <i class="fa-solid fa-plus"></i>
        New Project
    </a>
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
                    <th>Project</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            @if($project->thumbnail)
                                <img src="{{ Storage::url($project->thumbnail) }}" class="w-12 h-9 object-cover rounded border border-white/[0.06] flex-shrink-0">
                            @else
                                <div class="w-12 h-9 bg-white/[0.03] rounded border border-white/[0.06] flex items-center justify-center text-text-secondary/30 text-xs flex-shrink-0">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                            <div>
                                <span class="text-sm font-medium text-text-primary">{{ $project->title }}</span>
                                @if($project->is_featured)
                                    <i class="fa-solid fa-star text-gold-base text-[10px] ml-1" title="Featured"></i>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td><span class="text-xs text-text-secondary bg-white/[0.04] px-2 py-0.5 font-mono">{{ $project->category }}</span></td>
                    <td>
                        @if($project->status == 'published')
                            <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-accent uppercase tracking-wider bg-green-500/10 text-green-400">Published</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-accent uppercase tracking-wider bg-yellow-500/10 text-yellow-400">Draft</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="btn-admin-sm bg-gold-base/10 text-gold-base hover:bg-gold-base/20">
                                <i class="fa-solid fa-pen-to-square"></i>Edit
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?');" class="inline">
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
                            <p class="text-text-secondary/50 text-sm font-light">No projects yet.</p>
                            <a href="{{ route('admin.projects.create') }}" class="text-gold-base hover:text-gold-light text-sm mt-2 inline-block">Create your first project →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection