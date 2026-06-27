@props(['href' => '#', 'type' => 'link'])

@if($type === 'button')
<button {{ $attributes->merge(['class' => 'magnetic-btn relative inline-flex items-center gap-3 px-10 py-4 font-accent text-sm uppercase tracking-[0.15em] bg-gradient-gold-animated text-brand-primary font-semibold rounded-none overflow-hidden group transition-all duration-500 hover:shadow-[0_0_30px_rgba(201,168,76,0.3)]']) }}>
    <span class="relative z-10">{{ $slot }}</span>
    <svg class="w-4 h-4 relative z-10 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    <div class="absolute inset-0 bg-gradient-to-r from-gold-light via-gold-base to-gold-dark opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
</button>
@else
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'magnetic-btn relative inline-flex items-center gap-3 px-10 py-4 font-accent text-sm uppercase tracking-[0.15em] bg-gradient-gold-animated text-brand-primary font-semibold rounded-none overflow-hidden group transition-all duration-500 hover:shadow-[0_0_30px_rgba(201,168,76,0.3)]']) }}>
    <span class="relative z-10">{{ $slot }}</span>
    <svg class="w-4 h-4 relative z-10 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    <div class="absolute inset-0 bg-gradient-to-r from-gold-light via-gold-base to-gold-dark opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
</a>
@endif