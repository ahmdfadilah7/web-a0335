<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuanjudul extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id', 'dosen_id', 'prodi_id', 'judul', 'keterangan', 'status', 'alasan'
    ];
}
