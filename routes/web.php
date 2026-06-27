<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResumeController;
use App\Http\Middleware\TrackPageView;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\AnalyticsController;

Route::middleware([TrackPageView::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/resume/download', [ResumeController::class, 'download'])->name('resume.download');
});

use App\Http\Controllers\Admin\AuthController;

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('projects', AdminProjectController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('educations', EducationController::class);
    
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::patch('contacts/{id}/read', [AdminContactController::class, 'markRead'])->name('contacts.read');
    Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    
    Route::resource('social-links', SocialLinkController::class)->except(['create', 'edit', 'show']);
    
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
});
