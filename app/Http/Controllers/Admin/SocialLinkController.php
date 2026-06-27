<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    public function store(Request $request)
    {
        SocialLink::create($request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:2048',
            'icon' => 'required|string|max:255',
            'sort_order' => 'nullable|integer'
        ]));
        return back()->with('success', 'Link added.');
    }

    public function update(Request $request, SocialLink $social_link)
    {
        $social_link->update($request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:2048',
            'icon' => 'required|string|max:255',
            'sort_order' => 'nullable|integer'
        ]));
        return back()->with('success', 'Link updated.');
    }

    public function destroy(SocialLink $social_link)
    {
        $social_link->delete();
        return back()->with('success', 'Link deleted.');
    }
}