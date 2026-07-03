<?php
namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        $projects = Project::where('status', 'published')->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('status', 'published')->orderBy('sort_order')->get();
        $skills = Skill::with('category')->orderBy('category_id')->orderBy('sort_order')->get()->groupBy(fn($s) => $s->category?->name ?? 'Other');
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $educations = Education::orderBy('start_year', 'desc')->get();

        $projectCount = Project::where('status', 'published')->count();
        $clientCount = Testimonial::where('status', 'published')->count();

        $firstExp = $experiences->last();
        $yearsExp = $firstExp?->start_date ? max(1, now()->diffInYears($firstExp->start_date)) : 0;

        return view('home.index', compact('projects', 'testimonials', 'skills', 'experiences', 'educations', 'projectCount', 'clientCount', 'yearsExp'));
    }
}
