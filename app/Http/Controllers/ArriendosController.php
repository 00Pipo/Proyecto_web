<?php

namespace App\Http\Controllers;

use App\Models\Arriendo;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArriendosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $arriendos = Arriendo::orderBy('cliente_rut', 'asc')->get();
        return view('arriendos.index', compact('arriendos'));
    }

    public function show(Arriendo $arriendo)
    {
        return view('arriendos.show', compact('arriendo'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::where('estado', 'disponible')->orderBy('marca', 'asc')->get();
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        return view('arriendos.create', compact('vehiculos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_rut' => ['required', 'string', 'max:12'],
            'vehiculo_id' => ['required', 'string', 'max:6', 'exists:vehiculos,id'],
            'fecha_inicio' => ['required', 'date', 'before:fecha_termino'],
            'fecha_termino' => ['required', 'date', 'after:fecha_inicio'],
            'fotos_entrega' => ['required', 'array', 'min:1'],
            'fotos_entrega.*' => ['required', 'image', 'max:2048'],
            'valor_total' => ['required', 'integer'],
        ]);

        if (!Cliente::where('rut', $request->cliente_rut)->exists()) {
            return redirect()->back()->withErrors(['cliente_rut' => 'El RUT ingresado no está registrado']);
        }

        $files = [];
        $photos_to_store = '';
        foreach ($request->file('fotos_entrega') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // save file to storage
            Storage::disk('public')->put('fotos_entrega/' . $fileName, file_get_contents($file));

            $files[] = ['name' => $fileName];
        }

        foreach ($files as $fileData) {
            $photos_to_store .= $fileData['name'] . ',';
        }

        Arriendo::create([
            'cliente_rut' => $request->cliente_rut,
            'vehiculo_id' => $request->vehiculo_id,
            'user_rut' => Auth::user()->rut,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
            'fecha_entrega' => now(),
            'fotos_entrega' => $photos_to_store,
            'valor_total' => $request->valor_total,

        ]);

        Vehiculo::where('id', $request->vehiculo_id)->update(['estado' => 'arrendado']);
        return redirect()->route('arriendos.index')->with('success', 'Arriendo creado exitosamente');
    }

    public function edit(Arriendo $arriendo)
    {
        $vehiculos = Vehiculo::where('estado', 'disponible')->orderBy('marca', 'asc')->get();
        if ($arriendo->vehiculo->estado == 'arrendado') {
            $vehiculos->push($arriendo->vehiculo);
        }
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        return view('arriendos.edit', compact('arriendo', 'vehiculos', 'clientes'));
    }

    public function update(Arriendo $arriendo, Request $request)
    {
        $request->validate([
            'cliente_rut' => ['required', 'string', 'max:12'],
            'vehiculo_patente' => ['required', 'string', 'max:6'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date'],
        ]);

        $arriendo->update($request->all());
        return redirect()->route('arriendos.index')->with('success', 'Arriendo actualizado exitosamente');
    }

    public function destroy(Arriendo $arriendo)
    {
        $arriendo->delete();
        return redirect()->route('arriendos.index')->with('success', 'Arriendo eliminado exitosamente');
    }

    // almacena fotos de entrega
    public function storePhotoEntrega(Arriendo $arriendo, Request $request)
    {
        $request->validate([
            'fotos_entrega' => ['required', 'array', 'min:1'],
            'fotos_entrega.*' => ['required', 'image', 'max:2048'],
        ]);

        $files = [];
        $photos_to_store = '';
        foreach ($request->file('fotos_entrega') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // save file to storage
            Storage::disk('public')->put('fotos_entrega/' . $fileName, file_get_contents($file));

            $files[] = ['name' => $fileName];
        }

        foreach ($files as $fileData) {
            $photos_to_store .= $fileData['name'] . ',';
        }

        $arriendo->update(['fotos_entrega' => $photos_to_store]);
        return redirect()->back()->with('success', 'Fotos de entrega actualizadas exitosamente');
    }

    // almacena fotos de devolución
    public function storePhotoDevolucion(Arriendo $arriendo, Request $request)
    {
        $request->validate([
            'fotos_devolucion' => ['required', 'array', 'min:1'],
            'fotos_devolucion.*' => ['required', 'image', 'max:2048'],
        ]);

        $files = [];
        $photos_to_store = '';
        foreach ($request->file('fotos_devolucion') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // save file to storage
            Storage::disk('public')->put('fotos_devolucion/' . $fileName, file_get_contents($file));

            $files[] = ['name' => $fileName];
        }

        foreach ($files as $fileData) {
            $photos_to_store .= $fileData['name'] . ',';
        }

        $arriendo->update(['fotos_devolucion' => $photos_to_store]);
        return redirect()->back()->with('success', 'Fotos de devolución actualizadas exitosamente');
    }

    // elimina fotos de entrega, recibe un array con los nombres de las fotos a eliminar
    public function destroyPhotoEntrega(Arriendo $arriendo, Request $request)
    {
        $request->validate([
            'fotos_entrega' => ['required', 'array', 'min:1'],
            'fotos_entrega.*' => ['required', 'string'],
        ]);

        $photos = explode(',', $arriendo->fotos_entrega);

        foreach ($request->fotos_entrega as $photo) {
            $photoIndex = array_search($photo, $photos);
            if ($photoIndex !== false) {
                unset($photos[$photoIndex]);
                Storage::disk('public')->delete('fotos_entrega/' . $photo);
            }
        }

        $arriendo->update(['fotos_entrega' => implode(',', $photos)]);
        return redirect()->back()->with('success', 'Fotos de entrega eliminadas exitosamente');
    }

    // elimina fotos de devolución, recibe un array con los nombres de las fotos a eliminar
    public function destroyPhotoDevolucion(Arriendo $arriendo, Request $request)
    {
        $request->validate([
            'fotos_devolucion' => ['required', 'array', 'min:1'],
            'fotos_devolucion.*' => ['required', 'string'],
        ]);

        $photos = explode(',', $arriendo->fotos_devolucion);

        foreach ($request->fotos_devolucion as $photo) {
            $photoIndex = array_search($photo, $photos);
            if ($photoIndex !== false) {
                unset($photos[$photoIndex]);
                Storage::disk('public')->delete('fotos_devolucion/' . $photo);
            }
        }

        $arriendo->update(['fotos_devolucion' => implode(',', $photos)]);
        return redirect()->back()->with('success', 'Fotos de devolución eliminadas exitosamente');
    }
}
