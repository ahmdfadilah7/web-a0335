<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'file', 'user_id', 'tugas_id', 'kelompok_id', 'status'
    ];

    /**
     * Get the user that owns the Proposal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kelompok that owns the Proposal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}
