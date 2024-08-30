<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::all();

        if($productos->isEmpty()) {
            return response()->json([
                'mensaje' => 'No existen productos.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'mensaje' => 'Productos encontrados exitosamente.',
            'productos' => $productos
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nombre' => ['string'],
            'descripcion' => ['string'],
            'precio' => ['string'],
            'stock' => ['integer'],
            'estado' => ['string', 'in:activo'],
            'tipoProductoId' => ['integer'],
        ]);

        if($validator->fails()) {
            return response()->json([
                'mensaje' => 'Datos incorrectos',
                'error' => $validator->errors()
            ]);
        }

        try {
            $producto = Producto::create($request->all());

            return response()->json([
                'mensaje' => 'Producto creado correctamente.',
                'producto' => $producto
            ]);
        } catch(Exception $e) {
            Log::error("Error en la base de datos al intentar crear un producto". $e->getMessage());
            return response()->json([
                'mensaje' => 'No se pudo crear el producto',
                'error' => 'Error inesperado, por favor intente de nuevo'
            ]);
        }

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
    public function show(Producto $producto, $id)
    {
        //
            $producto = Producto::find($id);

            if(is_null($producto)) {
                return response()->json([
                    'mensaje' => 'No se encontro el producto',
                ]);
            }

        return response()->json([
            'mensaje' => 'Producto encontrado correctamente',
            'producto' => $producto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'precio' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'estado' => ['required', 'string', 'in:activo'],
            'tipoProductoId' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return response()->json([
                'mensaje' => 'Datos incorrectos',
                'error' => $validator->errors()
            ]);
        }

        try {
            $producto = Producto::find($id);

            $producto->fill($request->all());
            $producto->save();

            return response()->json([
                'mensaje' => 'Producto actualizado',
                'producto' => $producto
            ]);
        } catch(Exception $e) {
            return response()->json([
                'mensaje' => 'No se pudo actualizar el producto',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $producto = Producto::find($id);
            $producto->delete();

            return response()->json([
                'mensaje' => 'Producto eliminado correctamente'
            ], Response::HTTP_NOT_FOUND);
        } catch(Exception $e) {
            return response()->json([
                'mensaje' => 'No se pudo eliminar el elemento'
            ]);
        }
    }
    // public function destroy(Producto $producto)
    // {
    //     //

    // }
}
