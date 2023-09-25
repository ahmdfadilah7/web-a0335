<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAdm extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuanjudul_id',
        'mahasiswa_id',
        'koordinator_id',
        'prodi_id',
        'status',
        'submit_dokumen_1',
        'schedule_1',
        'reschedule_1',
        'ulang_1',
        'submit_dokumen_2',
        'schedule_2',
        'reschedule_2',
        'ulang_2',
        'nilai_1',
        'nilai_2',
        'persentase',
        'persentase_2',
        'total_nilai'
    ];
}
