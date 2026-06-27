@extends('layouts.app')
@section('content')
<div class="pt-32 pb-24 container mx-auto px-6 min-h-screen">
    {{-- Back button --}}
    <a href="{{ route('home') }}#projects"
       class="inline-flex items-center gap-2 text-sm font-accent uppercase tracking-[0.15em] text-text-secondary/60 hover:text-gold-base transition-colors duration-300 mb-8 group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to Home
    </a>

    <x-section-heading title="All Projects" subtitle="A collection of everything I have built." />

    {{-- Category Filter --}}
    <div class="flex flex-wrap justify-center gap-3 mb-14">
        <a href="{{ route('projects.index') }}"
           class="font-accent uppercase tracking-[0.15em] text-xs px-5 py-2.5 border transition-all duration-300 {{ request('category') ? 'border-white/[0.06] text-text-secondary/60 hover:text-text-primary hover:border-white/20' : 'bg-gold-base/10 border-gold-base/30 text-gold-base' }}">
            All
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('projects.index', ['category' => $cat]) }}"
               class="font-accent uppercase tracking-[0.15em] text-xs px-5 py-2.5 border transition-all duration-300 {{ request('category') == $cat ? 'bg-gold-base/10 border-gold-base/30 text-gold-base' : 'border-white/[0.06] text-text-secondary/60 hover:text-text-primary hover:border-white/20' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
        <div class="glass rounded-2xl overflow-hidden group hover-lift scroll-reveal">
            <div class="relative h-52 bg-brand-tertiary overflow-hidden">
                @if($project->thumbnail)
                    <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}"
                         class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center text-text-secondary/30 bg-brand-tertiary font-heading text-3xl italic">{{ $project->title }}</div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-brand-primary via-brand-primary/50 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="px-8 py-3 bg-gold-base/90 text-brand-primary font-accent text-xs uppercase tracking-[0.15em] font-semibold backdrop-blur-sm hover:bg-gold-base transition-colors">
                        View Detail
                    </a>
                </div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 text-[10px] font-accent uppercase tracking-[0.15em] bg-brand-primary/60 text-gold-base/80 backdrop-blur-sm border border-gold-base/10">{{ $project->category }}</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-heading font-light mb-2 group-hover:text-gold-light transition-colors duration-300">{{ $project->title }}</h3>
                <p class="text-sm text-text-secondary font-light leading-relaxed line-clamp-2">{{ $project->description }}</p>
                @if(is_array($project->tech_stack) && count($project->tech_stack) > 0)
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                    <span class="text-[10px] font-mono text-text-secondary/60 border border-white/5 px-2 py-1 rounded">{{ $tech }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full border border-white/[0.06] flex items-center justify-center text-text-secondary/30">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
            <p class="text-text-secondary/50 text-sm font-light">No projects yet.</p>
        </div>
        @endforelse
    </div>

    @if($projects->hasPages())
    <div class="mt-14 flex justify-center">
        {{ $projects->onEachSide(1)->links('vendor.pagination.admin') }}
    </div>
    @endif
</div>
@endsection
