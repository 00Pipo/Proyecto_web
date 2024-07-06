<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAdminPerfil;
use App\Models\Tipo;
use Illuminate\Http\Request;

class TiposVehiculosController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdminPerfil::class);
    }

    public function index()
    {
        $tiposVehiculos = Tipo::all();
        return view('vehiculos.tipos.index', compact('tiposVehiculos'));
    }

    public function create()
    {
        return view('vehiculos.tipos.create');
    }

    public function show(Tipo $tipo)
    {
        return view('vehiculos.tipos.show', compact('tipo'));
    }

    public function edit(Tipo $tipo)
    {
        return view('vehiculos.tipos.edit', compact('tipo'));
    }

    public function update(Tipo $tipo, Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);

        $tipo->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tiposVehiculos.index')->with('success', 'Tipo de vehículo actualizado exitosamente');
    }

    public function destroy(Tipo $tipo)
    {
        if ($tipo->vehiculos->count() > 0) {
            return redirect()->route('tiposVehiculos.index')->with('error', 'No se puede eliminar el tipo de vehículo porque tiene vehículos asociados');
        }
        $tipo->delete();
        return redirect()->route('tiposVehiculos.index')->with('success', 'Tipo de vehículo eliminado exitosamente');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);

        Tipo::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tiposVehiculos.index')->with('success', 'Tipo de vehículo creado exitosamente');
    }
}
