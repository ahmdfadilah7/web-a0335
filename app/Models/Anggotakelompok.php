<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggotakelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelompok_id', 'user_id', 'token', 'status'
    ];

    /**
     * Get all of the user for the Anggotakelompok
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
