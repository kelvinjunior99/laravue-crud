<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Models\Actividade;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        /** @var User $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        $query = $user->livros()->with('user')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('titulo', 'like', "%{$search}%")
                ->orWhere('autor', 'like', "%{$search}%");
        }

        $livros = $query->paginate(5)->withQueryString();

        return Inertia('Livros/LivroLista', [
            'livros' => $livros,
            'filters' => $request->only('search'),
            // passa o filtro atual pro Vue
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia('Livros/LivroCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivroRequest $request)
    {
        /** @var User $user */

        try {
            $user = \Illuminate\Support\Facades\Auth::user();
            $livro = $user->livros()->create($request->validated());

            Actividade::create([
                'user_id' => $user->id,
                'action' => 'Cadastrou um novo livro',
                'tipo' => 'cadastrou_livro',
                'subject_type' => Livro::class,
                'subject_id' => $livro->id,
            ]);

            return redirect()->route('livros.create')
                ->with('success', 'Livro cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'mensagem' => 'Erro ao salvar o livro',
                ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Livro $livro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livro $livro)
    {

        return Inertia('Livros/LivroEdit', [
            'livros' => $livro,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLivroRequest $request, Livro $livro)
    {

        try {
            $livro->fill($request->validated())->save();

            return back()->with('success', 'Livro alterado com sucesso!');
        } catch (\Exception $e) {


            return back()->with('error', 'Não foi possível alterar o livro. Tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livro $livro)
    {
        try {
            $livro->delete();

            return redirect()->route('livros.index')
                ->with('success', 'Livro excluído com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Não foi possível excluir o livro. Tente novamente.');
        }
    }

    public function search(Request $request)
    {
        $termo = $request->get('q');

        $livros = Livro::where('titulo', 'like', '%' . $termo . '%')
            ->orderBy('titulo')
            ->limit(5) // retorna só os 5 primeiros
            ->get(['id', 'titulo']);

        return response()->json($livros);
    }
}
