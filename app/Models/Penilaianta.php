<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaianta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuanjudul_id',
        'mahasiswa_id',
        'prodi_id',
        'status',
        'nilai_1',
        'nilai_2',
        'nilai_3',
        'nilai_4',
        'total_nilai',
        'grade'
    ];
}
