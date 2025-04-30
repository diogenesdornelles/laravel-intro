<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TaferasController extends Controller
{
    public function index(): View {
        $tarefas = Tarefa::all();
        return view('tarefas/index', compact('tarefas'));
    }
}
