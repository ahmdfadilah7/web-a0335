<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nim', 'email', 'password', 'role_id', 'prodi_id', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the prodi that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Get the Role that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get all of the Proposal for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposal()
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * Get all of the Tugasakhir for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tugasakhir()
    {
        return $this->hasMany(Tugasakhir::class);
    }

    public function anggotakelompok()
    {
        return $this->hasMany(Anggotakelompok::class);
    }
}
