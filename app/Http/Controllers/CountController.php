<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountController extends Controller
{
    public function showForm(Request $request){
        $count = session('count', 0);

        return view('contadorform', compact('count'));
    }

    public function añadir(Request $request){
        $count = session('count', 0);
        $count++;
        session(["count" => $count]);

        return redirect('/session/count');
    }

    public function quitar(Request $request){
        $count = session('count', 0);
        $count--;
        session(["count" => $count]);

        return redirect('/session/count');
    }
}
