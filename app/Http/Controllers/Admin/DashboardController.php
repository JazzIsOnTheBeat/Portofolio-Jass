<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Contact;
use App\Services\AnalyticsService;

class DashboardController extends Controller
{
    public function index(AnalyticsService $analytics)
    {
        $stats = $analytics->getDashboardStats();
        $chartData = collect($analytics->getViewsPerDay(7))->toJson();
        
        $projectsCount = Project::count();
        $unreadMessages = Contact::where('is_read', false)->count();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'chartData', 'projectsCount', 'unreadMessages', 'recentContacts'));
    }
}
