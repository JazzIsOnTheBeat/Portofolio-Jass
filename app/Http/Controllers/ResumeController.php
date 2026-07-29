<?php
namespace App\Http\Controllers;
use App\Models\ResumeDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller {
    public function download(Request $request) {
        $resumePath = public_path('myResume/jasswant-anbumani.pdf');
        
        if (!file_exists($resumePath)) {
            return redirect()->back()->with('error', 'Resume not available yet.');
        }

        ResumeDownload::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return response()->download($resumePath, 'jasswant-anbumani.pdf');
    }
}
