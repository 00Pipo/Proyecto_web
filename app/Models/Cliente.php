<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    protected $primaryKey = 'rut';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'rut',
        'nombre',
        'email',
        'telefono',
    ];

    public function arriendos()
    {
        return $this->hasMany(Arriendo::class, 'cliente_rut', 'rut');
    }
}
