<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Yahan class ka naam 'Wishlist' (Capital W) hona chahiye
class Wishlists extends Model
{
    use HasFactory;

    // Table ka naam 'wishlists' hai
    protected $table = 'wishlists';

    protected $fillable = ['user_id', 'product_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}