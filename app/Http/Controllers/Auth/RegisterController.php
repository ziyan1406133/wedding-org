<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'max:191', 'unique:users'],
            'role' => ['required', 'string'],    
            'legal_doc' => ['max:1999'],    
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'legal_doc.mimes' => 'Dokumen yang diupload harus berupa Gambar atau PDF',
            'legal_doc.max' => 'Maksimum ukuran file yang diupload adalah 2 MB'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = request();

        $filenameWithExt = $request->file('legal_doc')->getClientOriginalName();
        $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('legal_doc')->getClientOriginalExtension();
        $FileNameToStore = $filename.'_'.time().'_.'.$extension;
        $path = public_path('/storage/legaldoc/');
        $request->file('legal_doc')->move($path, $FileNameToStore);

        return User::create([
            'name' => $data['name'],        
            'username' => $data['username'],
            'role' => $data['role'],
            'legal_doc' => $FileNameToStore,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
