<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arriendo extends Model
{
    use HasFactory;
    protected $table = 'arriendos';

    protected $fillable = [
        'cliente_rut',
        'vehiculo_id',
        'user_rut',
        'fecha_inicio',
        'fecha_termino',
        'fecha_entrega',
        'fecha_devolucion',
        'fotos_entrega',
        'fotos_devolucion',
        'valor_total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_rut', 'rut');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_rut', 'rut');
    }

    public function valorFormated()
    {
        return '$' . number_format($this->valor_total, 0, ',', '.');
    }
}
