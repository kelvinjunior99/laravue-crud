<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListaController extends Controller
{
    
    public function lista() {

      $dados = Cadastro::all();

      return Inertia::render('Components/Lista', compact('dados'));
    }
}
