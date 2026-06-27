<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PageView;

class TrackPageView {
    public function handle(Request $request, Closure $next): Response {
        if (!$request->is('admin*') && $request->method() === 'GET' && !$request->ajax() && !$request->expectsJson()) {
            $page = $request->path() ?: '/';
            PageView::create([
                'page' => $page,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer' => $request->headers->get('referer'),
            ]);
        }
        return $next($request);
    }
}