<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAdminPerfil;
use App\Models\Tipo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckAdminPerfil::class)->except('index', 'show', 'editEstado', 'updateEstado');
    }

    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $tiposVehiculos = Tipo::all();
        return view('vehiculos.create', compact('tiposVehiculos'));
    }

    public function show(Vehiculo $vehiculo)
    {
        return view('vehiculos.show', compact('vehiculo'));
    }

    public function edit(Vehiculo $vehiculo)
    {
        $tiposVehiculos = Tipo::all();
        return view('vehiculos.edit', compact('vehiculo', 'tiposVehiculos'));
    }

    public function editEstado(Vehiculo $vehiculo)
    {
        return view('vehiculos.cambiarEstado', compact('vehiculo'));
    }

    public function update(Vehiculo $vehiculo, Request $request)
    {
        $request->validate([
            'tipo_id' => ['required', 'exists:tipos,id'],
            'marca' => ['required', 'string', 'max:50'],
            'modelo' => ['required', 'string', 'max:50'],
            'valor_arriendo' => ['required', 'integer'],
            'estado' => ['required', 'in:disponible,arrendado,en mantenimiento,de baja'],
        ]);
        $vehiculo->update([
            'tipo_id' => $request->tipo_id,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'valor_arriendo' => $request->valor_arriendo,
            'estado' => $request->estado,
        ]);
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado exitosamente');
    }

    public function updateEstado(Vehiculo $vehiculo, Request $request)
    {
        $request->validate([
            'estado' => ['required', 'in:disponible,arrendado,en mantenimiento,de baja'],
        ]);
        $vehiculo->update([
            'estado' => $request->estado,
        ]);
        return redirect()->route('vehiculos.index')->with('success', 'Estado del vehículo actualizado exitosamente');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado exitosamente');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_id' => ['required', 'exists:tipos,id'],
            'marca' => ['required', 'string', 'max:50'],
            'modelo' => ['required', 'string', 'max:50'],
            'valor_arriendo' => ['required', 'integer'],
            'estado' => ['required', 'in:disponible,arrendado,en mantenimiento,de baja'],
        ]);

        Vehiculo::create([
            'tipo_id' => $request->tipo_id,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'valor_arriendo_diario' => $request->valor_arriendo,
            'estado' => $request->estado,
        ]);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado exitosamente');
    }
}
