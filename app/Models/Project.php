<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi via Form / Mass Assignment
    protected $fillable = [
        'name',
        'description',
        'link',
        'tech_stack',
    ];
}
