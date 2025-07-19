<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'email');
    }

    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'image',
    ];
}
