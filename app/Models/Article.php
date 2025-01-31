<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles'; 

    protected $fillable = [
        'title', 
        'content', 
        'author_id', 
        'category_id', 
        'image'
    ]; 

    // Relasi ke  Users
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Relasi ke  Categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
