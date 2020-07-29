<?php

namespace modain\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use modain\Http\Controllers\Controller;
use modain\TipoProducto;
use modain\Marca;
use modain\Talla;
use Session;
class LoginController extends Controller
{
  public function __construct(){
    $this->middleware('guest', ['only' => 'showLoginForm']);
  }

  public function showLoginForm(){
    $Tallas = Talla::all();
    $TipoProductos = TipoProducto::all();
    $Marcas = Marca::all();

    return view('auth.login', compact('TipoProductos','Marcas','Tallas'));
  }
  public function showIndex(){
    return redirect()->route('guest');
  }
  public function login(){
      $credentials = $this->validate(request(),[
        'email' => 'email|required|string',
        'password' => 'required|string'
      ]);

      if(Auth::attempt($credentials)){
          $estado = auth()->user()->estado;
          if($estado == 1){
            Auth::logout();
            return back()
                ->withErrors(['email' => trans('auth.failed')])
                ->withInput(request(['email']));
          }else if($estado != 2){
            return redirect()->route('home');
          }else{
            return redirect()->route('admin');
          }
      };

      return back()
          ->withErrors(['email' => trans('auth.failed')])
          ->withInput(request(['email']));
  }

  public function logout(){
    Auth::logout();

    return redirect('/');
  }
}
