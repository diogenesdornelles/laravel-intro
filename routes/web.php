<?php

use App\Http\Controllers\MathController;
use App\Http\Controllers\TarefasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return '<p>Olá Mundo</p>';
});

Route::get('/test/view', function () {
    return view('minha-view');
});

Route::get('/test/{valor}', function ($valor) {
    return "<p>Voce enviou: {$valor}</p>";
});

Route::get('/somar/{valor1}/{valor2}', function ($valor1, $valor2) {
    $soma = $valor1 + $valor2;
    return "<p>Soma: {$soma}</p>";
});

Route::get('/subtrair/{valor1}/{valor2}', function ($valor1, $valor2) {
    $sub = $valor1 - $valor2;
    return "<p>Subtração: {$sub}</p>";
});

Route::get('/math/quadrado/{num}', [MathController::class, 'quadrado']);

Route::get('/math/cubo/{num}', [MathController::class, 'cubo']);

// criamos um agrupamento de rotas
Route::prefix('/tarefas')->group(function () {
    Route::get('/', [TarefasController::class, 'index']);
});

