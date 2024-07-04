<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Freshwork\ChileanBundle\Rut;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validation = Validator::make($data, [
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

        if ($validation->fails()) {
            return $validation;
        }

        $rut = Rut::parse($data['rut']);
        if (!$rut->isValid()) {
            $validation->errors()->add('rut', 'El RUT ingresado no es válido');
        }

        $rutNoDV = $rut->number();
        $validation->after(function ($validation) use ($rutNoDV) {
            if (User::where('rut', $rutNoDV)->exists()) {
                $validation->errors()->add('rut', 'El RUT ingresado ya está registrado');
            }
        });

        return $validation;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $rut = Rut::parse($data['rut']);
        return User::create([
            'rut' => $rut->number(),
            'name' => $data['name'],
            'perfil_id' => 2, // perfil_id por defecto ejecutivo
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
