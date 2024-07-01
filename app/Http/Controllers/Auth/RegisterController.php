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
        $validation1 = Validator::make($data, [
            'rut' => ['cl_rut']
        ]);
        if($validation1->fails()){
            $validation1->errors()->add('rut', 'El rut no es valido.');
            return $validation1;
        }
        if (!Rut::parse($data['rut'])->validate()) {
            $validation1->errors()->add('rut', 'El rut no es valido.');
            return $validation1;
        }
        $data ['rut'] = Rut::parse($data['rut'])->number();
        return Validator::make($data, [
            'rut' => ['required', 'unique:users,rut'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $data
     * @return \App\Models\User
     */
    protected function create(array $data)

    {
        $data ['rut'] = Rut::parse($data['rut'])->number();
        return User::create([
            'rut' => $data['rut'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
