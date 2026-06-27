<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model {
    use HasFactory;
    protected $fillable = ['name', 'icon', 'category_id', 'proficiency', 'sort_order'];
    protected function casts(): array {
        return [
            'proficiency' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}