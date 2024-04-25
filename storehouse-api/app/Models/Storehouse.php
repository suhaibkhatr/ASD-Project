<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "address",
        "city",
        "state",
        "storehouse_type_id",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, "storehouse_users");
    }
}
