<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image_path',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    /**
     * Get the available categories for products
     */
    public static function getCategories()
    {
        return ['durian', 'makanan', 'minuman', 'bibit'];
    }

    /**
     * Get category display names
     */
    public static function getCategoryDisplayNames()
    {
        return [
            'durian' => 'Durian',
            'makanan' => 'Makanan',
            'minuman' => 'Minuman',
            'bibit' => 'Bibit'
        ];
    }

    /**
     * Get the display name for the category
     */
    public function getCategoryDisplayNameAttribute()
    {
        $displayNames = self::getCategoryDisplayNames();
        return $displayNames[$this->category] ?? ucfirst($this->category);
    }
}
