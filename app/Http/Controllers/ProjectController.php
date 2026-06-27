<?php
namespace App\Http\Controllers;
use App\Models\Project;

class ProjectController extends Controller {
    public function index() {
        $query = Project::where('status', 'published');

        if ($category = request('category')) {
            $query->where('category', $category);
        }

        $projects = $query->orderBy('sort_order')->paginate(12);
        $categories = Project::select('category')->distinct()->where('status', 'published')->pluck('category');

        return view('projects.index', compact('projects', 'categories'));
    }
    public function show($slug) {
        $project = Project::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('projects.show', compact('project'));
    }
}
