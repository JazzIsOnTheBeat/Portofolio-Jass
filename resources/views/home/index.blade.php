@extends('layouts.app')
@section('content')
<!-- Hero Section -->
<section id="home" class="min-h-screen relative flex items-center justify-center overflow-hidden noise">
    <!-- Background layers -->
    <div class="absolute inset-0 z-0">
        <!-- Radial gradient backdrop -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(201,168,76,0.06)_0%,_transparent_70%)]"></div>
        <!-- Particle canvas -->
        <canvas id="particleCanvas" class="absolute inset-0 w-full h-full opacity-40"></canvas>
        <!-- Bottom fade -->
        <div class="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-brand-primary to-transparent"></div>
    </div>

    <!-- Geometric decoration -->
    <div class="geo-shape w-64 h-64 rounded-full top-20 -right-20 opacity-30 animate-float hidden md:block"></div>
    <div class="geo-shape w-40 h-40 rotate-45 bottom-40 -left-10 opacity-20 animate-float-delayed hidden md:block"></div>
    <div class="geo-shape w-20 h-20 rounded-full top-1/3 left-1/4 opacity-10 animate-pulse-glow hidden md:block" style="border-color: rgba(201,168,76,0.15);"></div>

    <div class="container mx-auto px-6 relative z-10 text-center pt-20">
        <!-- Avatar with glow -->
        <div class="w-36 h-36 mx-auto mb-10 relative group scroll-reveal">
            <div class="absolute -inset-3 rounded-full bg-gradient-to-br from-gold-base/20 via-transparent to-gold-dark/20 opacity-50 group-hover:opacity-100 blur-xl transition-all duration-700"></div>
            <div class="absolute -inset-1 rounded-full bg-gradient-to-br from-gold-base/30 to-gold-dark/10 animate-spin" style="animation-duration: 8s;"></div>
            <img src="https://ui-avatars.com/api/?name=Jass&background=0E0E12&color=C9A84C&size=256&font-size=0.4" alt="Jass" class="rounded-full w-full h-full object-cover border border-gold-base/20 relative z-10">
        </div>
        
        <!-- Overline -->
        <div class="scroll-reveal mb-4">
            <span class="font-accent text-xs uppercase tracking-[0.4em] text-gold-base/70">Portfolio & Creative Works</span>
        </div>

        <!-- Main heading -->
        <h1 class="text-5xl sm:text-6xl md:text-8xl font-heading font-light mb-8 scroll-reveal leading-[0.95] tracking-wide">
            <span class="text-text-primary">Hello, I am </span>
            <span class="text-gradient-gold italic">Jass</span><span class="text-gold-base">.</span>
        </h1>
        
        <!-- Typewriter -->
        <p class="text-xl md:text-2xl text-text-secondary font-body font-light mb-12 h-10 scroll-reveal"><span class="typewriter"></span></p>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-5 justify-center items-center scroll-reveal">
            <x-golden-button href="#projects">View My Work</x-golden-button>
            <a href="{{ route('resume.download') }}" class="magnetic-btn inline-flex items-center gap-3 px-10 py-4 font-accent text-sm uppercase tracking-[0.15em] text-gold-base border border-gold-base/30 hover:border-gold-base/60 hover:bg-gold-base/5 transition-all duration-500 group">
                <span>Download CV</span>
                <svg class="w-4 h-4 transform group-hover:translate-y-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v12m0 0l-4-4m4 4l4-4m-8 8h8"/></svg>
            </a>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3">
        <span class="text-[10px] font-accent uppercase tracking-[0.3em] text-text-secondary/40">Scroll</span>
        <div class="w-px h-10 bg-gradient-to-b from-gold-base/40 to-transparent animate-pulse"></div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ -->
<!-- About Section -->
<section id="about" class="py-28 relative">
    <div class="container mx-auto px-6">
        <x-section-heading title="About Me" subtitle="A glimpse into my journey, passion, and vision." />
        
        <div class="grid md:grid-cols-5 gap-12 items-start">
            <!-- Left: Story -->
            <div class="md:col-span-3 glass-gold p-10 rounded-2xl scroll-reveal relative overflow-hidden">
                <!-- Corner accent -->
                <div class="absolute top-0 left-0 w-16 h-16 border-t border-l border-gold-base/20"></div>
                <div class="absolute bottom-0 right-0 w-16 h-16 border-b border-r border-gold-base/20"></div>
                
                <h3 class="text-3xl font-heading font-light text-gradient-gold mb-6 italic">My Journey</h3>
                <p class="text-text-secondary leading-[1.9] mb-8 font-light text-lg">
                    {{ App\Services\SettingService::get('about_text', 'I am a passionate AI enthusiast and Web Developer who thrives on building elegant, high-performance digital experiences. With deep expertise in modern web frameworks and machine learning, I bridge the gap between beautiful design and intelligent systems.') }}
                </p>
                
                <!-- Stats -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 pt-8 border-t border-white/5">
                    <div class="text-center">
                        <div class="text-4xl font-heading font-light text-gradient-gold mb-1"><span class="counter" data-target="{{ $projectCount }}">0</span>+</div>
                        <div class="text-text-secondary text-xs font-accent uppercase tracking-[0.15em]">Projects</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-heading font-light text-gradient-gold mb-1"><span class="counter" data-target="{{ $clientCount }}">0</span>+</div>
                        <div class="text-text-secondary text-xs font-accent uppercase tracking-[0.15em]">Clients</div>
                    </div>
                    <div class="text-center hidden sm:block">
                        <div class="text-4xl font-heading font-light text-gradient-gold mb-1"><span class="counter" data-target="{{ $yearsExp }}">0</span>+</div>
                        <div class="text-text-secondary text-xs font-accent uppercase tracking-[0.15em]">Years Exp</div>
                    </div>
                </div>
            </div>
            
            <!-- Right: Expertise cards -->
            <div class="md:col-span-2 space-y-6">
                <div class="glass p-7 rounded-xl scroll-reveal hover-lift group">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gold-base/10 flex items-center justify-center text-gold-base text-xl group-hover:bg-gold-base/20 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                        <div>
                            <h4 class="font-heading text-xl font-light">Web Development</h4>
                        </div>
                    </div>
                    <p class="text-sm text-text-secondary font-light leading-relaxed">Laravel, React, Tailwind — crafting responsive, pixel-perfect interfaces with robust backends.</p>
                </div>
                
                <div class="glass p-7 rounded-xl scroll-reveal hover-lift group" style="animation-delay: 150ms;">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gold-base/10 flex items-center justify-center text-gold-base text-xl group-hover:bg-gold-base/20 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-heading text-xl font-light">AI / Machine Learning</h4>
                        </div>
                    </div>
                    <p class="text-sm text-text-secondary font-light leading-relaxed">Python, PyTorch, TensorFlow — building intelligent systems that learn and adapt.</p>
                </div>
                
                <div class="glass p-7 rounded-xl scroll-reveal hover-lift group" style="animation-delay: 300ms;">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gold-base/10 flex items-center justify-center text-gold-base text-xl group-hover:bg-gold-base/20 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-heading text-xl font-light">UI/UX Design</h4>
                        </div>
                    </div>
                    <p class="text-sm text-text-secondary font-light leading-relaxed">Figma, design systems — turning complex workflows into intuitive, delightful interfaces.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ -->
<!-- Skills Section -->
<section id="skills" class="py-28 relative overflow-hidden">
    <!-- Subtle background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(201,168,76,0.03)_0%,_transparent_60%)]"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <x-section-heading title="My Expertise" subtitle="Technologies and tools I use to bring ideas to life." />

        {{-- Tabs --}}
        @php $skillsCount = count($skills); @endphp

        @if($skillsCount > 0)
        <div class="flex flex-wrap justify-center gap-2 mb-12" role="tablist">
            @foreach($skills as $category => $categorySkills)
            <button data-tab="{{ Str::slug($category) }}"
                    class="tab-btn font-accent uppercase tracking-[0.15em] text-xs px-5 py-2.5 border border-white/[0.06] text-text-secondary/60 hover:text-text-primary hover:border-white/20 transition-all duration-300 {{ $loop->first ? 'bg-gold-base/10 border-gold-base/30 text-gold-base' : '' }}"
                    role="tab"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                {{ $category }}
            </button>
            @endforeach
        </div>
        @endif

        {{-- Panels --}}
        @forelse($skills as $category => $categorySkills)
        <div data-panel="{{ Str::slug($category) }}"
             class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 tab-panel {{ $loop->first ? '' : 'hidden' }}"
             role="tabpanel">
            @foreach($categorySkills as $skill)
            <div class="glass p-7 rounded-2xl scroll-reveal hover-lift group">
                <div class="space-y-5">
                    <div class="group/skill">
                        <div class="flex justify-between items-end mb-2">
                            <div class="flex items-center gap-3">
                                <span class="text-lg opacity-60 group-hover/skill:opacity-100 transition">{!! safe_icon($skill->icon) !!}</span>
                                <span class="text-sm font-medium group-hover/skill:text-gold-light transition-colors duration-300">{{ $skill->name }}</span>
                            </div>
                            <span class="text-[10px] font-mono text-text-secondary/50">{{ $skill->proficiency }}%</span>
                        </div>
                        <div class="w-full bg-white/[0.03] rounded-full h-1 overflow-hidden">
                            <div class="bg-gradient-to-r from-gold-dark via-gold-base to-gold-light h-1 rounded-full skill-progress opacity-0 w-0 transition-all duration-[1.5s] ease-out" data-width="{{ $skill->proficiency }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @empty
        <div class="text-center py-20">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full border border-white/[0.06] flex items-center justify-center text-text-secondary/30">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <p class="text-text-secondary/50 text-sm font-light">No skills added yet.</p>
        </div>
        @endforelse
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('#skills .tab-btn');
    const panels = document.querySelectorAll('#skills .tab-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.tab;

            tabs.forEach(t => {
                t.classList.remove('bg-gold-base/10', 'border-gold-base/30', 'text-gold-base');
                t.classList.add('text-text-secondary/60');
                t.setAttribute('aria-selected', 'false');
            });

            panels.forEach(p => p.classList.add('hidden'));

            tab.classList.add('bg-gold-base/10', 'border-gold-base/30', 'text-gold-base');
            tab.classList.remove('text-text-secondary/60');
            tab.setAttribute('aria-selected', 'true');

            const panel = document.querySelector(`[data-panel="${target}"]`);
            if (panel) {
                panel.classList.remove('hidden');
                // Re-trigger scroll-reveal
                panel.querySelectorAll('.scroll-reveal').forEach(el => {
                    el.style.animation = 'none';
                    el.offsetHeight;
                    el.style.animation = '';
                });
            }
        });
    });
});
</script>
@endpush

<!-- ═══════════════════════════════════════════ -->
<!-- Projects Section -->
<section id="projects" class="py-28 relative">
    <div class="container mx-auto px-6 relative z-10">
        <x-section-heading title="Featured Projects" subtitle="Selected works that I'm most proud of." />
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <div class="tilt-card glass rounded-2xl overflow-hidden group hover-lift scroll-reveal">
                    <!-- Image -->
                    <div class="relative h-52 bg-brand-tertiary overflow-hidden">
                        @if($project->thumbnail)
                            <img src="{{ Storage::url($project->thumbnail) }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700" alt="{{ $project->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-text-secondary/30 bg-brand-tertiary font-heading text-3xl italic">{{ $project->title }}</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-primary via-brand-primary/50 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <a href="{{ route('projects.show', $project->slug) }}" class="px-8 py-3 bg-gold-base/90 text-brand-primary font-accent text-xs uppercase tracking-[0.15em] font-semibold backdrop-blur-sm hover:bg-gold-base transition-colors">View Detail</a>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-[10px] font-accent uppercase tracking-[0.15em] bg-brand-primary/60 text-gold-base/80 backdrop-blur-sm border border-gold-base/10">{{ $project->category }}</span>
                        </div>
                    </div>
                    <!-- Content -->
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
                <div class="text-center py-20 col-span-full">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full border border-white/[0.06] flex items-center justify-center text-text-secondary/30">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <p class="text-text-secondary/50 text-sm font-light">No projects yet.</p>
                </div>
            @endforelse
        
        @if($projects->isNotEmpty())
        <div class="text-center mt-16 scroll-reveal">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-3 font-accent text-sm uppercase tracking-[0.15em] text-gold-base hover:text-gold-light transition-colors duration-300 group">
                <span>View All Projects</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- ═══════════════════════════════════════════ -->
<!-- Experience Section -->
<section id="experience" class="py-28 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(201,168,76,0.03)_0%,_transparent_60%)]"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <x-section-heading title="Experience & Education" subtitle="My professional and academic journey." />
        
        <div class="grid lg:grid-cols-2 gap-16">
            <!-- Experience -->
            <div>
                <div class="flex items-center gap-4 mb-10 scroll-reveal">
                    <div class="w-10 h-10 rounded-lg bg-gold-base/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gold-base" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-light text-gradient-gold italic">Experience</h3>
                </div>
                
                <div class="space-y-0 relative ml-5 border-l border-gold-base/10">
                    @forelse($experiences as $exp)
                    <div class="relative pl-8 pb-10 last:pb-0 scroll-reveal group">
                        <!-- Timeline dot -->
                        <div class="absolute -left-[5px] top-1 w-[10px] h-[10px] rounded-full border-2 border-gold-base bg-brand-primary group-hover:bg-gold-base transition-colors duration-300"></div>
                        
                        <div class="text-[10px] font-accent uppercase tracking-[0.2em] text-gold-base/60 mb-2">{{ $exp->start_date?->format('M Y') ?: 'N/A' }} — {{ $exp->is_current ? 'Present' : ($exp->end_date?->format('M Y') ?: '') }}</div>
                        <h4 class="text-xl font-heading font-light text-text-primary mb-1">{{ $exp->title }}</h4>
                        <div class="text-sm text-text-secondary/60 font-accent mb-3">{{ $exp->company }}</div>
                        <p class="text-sm text-text-secondary font-light leading-relaxed">{{ $exp->description }}</p>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full border border-white/[0.06] flex items-center justify-center text-text-secondary/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-text-secondary/50 text-sm font-light">No experience entries yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Education -->
            <div>
                <div class="flex items-center gap-4 mb-10 scroll-reveal">
                    <div class="w-10 h-10 rounded-lg bg-gold-base/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gold-base" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-light text-gradient-gold italic">Education</h3>
                </div>

                <div class="space-y-0 relative ml-5 border-l border-gold-base/10">
                    @forelse($educations as $edu)
                    <div class="relative pl-8 pb-10 last:pb-0 scroll-reveal group">
                        <div class="absolute -left-[5px] top-1 w-[10px] h-[10px] rounded-full border-2 border-gold-base bg-brand-primary group-hover:bg-gold-base transition-colors duration-300"></div>

                        <div class="text-[10px] font-accent uppercase tracking-[0.2em] text-gold-base/60 mb-2">{{ $edu->start_year }} — {{ $edu->end_year ?? 'Present' }}</div>
                        <h4 class="text-xl font-heading font-light text-text-primary mb-1">{{ $edu->degree }}</h4>
                        <div class="text-sm text-text-secondary/60 font-accent mb-3">{{ $edu->institution }} · {{ $edu->field_of_study }}</div>
                        <p class="text-sm text-text-secondary font-light leading-relaxed">{{ $edu->description }}</p>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full border border-white/[0.06] flex items-center justify-center text-text-secondary/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                        <p class="text-text-secondary/50 text-sm font-light">No education entries yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ -->
<!-- Testimonials Section -->
<section id="testimonials" class="py-28 overflow-hidden relative">
    <div class="container mx-auto px-6 relative z-10">
        <x-section-heading title="What People Say" subtitle="Kind words from clients and collaborators." />
        
        <div class="relative max-w-4xl mx-auto scroll-reveal">
            @if($testimonials->isNotEmpty())
            <div class="testimonial-carousel flex transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]">
                @foreach($testimonials as $test)
                <div class="w-full flex-shrink-0 px-4">
                    <div class="glass-gold p-10 md:p-14 rounded-3xl text-center relative overflow-hidden">
                        <!-- Large quote mark -->
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 text-8xl text-gold-base/[0.06] font-heading leading-none select-none">"</div>
                        
                        <p class="text-lg md:text-2xl font-heading italic leading-relaxed mb-10 relative z-10 font-light text-text-primary/90">
                            {!! nl2br(e($test->content)) !!}
                        </p>
                        
                        <div class="flex flex-col items-center justify-center gap-4">
                            @if($test->avatar)
                                <img src="{{ Storage::url($test->avatar) }}" alt="{{ $test->name }}" class="w-14 h-14 rounded-full object-cover border border-gold-base/30">
                            @else
                                <div class="w-14 h-14 rounded-full bg-gold-base/10 border border-gold-base/30 flex items-center justify-center text-xl font-heading text-gold-base">
                                    {{ substr($test->name, 0, 1) }}
                                </div>
                            @endif
                            
                            <div>
                                <h4 class="font-accent font-semibold text-sm uppercase tracking-[0.1em] text-gold-base">{{ $test->name }}</h4>
                                <div class="text-xs text-text-secondary/60 mt-1">{{ $test->role }} @if($test->company) · {{ $test->company }} @endif</div>
                            </div>
                            
                            <div class="text-gold-base/60 text-xs flex gap-0.5">
                                @for($i=0; $i<$test->rating; $i++) <span>★</span> @endfor
                                @for($i=$test->rating; $i<5; $i++) <span class="opacity-20">★</span> @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Dots -->
            <div class="flex justify-center gap-2 mt-10 carousel-dots">
                @foreach($testimonials as $idx => $test)
                <button class="h-1.5 rounded-full transition-all duration-500 {{ $idx == 0 ? 'bg-gold-base w-8' : 'bg-white/10 w-3 hover:bg-white/30' }}" data-index="{{ $idx }}"></button>
                @endforeach
            </div>
            @else
            <div class="text-center py-20">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full border border-white/[0.06] flex items-center justify-center text-text-secondary/30">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <p class="text-text-secondary/50 text-sm font-light">No testimonials yet.</p>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════ -->
<!-- Contact Section -->
<section id="contact" class="py-28 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(201,168,76,0.04)_0%,_transparent_60%)]"></div>

    <div class="container mx-auto px-6 relative z-10">
        <x-section-heading title="Get In Touch" subtitle="Have a project in mind? Let's build something exceptional together." />
        
        <div class="max-w-2xl mx-auto glass-gold p-10 md:p-12 rounded-2xl scroll-reveal relative overflow-hidden">
            <!-- Corner accents -->
            <div class="absolute top-0 left-0 w-20 h-20 border-t border-l border-gold-base/15"></div>
            <div class="absolute bottom-0 right-0 w-20 h-20 border-b border-r border-gold-base/15"></div>
            
            <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="group">
                        <label class="block text-[10px] font-accent uppercase tracking-[0.2em] text-text-secondary/60 mb-3">Name</label>
                        <input type="text" name="name" required placeholder="Your name" class="w-full bg-white/[0.03] border border-white/[0.06] rounded-none px-5 py-3.5 focus:outline-none focus:border-gold-base/40 transition-all duration-500 text-text-primary font-light placeholder:text-text-secondary/30">
                    </div>
                    <div class="group">
                        <label class="block text-[10px] font-accent uppercase tracking-[0.2em] text-text-secondary/60 mb-3">Email</label>
                        <input type="email" name="email" required placeholder="hello@email.com" class="w-full bg-white/[0.03] border border-white/[0.06] rounded-none px-5 py-3.5 focus:outline-none focus:border-gold-base/40 transition-all duration-500 text-text-primary font-light placeholder:text-text-secondary/30">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-[10px] font-accent uppercase tracking-[0.2em] text-text-secondary/60 mb-3">Subject</label>
                    <input type="text" name="subject" required placeholder="Project inquiry" class="w-full bg-white/[0.03] border border-white/[0.06] rounded-none px-5 py-3.5 focus:outline-none focus:border-gold-base/40 transition-all duration-500 text-text-primary font-light placeholder:text-text-secondary/30">
                </div>
                <div class="mb-8">
                    <label class="block text-[10px] font-accent uppercase tracking-[0.2em] text-text-secondary/60 mb-3">Message</label>
                    <textarea name="message" rows="5" required placeholder="Tell me about your project..." class="w-full bg-white/[0.03] border border-white/[0.06] rounded-none px-5 py-3.5 focus:outline-none focus:border-gold-base/40 transition-all duration-500 text-text-primary font-light resize-none placeholder:text-text-secondary/30"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" id="submitBtn" class="magnetic-btn relative inline-flex items-center gap-3 px-12 py-4 font-accent text-sm uppercase tracking-[0.15em] bg-gradient-gold-animated text-brand-primary font-semibold overflow-hidden group transition-all duration-500 hover:shadow-[0_0_40px_rgba(201,168,76,0.25)] w-full md:w-auto justify-center">
                        <span class="relative z-10">Send Message</span>
                        <svg class="w-4 h-4 relative z-10 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                submitBtn.disabled = true;
                submitBtn.querySelector('span').textContent = 'Sending...';
                
                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    const result = await response.json();
                    
                    window.showToast(result.message || 'Message sent successfully!', 'success');
                    form.reset();
                } catch (error) {
                    window.showToast('An error occurred. Please try again later.', 'error');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.querySelector('span').textContent = 'Send Message';
                }
            });
        }
    });
</script>
@endsection
