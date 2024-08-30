<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tipos = TipoProducto::all();
        
        if($tipos->isEmpty()) {
            return response()->json([
                'mensaje' => 'No se encontraron tipos.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'mensaje' => 'Tipos de productos encontrados correctamente.',
            'tipos' => $tipos
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'estado' => ['required', 'string', 'in:activo'],
        ]);

        if($validator->fails()) {
            return response()->json([
                'mensaje' => 'mensaje',
                'error' => $validator->errors()
            ]);
        }

        $tipo = TipoProducto::create($request->all());

        return response()->json([
            'mensaje' => 'EL tipo de producto fue creado correctamente.',
            'tipoProducto' => $tipo
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoProducto $tipoProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoProducto $tipoProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoProducto $tipoProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoProducto $tipoProducto)
    {
        //
    }
}
