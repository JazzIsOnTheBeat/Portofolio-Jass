<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model {
    use HasFactory;
    protected $fillable = ['platform', 'url', 'icon', 'sort_order'];
    protected function casts(): array {
        return [
            'sort_order' => 'integer',
        ];
    }
}