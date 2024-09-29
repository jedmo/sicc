<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;

class AuthController extends Controller {

    /**
     * Display login of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function login(){
        $title = "Iniciar sesión";
        $description = "Inicio de sesión para sistema administrativo de ELIM";
        return view('auth.login',compact('title','description'));
    }

    /**
     * Display register of the resource.
     *
     * @return \Illuminate\View\View
     */
    // public function register(){
    //     $title = "Register";
    //     $description = "Some description for the page";
    //     return view('auth.register',compact('title','description'));
    // }

    /**
     * Display forget password of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function forgetPassword(){
        $title = "Forget Password";
        $description = "Some description for the page";
        return view('auth.forget_password',compact('title','description'));
    }

    /**
     * make the user able to register
     *
     * @return
     */
    // public function signup(Request $request){
    //     $validators=Validator::make($request->all(),[
    //         'name'=>'required',
    //         'email'=>'required|email|unique:users',
    //         'password'=>'required'
    //     ]);
    //     if($validators->fails()){
    //         return redirect()->route('register')->withErrors($validators)->withInput();
    //     }else{
    //         $user = new User();
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->password = bcrypt($request->password);
    //         $user->save();
    //         auth()->login($user);
    //         return redirect()->intended(route('index'))->with('message','Registration was successfull !');
    //     }
    // }

    /**
     * make the user able to login
     *
     * @return
     */
    public function authenticate(Request $request){
        $validators=Validator::make($request->all(),[
            'user'=>'required',
            'password'=>'required'
        ]);
        if($validators->fails()){
            return redirect()->route('login')->withErrors($validators)->withInput();
        }else{
            if(Auth::attempt(['user'=>$request->user,'password'=>$request->password])){
                return redirect()->intended(route('home'))->with('message','Bienvenido/a!');
            }else{
                $user = User::where([
                    'user'  => $request->user,
                    'password'  => md5($request->password)
                ])->first();

                if ($user) {
                    User::where([
                        'user'  => $request->user,
                        'password'  => md5($request->password)
                    ])->update(['password' => bcrypt($request->password)]);
                    auth()->login($user);
                    return redirect()->intended(route('home'))->with('message','Bienvenido/a!');
                }
                return redirect()->route('login')->with('message','El usuario o contraseña ingresados son incorrectos. Por favor, inténtelo de nuevo.');
            }
        }
    }

    /**
     * make the user able to logout
     *
     * @return
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('message','Se ha cerrado la sesión.');
    }
}
