<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Jass</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,700;1,300&family=Outfit:wght@300;400;500&family=Syne:wght@400;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-brand-primary text-text-primary font-body antialiased overflow-hidden">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#0C0C10] flex-shrink-0 border-r border-white/[0.06] flex flex-col">
            <div class="p-5 border-b border-white/[0.06]">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-gradient-gold flex items-center justify-center text-brand-primary font-heading font-bold text-base">J</div>
                    <div>
                        <h2 class="text-lg font-heading text-gradient-gold font-bold leading-tight">Jass</h2>
                        <span class="text-[9px] font-accent text-text-secondary uppercase tracking-[0.15em]">Admin Panel</span>
                    </div>
                </a>
            </div>
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5 min-h-0">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge-high'],
                        ['route' => 'admin.projects.*', 'label' => 'Projects', 'icon' => 'fa-solid fa-diagram-project'],
                        ['route' => 'admin.testimonials.*', 'label' => 'Testimonials', 'icon' => 'fa-solid fa-comment'],
                        ['route' => 'admin.skills.*', 'label' => 'Skills', 'icon' => 'fa-solid fa-code'],
                        ['route' => 'admin.categories.*', 'label' => 'Categories', 'icon' => 'fa-solid fa-tags'],
                        ['route' => 'admin.experiences.*', 'label' => 'Experience', 'icon' => 'fa-solid fa-briefcase'],
                        ['route' => 'admin.educations.*', 'label' => 'Education', 'icon' => 'fa-solid fa-graduation-cap'],
                        ['route' => 'admin.contacts.*', 'label' => 'Inbox', 'icon' => 'fa-solid fa-envelope'],
                        ['route' => 'admin.settings.index', 'label' => 'Settings', 'icon' => 'fa-solid fa-gear'],
                        ['route' => 'admin.social-links.*', 'label' => 'Social Links', 'icon' => 'fa-solid fa-share-nodes'],
                        ['route' => 'admin.analytics.index', 'label' => 'Analytics', 'icon' => 'fa-solid fa-chart-bar'],
                    ];

                    function navRoute($route) {
                        return str_contains($route, '*')
                            ? str_replace('.*', '.index', $route)
                            : $route;
                    }
                @endphp
                @foreach($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['route']);
                    @endphp
                    <a href="{{ route(navRoute($item['route'])) }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-lg text-sm transition-all duration-200
                              {{ $isActive ? 'bg-gold-base/10 text-gold-base font-medium' : 'text-text-secondary hover:bg-white/[0.04] hover:text-text-primary' }}">
                        <i class="{{ $item['icon'] }} w-4 text-center text-xs {{ $isActive ? 'text-gold-base' : '' }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="p-3 border-t border-white/[0.06]">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-3.5 py-2 rounded-lg text-sm text-text-secondary hover:bg-red-500/10 hover:text-red-400 transition-all duration-200">
                        <i class="fa-solid fa-right-from-bracket w-4 text-center text-xs"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-brand-primary min-h-0 relative">
            <div class="admin-glow"></div>
            <div class="p-6 lg:p-8 max-w-7xl relative z-[1]">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>