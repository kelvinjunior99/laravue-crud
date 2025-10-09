<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\Actividade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return inertia('User/UserCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        // Cria o usuário com os dados validados
        $user = User::create([
            'name'     => $request->validated()['name'],
            'email'    => $request->validated()['email'],
            'password' => Hash::make($request->validated()['password']),
        ]);

        // Faz login automático
        Auth::login($user);

        return redirect()->route('livraria')
            ->with('success', 'Conta criada e login efetuado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function profile()
    {
        $user = Auth::user();

        /** $atividades = Activity::with(['causer', 'subject'])  */

        $actividades = Actividade::with(['causer', 'subject'])
        ->latest()
        ->take(10)
        ->get();


        return inertia('User/Perfil', [
            'user' => $user,
            'actividades' => $actividades,
            'totalLivros' => $user->livros()->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
