<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'long_description', 'thumbnail', 'images', 'tech_stack', 'live_url', 'github_url', 'category', 'is_featured', 'sort_order', 'status'];
    protected function casts(): array {
        return [
            'images' => 'array',
            'tech_stack' => 'array',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}