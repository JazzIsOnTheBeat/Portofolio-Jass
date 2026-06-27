<?php
namespace App\Http\Controllers;
use App\Models\ResumeDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller {
    public function download(Request $request) {
        $resumePath = \App\Services\SettingService::get('resume_path');
        
        if (!$resumePath || !Storage::disk('public')->exists($resumePath)) {
            return redirect()->back()->with('error', 'Resume not available yet.');
        }

        ResumeDownload::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return Storage::disk('public')->download($resumePath, 'Jass_Resume.pdf');
    }
}
