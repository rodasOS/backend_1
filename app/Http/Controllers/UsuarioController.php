<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Parser\Token;
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

    public function register(Request $request) {

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
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string',
            'estado' => 'required|string|in:activo',
        ]);

        if($validator->fails()) {
            return response()->json([
                'mensaje' => 'Algo salió mal',
                'error' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $usuario = new Usuario();
        $usuario->primerNombre = $request->primerNombre;
        $usuario->primerApellido = $request->primerApellido;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->estado = $request->estado;
        $usuario->save();

        return response()->json([
            'mensaje' => 'Usuario creado correctamente.',
            'usuario' => $usuario
        ], Response::HTTP_CREATED);

    }

    public function login(Request $request) {

        try {
            $credenciales = $request->only('email', 'password');

            if(Auth::attempt($credenciales)) {
                $usuario = Auth::user();

                $token = $usuario->createToken('mi_app')->plainTextToken;
                $cookie = cookie('personal_access_token', $token, 60 * 24);
    
                return response()->json([
                    'mensaje' => 'Usuario logueado',
                    'token' => $token,
                    'usuario' => $usuario,
                ], Response::HTTP_OK)->withoutCookie($cookie); 
            }

            return response()->json([
                'mensaje' => 'Credenciales incorrectas',
                // 'error' => 'error',
            ], Response::HTTP_UNAUTHORIZED);

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }

    }

}
