@extends('layouts.admin')
@section('title', 'Testimonials')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">Testimonials</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">What people say about you</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-admin">
        <i class="fa-solid fa-plus"></i>
        New Testimonial
    </a>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded mb-6 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif

<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse($testimonials as $test)
    <div class="admin-card p-6 relative">
        <div class="flex items-center gap-3 mb-4">
            @if($test->avatar)
                <img src="{{ Storage::url($test->avatar) }}" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
            @else
                <div class="w-10 h-10 rounded-full bg-gradient-gold flex items-center justify-center text-brand-primary font-heading font-bold text-sm flex-shrink-0">
                    {{ substr($test->name, 0, 1) }}
                </div>
            @endif
            <div>
                <h4 class="text-sm font-medium text-text-primary">{{ $test->name }}</h4>
                <p class="text-[10px] font-accent uppercase tracking-wider text-text-secondary/60">{{ $test->role }}@if($test->company) <span class="text-gold-base">\</span> {{ $test->company }} @endif</p>
            </div>
        </div>
        <p class="text-sm text-text-secondary font-light leading-relaxed mb-4">"{{ Str::limit(strip_tags($test->content), 150) }}"</p>
        <div class="flex items-center justify-between">
            <div class="flex gap-0.5 text-gold-base text-xs">
                @for($i=0; $i<5; $i++)
                    @if($i < $test->rating)
                        <i class="fa-solid fa-star"></i>
                    @else
                        <i class="fa-regular fa-star"></i>
                    @endif
                @endfor
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.testimonials.edit', $test) }}"
                   class="btn-admin-sm bg-gold-base/10 text-gold-base hover:bg-gold-base/20">
                    <i class="fa-solid fa-pen-to-square"></i>Edit
                </a>
                <form action="{{ route('admin.testimonials.destroy', $test) }}" method="POST" onsubmit="return confirm('Delete this testimonial?');" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-admin-sm bg-red-500/10 text-red-400 hover:bg-red-500/20">
                        <i class="fa-solid fa-trash-can"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full admin-card p-12 text-center">
        <p class="text-text-secondary/50 text-sm font-light">No testimonials yet.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="text-gold-base hover:text-gold-light text-sm mt-2 inline-block">Add your first testimonial →</a>
    </div>
    @endforelse
</div>
@endsection