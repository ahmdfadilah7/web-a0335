<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentugasakhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'tugasakhir_id', 'prodi_id'
    ];
}
