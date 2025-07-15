<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'image_path',
        'meta_data',
        'type',
        'section',
        'order',
        'is_active'
    ];

    protected $casts = [
        'meta_data' => 'array',
        'is_active' => 'boolean'
    ];

    // Scope untuk mendapatkan konten aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mendapatkan konten berdasarkan section
    public function scopeBySection($query, $section)
    {
        return $query->where('section', $section);
    }

    // Helper method untuk mendapatkan konten berdasarkan key
    public static function getByKey($key, $default = null)
    {
        $content = static::where('key', $key)->where('is_active', true)->first();
        return $content ? $content->content : $default;
    }

    // Helper method untuk mendapatkan konten dengan metadata
    public static function getContentWithMeta($key)
    {
        return static::where('key', $key)->where('is_active', true)->first();
    }
}
