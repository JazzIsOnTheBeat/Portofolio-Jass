<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO -->
    <title>{{ App\Services\SettingService::get('site_title', 'Jass — Portfolio') }}</title>
    <meta name="description" content="{{ App\Services\SettingService::get('site_description', 'AI & Web Developer Portfolio') }}">
    <meta property="og:title" content="{{ App\Services\SettingService::get('site_title', 'Jass — Portfolio') }}">
    <meta property="og:description" content="{{ App\Services\SettingService::get('site_description', 'AI & Web Developer Portfolio') }}">
    <meta property="og:type" content="website">
    
    <!-- Fonts (subset: only weights used) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,700;1,300&family=Outfit:wght@300;400;500&family=Syne:wght@400;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-primary text-text-primary overflow-x-hidden relative">
    <!-- Loading Screen -->
    <div id="loader" class="fixed inset-0 z-[9999] bg-brand-primary flex flex-col items-center justify-center transition-all duration-700">
        <div class="relative flex items-center justify-center mb-6">
            <!-- Outer ring -->
            <div class="w-20 h-20 rounded-full border border-gold-base/10 absolute animate-ping" style="animation-duration: 2s;"></div>
            <!-- Middle ring -->
            <div class="w-16 h-16 rounded-full border border-gold-base/20 absolute"></div>
            <!-- Spinning arc -->
            <svg class="w-16 h-16 absolute animate-spin" style="animation-duration: 1.5s;" viewBox="0 0 64 64">
                <circle cx="32" cy="32" r="30" fill="none" stroke="url(#loaderGrad)" stroke-width="1.5" stroke-dasharray="40 150" stroke-linecap="round"/>
                <defs>
                    <linearGradient id="loaderGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#C9A84C"/>
                        <stop offset="100%" stop-color="transparent"/>
                    </linearGradient>
                </defs>
            </svg>
            <!-- Center letter -->
            <span class="font-heading text-2xl font-light text-gradient-gold tracking-wider relative z-10">J</span>
        </div>
        <div class="text-gold-base/60 text-[10px] font-accent uppercase tracking-[0.4em] animate-pulse">Loading</div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3"></div>

    <x-navbar />
    
    <main>
        @yield('content')
    </main>

    <x-footer />

    @stack('scripts')
    
    @if(session('success') || session('error') || (isset($errors) && $errors->any()))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                @if(session('success'))
                    if (typeof window.showToast === 'function') window.showToast("{{ session('success') }}", 'success');
                @endif
                @if(session('error'))
                    if (typeof window.showToast === 'function') window.showToast("{{ session('error') }}", 'error');
                @endif
                @if(isset($errors) && $errors->any())
                    if (typeof window.showToast === 'function') window.showToast("{{ $errors->first() }}", 'error');
                @endif
            }, 800);
        });
    </script>
    @endif
</body>
</html>
