<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugasakhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'file', 'user_id', 'tugas_id', 'kelompok_id', 'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kelompok that owns the Tugasakhir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    /**
     * Get all of the artefak for the Tugasakhir
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function artefak()
    {
        return $this->hasMany(Artefak::class);
    }

    public function dokumenpenguji()
    {
        return $this->hasMany(Dokumenpenguji::class);
    }
}
