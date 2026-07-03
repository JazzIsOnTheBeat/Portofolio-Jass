<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'resume_file', 'about_image']);
        
        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($path = $this->uploadFile($request, 'resume_file', 'resume')) {
            $old = SiteSetting::where('key', 'resume_path')->value('value');
            if ($old) $this->deleteFile($old);
            SiteSetting::updateOrCreate(['key' => 'resume_path'], ['value' => $path]);
        }

        if ($path = $this->uploadFile($request, 'about_image', 'images')) {
            $old = SiteSetting::where('key', 'about_image_path')->value('value');
            if ($old) $this->deleteFile($old);
            SiteSetting::updateOrCreate(['key' => 'about_image_path'], ['value' => $path]);
        }

        SettingService::flush();

        return back()->with('success', 'Settings updated successfully.');
    }
}