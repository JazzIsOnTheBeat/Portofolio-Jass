<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->index('status');
            $table->index('is_featured');
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->index('status');
            $table->index('is_featured');
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->index('is_read');
        });
        Schema::table('page_views', function (Blueprint $table) {
            $table->index('page');
            $table->index('created_at');
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->index('category');
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->index('start_date');
        });
        Schema::table('education', function (Blueprint $table) {
            $table->index('start_year');
        });
    }
    public function down(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['is_featured']);
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['is_featured']);
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropIndex(['is_read']);
        });
        Schema::table('page_views', function (Blueprint $table) {
            $table->dropIndex(['page']);
            $table->dropIndex(['created_at']);
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->dropIndex(['category']);
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropIndex(['start_date']);
        });
        Schema::table('education', function (Blueprint $table) {
            $table->dropIndex(['start_year']);
        });
    }
};