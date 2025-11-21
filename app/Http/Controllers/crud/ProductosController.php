<?php

namespace App\Http\Controllers\crud;

use App\Http\Controllers\Controller;
use App\Models\crud\productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:usuarios');
    }

    public function read()
    {
        $productos = Productos::all();
        //dd($productos);
        return view('CRUD.Mostrar', compact('productos'));
    }

    public function create()
    {
        // $password = Hash::make('123');
        // dd($password);
        return view('CRUD.Crear');
    }

    public function update(Request $request, Productos $producto)
    {
        //validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string|max:500',
        ]);
        
        // Actualizar con los nombres correctos de columnas

        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
        ]);

        // $producto->Nombre = $request->nombre;
        // $producto->Precio = $request->precio;
        // $producto->Descripcion = $request->descripcion;
        // $producto->save();

        return redirect()->back()->with('success', 'Producto actualizado exitosamente!.');
    }

    public function almacen(Request $request)
    {
        //validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string|max:500',
        ]);

        // guardar los datos en la base de datos
        $producto = new Productos();
        $producto->Nombre = $request->nombre;
        $producto->Precio = $request->precio;
        $producto->Descripcion = $request->descripcion;

        $producto->save();

        return redirect()->back()->with('success', 'Producto creado exitosamente!.');
    }

    public function destroy(Productos $producto)
    {
        $producto->delete();
        return redirect()->route('productos.mostrar')->with('success', 'Producto eliminado exitosamente!.');
    }
}