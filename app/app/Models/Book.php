<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = [
        'title',
        'author',
        'issued',
        'cover',
    ];

    protected $casts = [
        'issued' => 'date'
    ];
}
