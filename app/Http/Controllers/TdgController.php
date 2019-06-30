<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tdg;
use \DB;

class TdgController extends Controller
{
    //
    public function index(){
        return view('tdg.ingresar');
    }

    public function store(Request $request){
        $data = $request->validate([
            'nombre'=>'required|unique:tdgs',
            'perfil'=>'required|unique:tdgs',
            ]);
         


            //Rescatar escuela del usuario
            $escuela = $request->Input('college_id');
            $num = (int) $escuela;
            

            //Rescatar todos los tdg para extraer el ultimo id
            $tdgs = Tdg::all();
            
            $lastid=0;

            //$ultimoid['id']=$tdgs->where('id','=',$tdgs->id)->orderby('created_at','DESC')->take(1)->get();
            $lastRecord = DB::table('tdgs')->where('escuela_id','=',$num)->orderBy('id', 'DESC')->first();
            //psi19001
            if($lastRecord==null){
                $auxnum=0;
            }else{
                $auxnum =(int) substr($lastRecord->codigo, strlen($lastRecord->codigo)-3, strlen($lastRecord->codigo));
            }
          

            //Hacer codigo de TDG
            $idescuela = DB::table('colleges')->find($num);
            $correlativo = '';
            if($auxnum<=9){
                $correlativo = '00';
            }
            if($auxnum>9 && $auxnum<=99){
                $correlativo = '0';
            }

            $codigo = 'P'.$idescuela->nombre.date("y").$correlativo.($auxnum+1);

            
             
            //Guardar archivos
        $file = $request->file('perfil');
        
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();

        $nombreexiste = Tdg::all();
        $nom=0;
            if($nombreexiste){
                foreach( $nombreexiste as $existe ) {
                    if($existe->perfil==$nombre)
                        $nom=1;  
                }}
        if($nom==0){
        \Storage::disk('localp')->put($nombre,  \File::get($file));
        
           
      $tdg=Tdg::create([
          'nombre'=>$data['nombre'],
          'escuela_id'=>$num,
          'codigo'=>$codigo,
          'perfil'=>$nombre,
      ]);
     
      return redirect()->route('tdg.ingresar', $tdg->id.'&save=1')
      ->with('info','Trabajo de graduación guardado con éxito');
      }
      else {
      return redirect()->route('tdg.ingresar', '/?&save=0&nombre='.$data['nombre'])
      ->with('info','El nombre del perfil ya existe. Por favor cambie el nombre del archivo'); 
      }
    }
}
