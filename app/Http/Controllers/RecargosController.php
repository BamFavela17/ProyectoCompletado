<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecargosController extends Controller
{
    //
    public function setFine($porcentaje)
    {
        $porcentaje2 = $porcentaje / 100;
        session(["porcentaje" => $porcentaje2]);

        return "El porcentaje del impuesto {$porcentaje}% ha sido guardado";
    }

    public function getFine(string $tipoOperacion, float $valorOperacion)
    {
        $porcentaje = session("porcentaje");

        $applySurcharge = function ($surcharge) use ($porcentaje): float {
            return $surcharge + ($surcharge * $porcentaje);
        };
        $applyDiscount = function ($discount) use ($porcentaje): float {
            return $discount - ($discount * $porcentaje);
        };

        $calculateFine = function ($value) use ($porcentaje, $applySurcharge, $applyDiscount, $tipoOperacion) {
            $functionName = "apply" . ucfirst($tipoOperacion);
            return $$functionName($value);
        };

        $result = $calculateFine($valorOperacion);
        $resultado = round($result, 2);

        return view("RecargosVista", [
            "tipoOperacion" => $tipoOperacion,
            "valorOperacion" => $valorOperacion,
            "porcentaje" => $porcentaje * 100,
            "resultado" => $resultado
        ]);
    }
}
