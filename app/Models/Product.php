<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name', 'description', 'price',
        'image', 'stock_quantity', 'is_active','category_id','user_id',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('public')->url('products/'.$this->image) : null;
    }
    protected $appends = ['image_url'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
