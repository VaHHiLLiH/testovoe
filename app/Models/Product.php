<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'old_price',
        'brand',
        'category_id',
    ];

    protected $guarded = [
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
