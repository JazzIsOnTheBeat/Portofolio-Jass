<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use App\Models\PageView;

class AnalyticsController extends Controller
{
    public function index(AnalyticsService $analytics)
    {
        $stats = $analytics->getDashboardStats();
        $chartData = collect($analytics->getViewsPerDay(30))->toJson();
        $topPages = $analytics->getTopPages();
        $recentVisitors = PageView::latest()->paginate(20);

        return view('admin.analytics.index', compact('stats', 'chartData', 'topPages', 'recentVisitors'));
    }
}
