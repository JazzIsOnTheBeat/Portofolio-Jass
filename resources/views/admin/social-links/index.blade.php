@extends('layouts.admin')
@section('title', 'Social Links')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-heading font-bold text-text-primary">Social Links</h1>
    <p class="text-text-secondary text-sm mt-0.5 font-light">Manage your social media presence</p>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded mb-6 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded mb-6 text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="admin-card p-6 lg:p-8 mb-5">
    <h3 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold mb-5 flex items-center gap-2">
        <i class="fa-solid fa-plus-circle text-gold-base text-xs"></i>
        Add New Link
    </h3>
    <form action="{{ route('admin.social-links.store') }}" method="POST" class="grid md:grid-cols-5 gap-4 items-end">
        @csrf
        <div>
            <label class="admin-label">Platform</label>
            <input type="text" name="platform" class="admin-input" required placeholder="GitHub">
        </div>
        <div>
            <label class="admin-label">URL</label>
            <input type="url" name="url" class="admin-input" required placeholder="https://github.com/...">
        </div>
        <div>
            <label class="admin-label">Icon</label>
            <input type="text" name="icon" class="admin-input" required placeholder="fab fa-github or bi bi-github">
            <p class="text-[10px] text-text-secondary/50 mt-1 font-light">
                <code class="text-text-secondary">fa-brands fa-github</code> · <code class="text-text-secondary">bi bi-github</code>
            </p>
        </div>
        <div>
            <label class="admin-label">Sort</label>
            <input type="number" name="sort_order" value="0" class="admin-input">
        </div>
        <button type="submit" class="btn-admin w-full justify-center">
            <i class="fa-solid fa-plus"></i>
            Add
        </button>
    </form>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left admin-table">
            <thead>
                <tr>
                    <th>Platform</th>
                    <th>URL</th>
                    <th>Sort</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($links as $link)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <span class="text-base text-gold-base w-6 text-center flex-shrink-0">
                                @php $icon = $link->icon; @endphp
                                @if(str_starts_with($icon, '<'))
                                    {!! $icon !!}
                                @elseif(str_starts_with($icon, 'fa-') || str_starts_with($icon, 'bi '))
                                    <i class="{{ $icon }}"></i>
                                @else
                                    {{ $icon }}
                                @endif
                            </span>
                            <span class="text-sm font-medium text-text-primary">{{ $link->platform }}</span>
                        </div>
                    </td>
                    <td>
                        <a href="{{ $link->url }}" target="_blank"
                           class="text-sm text-gold-base hover:text-gold-light transition">
                            {{ $link->url }}
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-1"></i>
                        </a>
                    </td>
                    <td class="text-sm text-text-secondary font-light">{{ $link->sort_order }}</td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" onsubmit="return confirm('Delete this link?');" class="inline">
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
                            <p class="text-text-secondary/50 text-sm font-light">No social links yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection