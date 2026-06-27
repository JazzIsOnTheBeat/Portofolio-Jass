@props(['title', 'subtitle' => ''])
<div class="text-center mb-20 scroll-reveal">
    <!-- Decorative Line -->
    <div class="flex items-center justify-center gap-4 mb-6">
        <div class="w-12 h-px bg-gradient-to-r from-transparent to-gold-base/40"></div>
        <div class="w-1.5 h-1.5 rounded-full bg-gold-base/60"></div>
        <div class="w-12 h-px bg-gradient-to-l from-transparent to-gold-base/40"></div>
    </div>
    
    <h2 class="text-4xl md:text-6xl font-heading font-light text-gradient-gold mb-5 tracking-wide">{{ $title }}</h2>
    
    @if($subtitle)
        <p class="text-text-secondary font-body text-lg max-w-xl mx-auto font-light leading-relaxed">{{ $subtitle }}</p>
    @endif
</div>