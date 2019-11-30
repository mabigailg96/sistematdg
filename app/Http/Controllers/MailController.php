<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailEscuela;
use Mail;
use App\User;
use Illuminate\Support\Facades\Hash;
use \DB;
class MailController extends Controller
{
    public function createMail(){
        $correos = DB::table('users')
        ->select('nombre', 'email')
        ->where('id', '>', 1)
        ->get();

        return view('mail.ingresoCorreo', compact('correos') );
    }

    public function mandarCorreoEscuela(Request $request){

        $correo = $request->validate([
            'asunto'  => 'required',
            'contenido' => 'required',
        ]);
        Mail::to($request->destinatario)->send(new MailEscuela($request));
        return redirect()->route('mail.create','save=1')->with('info', 'el correo se ha enviado con exito');
    }
}
