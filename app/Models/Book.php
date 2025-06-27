<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'year', 'publisher', 'cover', 'stock', 'genre', 'description',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
} 