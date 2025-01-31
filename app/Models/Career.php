<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers'; // Nama tabel di database

    protected $fillable = [
        'title',
        'description',
        'image'
    ]; // Kolom yang bisa diisi (mass assignable)
}
