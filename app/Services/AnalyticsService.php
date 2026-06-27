<?php
namespace App\Services;

use App\Models\PageView;
use App\Models\ResumeDownload;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    public function getDashboardStats()
    {
        return [
            'total_views' => PageView::count(),
            'today_views' => PageView::whereDate('created_at', Carbon::today())->count(),
            'total_downloads' => ResumeDownload::count(),
            'recent_views' => PageView::latest()->take(5)->get(),
        ];
    }

    public function getViewsPerDay($days = 30)
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        
        $views = PageView::where('created_at', '>=', $startDate)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $result = [
            'labels' => [],
            'data' => []
        ];

        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($days - 1 - $i)->format('Y-m-d');
            $result['labels'][] = Carbon::parse($date)->format('M d');
            $result['data'][] = $views->get($date, 0);
        }

        return $result;
    }

    public function getTopPages($limit = 10)
    {
        return PageView::select('page', DB::raw('count(*) as count'))
            ->groupBy('page')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get();
    }
}
