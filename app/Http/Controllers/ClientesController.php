<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rut' => ['required', 'string', 'cl_rut', 'max:12'],
            'nombre' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:clientes,email'],
            'telefono' => ['required', 'string', 'max:9', 'min:9', 'regex:/^[0-9]+$/', 'starts_with:9,8,7,6'],
        ]);
        $rut = Rut::parse($request->rut);
        if (!$rut->isValid()) {
            return redirect()->back()->withErrors(['rut' => 'El RUT ingresado no es válido']);
        }
        $rutNoDV = $rut->number();
        if (Cliente::where('rut', $rutNoDV)->exists()) {
            return redirect()->back()->withErrors(['rut' => 'El RUT ingresado ya está registrado']);
        }
        $request->merge(['rut' => $rutNoDV]);
        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Cliente $cliente, Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:clientes,email,' . $cliente->rut . ',rut'],
            'telefono' => ['required', 'string', 'max:9', 'min:9', 'regex:/^[0-9]+$/', 'starts_with:9,8,7,6'],
        ]);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->arriendos()->exists()) {
            return redirect()->route('clientes.index')->withErrors(['error' => 'No se puede eliminar el cliente porque tiene arriendos asociados']);
        }
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
