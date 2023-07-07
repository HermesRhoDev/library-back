<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function getIncrementing ()
    {
        return false;
    }

    public function getKeyType ()
    {
        return 'string';
    }

    protected $fillable = [
        'id',
        'title',
        'pageCount',
        'authors',
        'categories',
        'cover_link',
        'summary',
    ];

    public function collections(){ return $this->belongsToMany(Collection::class, 'book_collection'); }
    
}
