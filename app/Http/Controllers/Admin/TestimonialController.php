<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($path = $this->uploadFile($request, 'avatar', 'avatars')) {
            $data['avatar'] = $path;
        }
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validateData($request);
        if ($path = $this->uploadFile($request, 'avatar', 'avatars')) {
            $this->deleteFile($testimonial->avatar);
            $data['avatar'] = $path;
        }
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteFile($testimonial->avatar);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }

    private function validateData(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'integer|min:1|max:5',
            'avatar' => 'nullable|image|max:2048',
            'sort_order' => 'integer',
        ]);
        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = $request->status ?? 'published';
        return $data;
    }
}
