<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('category')->orderBy('category_id')->orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.skills.form', ['skill' => new Skill(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        Skill::create($this->validateData($request));
        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill)
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.skills.form', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validateData($request));
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'proficiency' => 'required|integer|min:0|max:100',
            'sort_order' => 'nullable|integer',
        ]);
    }
}