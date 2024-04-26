<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["title", "storehouse_id"];

    public function storehouse(): BelongsTo
    {
        return $this->belongsTo(Storehouse::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
