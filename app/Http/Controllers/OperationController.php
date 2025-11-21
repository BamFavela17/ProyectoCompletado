<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperationController extends Controller
{
   public function showForm(Request $request)
    {
        $nombre = session("nombre", "");
        $numero1 = session("numero1", 0);
        $numero2 = session("numero2", 0);

        return view("FormularioOperacion", compact("nombre", "numero1", "numero2"));
    }

    public function calcular(Request $request)
    {
        $nombre = $request->input("nombre");
        $numero1 = (int)$request->input("numero1");
        $numero2 = (int)$request->input("numero2");
        $operacion = $request->input("operacion");
        $resultado = match($operacion)
        {
            "sumar" => $numero1 + $numero2,
            "restar" => $numero1 - $numero2,
            "multiplicar" => $numero1 * $numero2,
            "dividir" => $numero2 !== 0 ? $numero1 / $numero2 : "Error: Division por cero",
            default => "Operacion invalida"
        };

        session([
            "nombre" => $nombre,
            "numero1" => $numero1,
            "numero2" => $numero2,
            "operacion" => $operacion,
            "resultado" => $resultado

        ]);

           return redirect("/operacion/resultado");
    }

    public function showResult(Request $request)
    {
        $nombre = session("nombre");
        $numero1 = session("numero1");
        $numero2 = session("numero2");
        $operacion = session("operacion");
        $resultado = session("resultado");

        return view("ResultadoOperacion", compact("nombre", "numero1", "numero2", "operacion", "resultado"));
    }
}
