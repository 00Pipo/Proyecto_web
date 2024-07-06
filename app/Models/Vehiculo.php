<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'vehiculos';

    protected $fillable = [
        'tipo_id',
        'marca',
        'modelo',
        'valor_arriendo_diario',
        'estado',
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function arriendos()
    {
        return $this->hasMany(Arriendo::class);
    }

    /*
    * Formatea el valor del arriendo diario a formato de moneda CLP
    */
    public function valorArriendoFormated()
    {
        return '$' . number_format($this->valor_arriendo_diario, 0, ',', '.');
    }
}
