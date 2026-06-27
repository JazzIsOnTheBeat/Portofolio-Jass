<footer class="relative mt-24 pt-16 pb-10 border-t border-white/[0.04]">
    <!-- Background glow -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_center,_rgba(201,168,76,0.03)_0%,_transparent_60%)]"></div>
    
    <!-- Back to top -->
    <button id="back-to-top" aria-label="Back to top" class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-brand-secondary border border-gold-base/20 text-gold-base flex items-center justify-center hover:bg-gold-base hover:text-brand-primary transition-all duration-500 opacity-0 translate-y-4 group">
        <svg class="w-4 h-4 transform group-hover:-translate-y-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-3 gap-12 mb-12">
            <!-- Brand -->
            <div>
                <a href="/" class="inline-block mb-4">
                    <span class="text-3xl font-heading font-light tracking-wider text-gradient-gold">Jass</span><span class="text-gold-base text-3xl font-heading">.</span>
                </a>
                <p class="text-text-secondary/50 text-sm font-light leading-relaxed max-w-xs">Crafting exceptional digital experiences with precision and passion.</p>
            </div>
            
            <!-- Navigation -->
            <div>
                <h4 class="text-[10px] font-accent uppercase tracking-[0.3em] text-text-secondary/40 mb-6">Navigation</h4>
                <div class="flex flex-col gap-3">
                    <a href="/#about" class="text-text-secondary/60 hover:text-gold-base transition-colors duration-300 text-sm font-light">About</a>
                    <a href="/#skills" class="text-text-secondary/60 hover:text-gold-base transition-colors duration-300 text-sm font-light">Skills</a>
                    <a href="/#projects" class="text-text-secondary/60 hover:text-gold-base transition-colors duration-300 text-sm font-light">Projects</a>
                    <a href="/#contact" class="text-text-secondary/60 hover:text-gold-base transition-colors duration-300 text-sm font-light">Contact</a>
                </div>
            </div>
            
            <!-- Social -->
            <div>
                <h4 class="text-[10px] font-accent uppercase tracking-[0.3em] text-text-secondary/40 mb-6">Connect</h4>
                <div class="flex gap-4">
                    @foreach(\App\Models\SocialLink::orderBy('sort_order')->get() as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link->platform }}" class="w-10 h-10 border border-white/[0.06] flex items-center justify-center text-text-secondary/40 hover:border-gold-base/40 hover:text-gold-base hover:-translate-y-1 transition-all duration-500">
                            {!! safe_icon($link->icon) !!}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="flex items-center gap-4 mb-8">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent to-white/[0.04]"></div>
            <div class="w-1 h-1 rounded-full bg-gold-base/30"></div>
            <div class="flex-1 h-px bg-gradient-to-l from-transparent to-white/[0.04]"></div>
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-text-secondary/30 text-xs font-light">
            <p>&copy; {{ date('Y') }} Jass. All rights reserved.</p>
            <p class="font-accent text-[10px] uppercase tracking-[0.2em]">Crafted with precision</p>
        </div>
    </div>
</footer>
