<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $data = $request->except(['_token', 'resume_file', 'about_image']);
        
        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        // Handle Resume Upload — delete old file first
        if ($path = $this->uploadFile($request, 'resume_file', 'resume')) {
            $old = SiteSetting::where('key', 'resume_path')->value('value');
            if ($old) $this->deleteFile($old);
            SiteSetting::updateOrCreate(['key' => 'resume_path'], ['value' => $path]);
            Cache::forget('setting_resume_path');
        }

        // Handle About Image — delete old file first
        if ($path = $this->uploadFile($request, 'about_image', 'images')) {
            $old = SiteSetting::where('key', 'about_image_path')->value('value');
            if ($old) $this->deleteFile($old);
            SiteSetting::updateOrCreate(['key' => 'about_image_path'], ['value' => $path]);
            Cache::forget('setting_about_image_path');
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}