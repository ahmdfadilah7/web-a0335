<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'prodi_id'
    ];

    /**
     * Get all of the proposal for the Kelompok
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposal()
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * Get all of the tugasakhir for the Kelompok
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tugasakhir()
    {
        return $this->hasMany(Tugasakhir::class);
    }

    /**
     * Get all of the artefak for the Kelompok
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function artefak()
    {
        return $this->hasMany(Artefak::class);
    }
}
