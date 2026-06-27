@extends('layouts.admin')
@section('title', 'Experience')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">Experience</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">Your professional journey</p>
    </div>
    <a href="{{ route('admin.experiences.create') }}" class="btn-admin">
        <i class="fa-solid fa-plus"></i>
        New Experience
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
                    <th>Position &amp; Company</th>
                    <th>Period</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experiences as $exp)
                <tr>
                    <td>
                        <div class="text-sm font-medium text-text-primary">{{ $exp->title }}</div>
                        <div class="text-xs text-text-secondary font-light mt-0.5">{{ $exp->company }}</div>
                    </td>
                    <td class="text-sm text-text-secondary font-light">
                        {{ $exp->start_date->format('M Y') }} —
                        @if($exp->is_current)
                            <span class="text-gold-base font-medium">Present</span>
                        @else
                            {{ $exp->end_date ? $exp->end_date->format('M Y') : '' }}
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.experiences.edit', $exp) }}"
                               class="btn-admin-sm bg-gold-base/10 text-gold-base hover:bg-gold-base/20">
                                <i class="fa-solid fa-pen-to-square"></i>Edit
                            </a>
                            <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Delete this experience?');" class="inline">
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
                    <td colspan="3">
                        <div class="text-center py-12">
                            <p class="text-text-secondary/50 text-sm font-light">No experiences yet.</p>
                            <a href="{{ route('admin.experiences.create') }}" class="text-gold-base hover:text-gold-light text-sm mt-2 inline-block">Add your first experience →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection