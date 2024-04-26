<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "quantity",
        "price",
        "storehouse_id",
    ];

    public function storehouse()
    {
        return $this->belongsTo(Storehouse::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "product_category");
    }
}
