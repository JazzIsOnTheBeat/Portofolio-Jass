<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.form', ['experience' => new Experience()]);
    }

    public function store(Request $request)
    {
        Experience::create($this->validateData($request));
        return redirect()->route('admin.experiences.index')->with('success', 'Experience created.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $experience->update($this->validateData($request));
        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted.');
    }

    private function validateData(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ]);
        $data['is_current'] = $request->has('is_current');
        return $data;
    }
}