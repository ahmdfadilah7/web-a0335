<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artefak extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'tugasakhir_id', 'kelompok_id', 'prodi_id', 'tahun'
    ];

    /**
     * Get the tugasakhir that owns the Artefak
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tugasakhir()
    {
        return $this->belongsTo(Tugasakhir::class);
    }

    /**
     * Get the kelompok that owns the Artefak
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}
