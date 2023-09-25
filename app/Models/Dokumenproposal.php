<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenproposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'proposal_id', 'prodi_id'
    ];
}
