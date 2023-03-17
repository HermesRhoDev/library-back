<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    use UUID, HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'content',
    ];

    protected $hidden = [
        'user_id',
        'book_id',
    ];
}
