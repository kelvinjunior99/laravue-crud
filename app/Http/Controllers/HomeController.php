<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Inertia\Inertia;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function home(){

        $dados = Cadastro::paginate(4);

        return Inertia::render("App", compact("dados"));
    }
}
