<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;

class MathController extends Controller

{
    public function quadrado($num): View {
        $resultado = $num ** 2;
        $op = 'Quadrado';
        // pode utilizar o compact ou array
        return view('math', [
            'resultado' => $resultado,
            'op' => $op,
        ]);
    }

    public function cubo($num): View {
        $resultado = $num ** 3;
        $op = 'Cubo';
        // compact
        return view('math', compact('resultado', 'op'));
    }
}
