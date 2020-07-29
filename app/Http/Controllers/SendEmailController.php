<?php

namespace modain\Http\Controllers;
use modain\TipoProducto;
use modain\Marca;
use modain\Talla;
use Illuminate\Http\Request;
use modain\Http\Requests\SendEmailRequest;
use Illuminate\Support\Facades\Mail;
use modain\Mail\SendMail;

class SendEmailController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $Marcas = Marca::all();
    $Tallas = Talla::all();
    $TipoProductos = TipoProducto::all();

    return view('Home.send_email',compact('TipoProductos','Marcas','Tallas'));
  }

  public function send(SendEmailRequest $request){
    $data = array(
      'name' => $request->name,
      'email' => $request->email,
      'message' => $request->message
    );

    Mail::to('contactogenericlothing@gmail.com')->send(new SendMail($data));

    return back()->with('status','Gracias por el feedback o contactarse con nosotros!');
  }
}
