<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kelompok_id', 'prodi_id', 'pengajuanjudul_id', 'nilai_proposal', 'nilai_ta', 'nilai_pembimbing', 'nilai_adm', 'total', 'grade'
    ];
}
