<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \DB;

class UserController extends Controller
{

    public function allUsers(Request $request){

        //Primero inicializamos las variables

        $nombre_usuario =   '';
        $nombre_usuario =   $request->nombre;



        //Realizando la consulta a la base de datos para obtener los acuerdos
        $usuarios = DB::table('users')
        ->select('id', 'nombre', 'username')
        ->where('nombre', 'like', '%'.$nombre_usuario.'%')
        ->get();


        return $usuarios;

      }

    public function index()
    {
        $users = User::paginate();
        return view('user.listar_usuarios', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('user.ingresar', compact('roles'));
    }
    public function store(Request $request)
    {
        $user = $request->validate([
            'nombre'    => 'required',
            'username'  => 'required|unique:users',
            'email'     => 'required|unique:users',
            'password'  =>  'required',
            'escuela_id'=> 'required',
        ]);
        $data = $request->all();
        User::create([
            'nombre' => $data['nombre'],
            'username'=>$data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'college_id' => $data['escuela_id'],
        ]);
        $id_user = DB::table('users')->select('id')->where('username','=', $data['username'])->get();
        $id = $id_user['0'];
        DB::table('role_user')->insert([
           'role_id' => $data['role_id'],
           'user_id' => $id->id,
       ]);
       return redirect()->route('user.index','save=1')->with('info', 'El usuario ha sigo guardado con exito');

    }

    public function edit(User $user)
    {
        return view('user.editar',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        //Primero que se actualice el usario
        $user->update([
            'nombre' => $data['nombre'],
            'username'=>$data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        //Segundo que se actualicen los roles
        return redirect()->route('user.index','save=2')
        ->with('info','Usuario Actualizado con exito');

    }

}
