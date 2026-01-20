<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'brand_id',     
        'color_id',
        'name',
        'image',
        'price',
        'mrp',
        'description',
    ];

    // Main Category (e.g. Men)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Subcategory (ye bhi Categories table me hi hai, par ID alag hai)
    public function subcategory()
    {
        // Yaha hum Subcategory Model nahi, balki Category Model use karenge
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function brand()
{
    return $this->belongsTo(Brand::class, 'brand_id');
}

// Color ke sath rishta
public function color()
{
    return $this->belongsTo(Color::class, 'color_id');
}
}