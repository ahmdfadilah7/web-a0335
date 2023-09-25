<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenpenguji extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id', 'tugasakhir_id', 'dosen_id'
    ];

    public function tugasakhir()
    {
        return $this->belongsTo(Tugasakhir::class);
    }
}
