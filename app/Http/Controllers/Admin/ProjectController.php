<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->makeUniqueSlug($data['title']);
        
        if ($path = $this->uploadFile($request, 'thumbnail', 'projects')) {
            $data['thumbnail'] = $path;
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validateData($request);
        $slug = Str::slug($data['title']);
        if ($slug !== $project->slug) {
            $data['slug'] = $this->makeUniqueSlug($data['title']);
        } else {
            $data['slug'] = $project->slug;
        }

        if ($path = $this->uploadFile($request, 'thumbnail', 'projects')) {
            $this->deleteFile($project->thumbnail);
            $data['thumbnail'] = $path;
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->deleteFile($project->thumbnail);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    private function makeUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->when($id, fn($q) => $q->where('id', '!=', $id))->exists()) {
            $slug = $original . '-' . $counter++;
        }
        return $slug;
    }

    private function validateData(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'live_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
        ]);
        
        if ($request->tech_stack) {
            $data['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));
        } else {
            $data['tech_stack'] = [];
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = $request->status ?? 'published';
        
        return $data;
    }
}