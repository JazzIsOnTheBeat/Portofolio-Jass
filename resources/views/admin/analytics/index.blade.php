@extends('layouts.admin')
@section('title', 'Analytics')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-heading font-bold text-text-primary">Analytics</h1>
    <p class="text-text-secondary text-sm mt-0.5 font-light">Traffic and visitor insights</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">
    <div class="lg:col-span-2 admin-card p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold">Traffic</h2>
                <p class="text-[10px] text-text-secondary/50 font-accent uppercase tracking-wider mt-0.5">Last 30 days</p>
            </div>
            <span class="w-8 h-8 rounded bg-gold-base/10 flex items-center justify-center text-gold-base text-xs"><i class="fa-solid fa-chart-bar"></i></span>
        </div>
        <div class="relative min-h-[20rem]">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold">Top Pages</h2>
                <p class="text-[10px] text-text-secondary/50 font-accent uppercase tracking-wider mt-0.5">Most visited</p>
            </div>
            <span class="w-8 h-8 rounded bg-gold-base/10 flex items-center justify-center text-gold-base text-xs"><i class="fa-solid fa-ranking-star"></i></span>
        </div>
        <div class="space-y-3">
            @foreach($topPages as $page)
            <div class="flex justify-between items-center pb-2 border-b border-white/[0.05] last:border-0 last:pb-0">
                <span class="text-sm text-text-secondary font-light truncate mr-4" title="{{ $page->page }}">
                    {{ Str::limit(str_replace(config('app.url'), '', $page->page ?? ''), 30) ?: '/' }}
                </span>
                <span class="text-gold-base font-medium text-sm">{{ number_format($page->count) }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="admin-card overflow-hidden">
    <div class="p-5 border-b border-white/[0.05]">
        <h2 class="text-sm font-accent uppercase tracking-[0.15em] text-text-primary font-semibold">Visitor Log</h2>
        <p class="text-[10px] text-text-secondary/50 font-accent uppercase tracking-wider mt-0.5">Recent activity</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left admin-table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>IP Address</th>
                    <th>Page</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentVisitors as $visit)
                <tr>
                    <td class="whitespace-nowrap text-sm text-text-primary">{{ $visit->created_at->format('M d, H:i:s') }}</td>
                    <td class="font-mono text-xs text-text-secondary">{{ $visit->ip_address }}</td>
                    <td class="text-xs text-text-secondary truncate max-w-[200px] font-light">{{ str_replace(config('app.url'), '', $visit->page ?? '') ?: '/' }}</td>
                    <td class="text-xs text-text-secondary/50 truncate max-w-[300px] font-light" title="{{ $visit->user_agent }}">{{ Str::limit($visit->user_agent, 40) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(method_exists($recentVisitors, 'links'))
    <div class="p-4 border-t border-white/[0.05]">
        {{ $recentVisitors->links('vendor.pagination.admin') }}
    </div>
    @endif
</div>

@push('scripts')
<script type="module">
    import Chart from 'chart.js/auto';

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('monthlyChart');
        if (ctx) {
            const rawData = {!! $chartData !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: rawData.labels,
                    datasets: [{
                        label: 'Page Views',
                        data: rawData.data,
                        backgroundColor: 'rgba(201, 168, 76, 0.5)',
                        hoverBackgroundColor: '#C9A84C',
                        borderRadius: 0,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255, 255, 255, 0.04)' }, ticks: { color: '#8A8A9A', font: { size: 11 } } },
                        x: { grid: { display: false }, ticks: { color: '#8A8A9A', font: { size: 11 } } }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection