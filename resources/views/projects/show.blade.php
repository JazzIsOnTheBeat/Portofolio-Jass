@extends('layouts.app')
@section('content')
<div class="pt-32 pb-24 container mx-auto px-6 min-h-screen">
    <a href="{{ route('projects.index') }}"
       class="inline-flex items-center gap-2 text-sm font-accent uppercase tracking-[0.15em] text-text-secondary/60 hover:text-gold-base transition-colors duration-300 mb-8 group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to Projects
    </a>
    
    <div class="glass-gold rounded-2xl overflow-hidden">
        @if($project->thumbnail)
            <div class="w-full h-64 md:h-96 relative">
                <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-brand-secondary to-transparent"></div>
            </div>
        @endif
        
        <div class="p-8 md:p-12 relative z-10 {{ $project->thumbnail ? '-mt-24' : '' }}">
            <div class="text-xs text-gold-base font-mono mb-2">{{ $project->category }}</div>
            <h1 class="text-4xl md:text-5xl font-heading font-bold mb-6">{{ $project->title }}</h1>
            
            <div class="flex flex-wrap gap-4 mb-8">
                @if($project->tech_stack)
                    @foreach($project->tech_stack as $tech)
                        <span class="px-3 py-1 bg-brand-tertiary border border-white/10 rounded text-sm text-text-secondary">{{ $tech }}</span>
                    @endforeach
                @endif
            </div>
            
            <div class="max-w-none mb-12 text-text-secondary/80 leading-relaxed">
                {!! nl2br(e($project->long_description ?? $project->description)) !!}
            </div>
            
            <div class="flex flex-wrap gap-4 pt-8 border-t border-white/10">
                @if($project->live_url)
                    <x-golden-button href="{{ $project->live_url }}" target="_blank">View Live Site</x-golden-button>
                @endif
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="px-8 py-3 bg-brand-tertiary border border-white/20 text-white font-bold rounded-full hover:border-white/50 transition-all duration-300 flex items-center gap-2">
                        <i class="fab fa-github"></i> View Source
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
