<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'photos', 'products_id'
    ];

    protected $hidden = [];

    public function products() {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
