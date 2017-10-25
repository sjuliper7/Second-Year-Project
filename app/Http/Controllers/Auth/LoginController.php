<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Validator;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('adminlte::auth.login');
    }

    public function username()
    {
        return 'username';
    }

    public function Login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ], [
            'username.required' => 'Silahkan Masukkan Username!',
            'username.exists' => 'Username tidak diketemukan',
            'password.required' => 'Silahkan Masukkan Password!'
        ]);

        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator->errors());
        } else {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                //dd(Auth::user()->role);
                if (Auth::user()->role == 'Admin') {
                    return redirect()->intended('/listowner');
                }
                else if(Auth::user()->role == 'Owner'){
                    return redirect()->intended('/pesanan');
                }
                else if(Auth::user()->role=='Customer'){
                    //dd("masuk gan");
                    return redirect('/');
                }
                else {
                    $validator->errors()->add('password', 'Password tidak benar');
                    return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
                }
            }else{
				return redirect('login')->with('message','Password atau Username Salah');
			}
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
