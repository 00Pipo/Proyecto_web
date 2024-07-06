<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckAdminPerfil;
use App\Models\Perfil;
use App\Models\User;
use Freshwork\ChileanBundle\Facades\Rut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdminPerfil::class);
    }

    public function admUsers()
    {
        $users = User::all();
        return view('adm.users', compact('users'));
    }

    public function admUser(User $user)
    {
        return view('adm.userShow', compact('user'));
    }
    public function edit(User $user)
    {
        if ($user->rut == Auth::user()->rut) {
            return redirect()->route('perfil.editar');
        }

        $perfiles = Perfil::all();

        return view('adm.userEdit', compact('user', 'perfiles'));
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'perfil' => ['required', 'exists:perfiles,id'],
            'rut' => ['required', 'string', 'max:12'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->rut . ',rut'],
        ]);

        $user->update([
            'rut' => $user->rut,
            'perfil_id' => $request->perfil,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'No puedes eliminar tu propio usuario');
        }

        if ($user->isAdmin() && User::where('perfil_id', 1)->count() == 1) {
            return redirect()->route('admin.users')->with('error', 'No se puede eliminar el único usuario administrador');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado exitosamente');
    }

    public function create()
    {
        $perfiles = Perfil::all();
        return view('adm.userCreate', compact('perfiles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'rut' => ['required', 'string', 'max:12', 'cl_rut'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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

        $rut = Rut::parse($request->rut);
        if (!$rut->isValid()) {
            return redirect()->back()->withErrors(['rut' => 'El RUT ingresado no es válido']);
        }

        $rutNoDV = $rut->number();
        if (User::where('rut', $rutNoDV)->exists()) {
            return redirect()->back()->withErrors(['rut' => 'El RUT ingresado ya está registrado']);
        }

        User::create([
            'rut' => $rut->number(),
            'name' => $request->name,
            'perfil_id' => $request->perfil,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario creado exitosamente');
    }
    public function editPassword()
    {
    }
    public function updatePassword()
    {
    }
    public function updateRoles()
    {
    }
}
