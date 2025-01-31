<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nama tabel di database

    protected $fillable = [
        'name',
        'description'
    ]; // Kolom yang bisa diisi (mass assignable)

    // Relasi ke tabel Articles
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
