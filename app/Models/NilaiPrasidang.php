<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPrasidang extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuanjudul_id',
        'mahasiswa_id',
        'dosen_id',
        'prodi_id',
        'penilai',
        'nilai_1',
        'nilai_2',
        'nilai_3',
        'nilai_4',
        'nilai_5',
        'total_nilai'
    ];
}
