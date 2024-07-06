<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'rut';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rut',
        'name',
        'email',
        'perfil_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->perfil_id == 1;
    }

    public function formatedRut()
    {
        $dv = Rut::set($this->rut)->calculateVerificationNumber();
        $rut = $this->rut . '-' . $dv;
        return Rut::parse($rut)->format();
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    public function arriendos()
    {
        return $this->hasMany(Arriendo::class, 'user_rut', 'rut');
    }
}
