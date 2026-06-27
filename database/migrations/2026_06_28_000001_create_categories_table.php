<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Frontend', 'slug' => 'frontend', 'sort_order' => 0],
            ['name' => 'Backend', 'slug' => 'backend', 'sort_order' => 1],
            ['name' => 'AI / ML', 'slug' => 'ai-ml', 'sort_order' => 2],
            ['name' => 'Tools', 'slug' => 'tools', 'sort_order' => 3],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
