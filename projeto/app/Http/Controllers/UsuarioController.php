<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    
    public function home() {

        return Inertia::render("App");
    }

    public function lista() {

        return Inertia::render("Components/Lista");
        //return to_route('users.index');
    }

    public function Cadastrar() {

        return Inertia::render("Components/Cadastrar");
    }
}
