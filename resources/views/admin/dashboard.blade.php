@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-heading font-bold text-text-primary">Dashboard</h1>
        <p class="text-text-secondary text-sm mt-0.5 font-light">Overview of your portfolio</p>
    </div>
    <a href="{{ route('home') }}" target="_blank"
       class="btn-admin-secondary text-xs">
        <i class="fa-solid fa-eye"></i>
        View Site
        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="admin-label !mb-0">Projects</span>
            <span class="w-9 h-9 rounded bg-gold-base/10 flex items-center justify-center text-gold-base text-sm">
                <i class="fa-solid fa-diagram-project"></i>
            </span>
        </div>
        <p class="text-3xl font-heading font-bold text-gold-base">{{ $projectsCount }}</p>
    </div>
    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="admin-label !mb-0">Messages</span>
            <span class="w-9 h-9 rounded bg-blue-500/10 flex items-center justify-center text-blue-400 text-sm">
                <i class="fa-solid fa-envelope"></i>
            </span>
        </div>
        <p class="text-3xl font-heading font-bold text-blue-400">{{ $unreadMessages }}</p>
        <p class="text-[10px] text-text-secondary/50 font-accent uppercase tracking-wider mt-0.5">unread</p>
    </div>
    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="admin-label !mb-0">Today's Views</span>
            <span class="w-9 h-9 rounded bg-green-500/10 flex items-center justify-center text-green-400 text-sm">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>
        <p class="text-3xl font-heading font-bold text-green-400">{{ $stats['today_views'] }}</p>
    </div>
    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="admin-label !mb-0">CV Downloads</span>
            <span class="w-9 h-9 rounded bg-purple-500/10 flex items-center justify-center text-purple-400 text-sm">
                <i class="fa-solid fa-download"></i>
            </span>
        </div>
        <p class="text-3xl font-heading font-bold text-purple-400">{{ $stats['total_downloads'] }}</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-5">
    <div class="lg:col-span-2 admin-card p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold">Traffic</h2>
                <p class="text-[10px] text-text-secondary/50 font-accent uppercase tracking-wider mt-0.5">Last 7 days</p>
            </div>
            <span class="w-8 h-8 rounded bg-gold-base/10 flex items-center justify-center text-gold-base text-xs"><i class="fa-solid fa-chart-line"></i></span>
        </div>
        <div class="relative min-h-[18rem]">
            <canvas id="trafficChart"></canvas>
        </div>
    </div>

    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold">Messages</h2>
                <p class="text-[10px] text-text-secondary/50 font-accent uppercase tracking-wider mt-0.5">Recent</p>
            </div>
            <span class="w-8 h-8 rounded bg-gold-base/10 flex items-center justify-center text-gold-base text-xs"><i class="fa-solid fa-inbox"></i></span>
        </div>
        <div class="space-y-2">
            @forelse($recentContacts as $msg)
                <a href="{{ route('admin.contacts.show', $msg->id) }}"
                   class="block p-3 rounded hover:bg-white/[0.02] transition-all duration-200 {{ !$msg->is_read ? 'border-l-2 border-l-gold-base' : '' }}">
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-medium {{ !$msg->is_read ? 'text-text-primary' : 'text-text-secondary' }}">{{ $msg->name }}</span>
                        <span class="text-[10px] text-text-secondary/40 font-accent uppercase tracking-wider whitespace-nowrap ml-2">{{ $msg->created_at->diffForHumans(null, true, true) }}</span>
                    </div>
                    <p class="text-xs text-text-secondary/60 truncate mt-0.5 font-light">{{ $msg->subject }}</p>
                </a>
            @empty
                <div class="text-center py-8">
                    <p class="text-text-secondary/50 text-sm font-light">No messages yet.</p>
                </div>
            @endforelse
        </div>
        @if(count($recentContacts) > 0)
        <div class="mt-4 pt-4 border-t border-white/[0.05] text-center">
            <a href="{{ route('admin.contacts.index') }}" class="text-[10px] font-accent uppercase tracking-[0.15em] text-gold-base hover:text-gold-light transition">View all →</a>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script type="module">
    import Chart from 'chart.js/auto';

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trafficChart');
        if (ctx) {
            const rawData = {!! $chartData !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: rawData.labels,
                    datasets: [{
                        label: 'Page Views',
                        data: rawData.data,
                        borderColor: '#C9A84C',
                        backgroundColor: 'rgba(201, 168, 76, 0.08)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#C9A84C',
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255, 255, 255, 0.04)' }, ticks: { color: '#8A8A9A', font: { size: 11 } } },
                        x: { grid: { display: false }, ticks: { color: '#8A8A9A', font: { size: 11 } } }
                    },
                    interaction: { intersect: false, mode: 'index' }
                }
            });
        }
    });
</script>
@endpush
@endsection