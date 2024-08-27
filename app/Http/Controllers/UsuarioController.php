<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UsuarioController extends Controller
{
    //

    public function index() {
        $usuarios = Usuario::all();

        return response()->json([
            'mensaje' => 'Usuarios encontrados correctamente.', 
            'usuarios' => $usuarios
        ]);
    }

    public function crear(Request $request) {

        // $request->validate([
        //     'primerNombre' => 'required|string',
        //     'primerApellido' => 'required|string',
        //     'correo' => 'required|email|unique:usuarios,correo',
        //     'password' => 'required|string',
        //     'estado' => 'required|string|in:activo,pendiente',
        // ]);

        $validator = Validator::make($request->all(), [
            'primerNombre' => 'required|string',
            'primerApellido' => 'required|string',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|string',
            'estado' => 'required|string|in:activo',
        ]);

        if($validator->fails()) {
            return response()->json([
                'mensaje' => 'Algo salió mal',
                'error' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $usuario = Usuario::create($request->all());

        return response()->json([
            'mensaje' => 'Usuario creado correctamente.',
            'usuario' => $usuario
        ], Response::HTTP_CREATED);

    }

}
