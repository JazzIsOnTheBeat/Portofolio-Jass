<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('company')->nullable();
            $table->string('avatar')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('status')->default('published');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('testimonials');
    }
};

// In a separate migration for SQLite compatibility:
// The `role` column is made nullable and `status` changed from enum to string
