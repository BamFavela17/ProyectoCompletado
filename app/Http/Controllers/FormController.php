<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function showForm(Request $request)
    {
        $texto = session('texto');
        return view('form', compact('texto'));
    }

    public function storeText(Request $request)
    {
        $texto = $request->input('texto');
        if ($texto) {
            session(['texto' => $texto]);
        }
        return redirect('/formulario');
    }
}
