@extends('layouts.admin')
@section('title', 'Skills')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">Skills</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">Manage your technical skills</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="btn-admin">
        <i class="fa-solid fa-plus"></i>
        New Skill
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
                    <th>Skill</th>
                    <th>Category</th>
                    <th>Proficiency</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <span class="text-base text-gold-base w-6 text-center flex-shrink-0">
                                @php $icon = $skill->icon; @endphp
                                @if(str_starts_with($icon, '<'))
                                    {!! $icon !!}
                                @elseif(str_starts_with($icon, 'fa-') || str_starts_with($icon, 'bi '))
                                    <i class="{{ $icon }}"></i>
                                @else
                                    {{ $icon }}
                                @endif
                            </span>
                            <span class="text-sm font-medium text-text-primary">{{ $skill->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="text-[10px] font-accent uppercase tracking-wider text-text-secondary bg-white/[0.04] px-2 py-0.5">{{ $skill->category?->name ?? 'Uncategorized' }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-3 max-w-xs">
                            <div class="flex-1 h-1 bg-white/[0.06] rounded-full overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-gold-dark via-gold-base to-gold-light" style="width: {{ $skill->proficiency }}%"></div>
                            </div>
                            <span class="text-[10px] font-mono text-text-secondary w-8 text-right flex-shrink-0">{{ $skill->proficiency }}%</span>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.skills.edit', $skill) }}"
                               class="btn-admin-sm bg-gold-base/10 text-gold-base hover:bg-gold-base/20">
                                <i class="fa-solid fa-pen-to-square"></i>Edit
                            </a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete this skill?');" class="inline">
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
                            <p class="text-text-secondary/50 text-sm font-light">No skills yet.</p>
                            <a href="{{ route('admin.skills.create') }}" class="text-gold-base hover:text-gold-light text-sm mt-2 inline-block">Add your first skill →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection