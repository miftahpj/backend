<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users'; // Nama tabel di database

    protected $fillable = [
        'username',
        'password',
        'email',
        'role'
    ]; // Kolom yang bisa diisi (mass assignable)

    // Relasi ke tabel Articles (Author)
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }
}
