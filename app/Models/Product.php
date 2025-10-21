<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'price', 'category',
        'image', 'stock_quantity', 'is_active'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('public')->url('products/'.$this->image) : null;
    }

    protected $appends = ['image_url'];
}
