<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use UUID, HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $hidden = [
        'user_id',
    ];

    public function books(){ return $this->belongsToMany(Book::class, 'book_collection'); }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

}
