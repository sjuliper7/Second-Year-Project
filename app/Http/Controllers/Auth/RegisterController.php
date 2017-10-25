<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\User;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        dd('masyk diads');
        return view('adminlte::auth.register');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //dd("masuk agan");

        $user = new User();
        $user->name  = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role = "Customer";
        $user->foto = "gravatar.png";

        $user->save();
        $dataPel = DB::table('users')
            ->select('users.id')
            ->where('users.username','=',$data['username'])
            ->get();

        $cus = new Customer();
        $cus->id_Akun = $dataPel[0]->id;
        $cus->nama = $data['name'] ;
        $cus->alamat = "---";
        $cus->noTelepon = "---";
        $cus->pekerjaan = "---";

        $cus->save();

        //return redirect('/');

    }
}
