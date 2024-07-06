<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el perfil del usuario autenticado.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('rut', Auth::user()->rut)->first();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->rut . ',rut'],
        ]);

        $user->update($request->all());
        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }

    public function editPassword()
    {
        $user = auth()->user();
        return view('profile.password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:10',             // debe tener al menos 10 caracteres de longitud
                'regex:/[a-z]/',      // debe contener al menos una letra minúscula
                'regex:/[A-Z]/',      // debe contener al menos una letra mayúscula
                'regex:/[0-9]/',      // debe contener al menos un dígito
                'regex:/[@$!%*#?&]/', // debe contener un carácter especial
                'confirmed'
            ],
        ]);

        $user = User::find(Auth::id());
        $user->update(['password' => bcrypt($request->password)]);
        return redirect()->route('perfil')->with('success', 'Contraseña actualizada correctamente.');
    }
}
