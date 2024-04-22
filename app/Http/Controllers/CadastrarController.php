<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CadastrarController extends Controller
{
    
    public function cadastrar() {

        return Inertia::render("Components/Cadastrar");
    }

    public function create(Request $request) {

        $dados = $request->all();

        $dados = Cadastro::create($dados);

        //return Inertia::render("Cadastrar")->with('success', 'Sucesso');;
       //return redirect()->route('cadastrar')->with('success', 'Sucesso');
       //return to_route('users.index');
       return Redirect::route('lista');
    }

    public function editar(Cadastro $dados) {

        return Inertia::render("Components/Editar", compact("dados"));
 }

    public function update(Request $request, Cadastro $dados) {

        $item = $request->all();
        $dados->fill($item);
        $dados->save();

        return to_route('lista');
    }
}
