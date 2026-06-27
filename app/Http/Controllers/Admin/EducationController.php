<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('start_year', 'desc')->get();
        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.form', ['education' => new Education()]);
    }

    public function store(Request $request)
    {
        Education::create($this->validateData($request));
        return redirect()->route('admin.educations.index')->with('success', 'Education created.');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.form', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $education->update($this->validateData($request));
        return redirect()->route('admin.educations.index')->with('success', 'Education updated.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.educations.index')->with('success', 'Education deleted.');
    }

    private function validateData(Request $request)
    {
        $data = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_year' => 'required|digits:4|integer|min:1900|max:2099',
            'end_year' => 'nullable|digits:4|integer|gte:start_year',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);
        $data['start_year'] = (int) $data['start_year'];
        if (isset($data['end_year'])) {
            $data['end_year'] = (int) $data['end_year'];
        }
        return $data;
    }
}