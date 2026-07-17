<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk memaksa menunjuk ke tabel 'educations'
    protected $table = 'educations';

    protected $fillable = [
        'institution',
        'degree',
        'period',
        'description',
    ];
}