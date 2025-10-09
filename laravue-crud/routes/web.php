<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', [HomeController::class, 'laravue'])->name('laravue');


Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/user/create', [UserController::class, 'create'])
        ->name('user.create');

    Route::post('/user', [UserController::class, 'store'])
        ->name('users.store');
});


Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/livraria', [HomeController::class, 'livraria'])->name('livraria');

    Route::get('/livro/create', [LivroController::class, 'create'])->name('livros.create');
    Route::post('/livro', [LivroController::class, 'store'])->name('livros.store');

    Route::get('/livros', [LivroController::class, 'index'])->name('livro.lista');

    Route::get('/livro/{livro}/edit', [LivroController::class, 'edit'])->name('livros.edit');
    Route::put('/livro/{livro}', [LivroController::class, 'update'])->name('livro.update');
    Route::delete('/livro/{livro}', [LivroController::class, 'destroy'])->name('livro.destroy');

   //Route::get('/livros/search', [LivroController::class, 'search'])->name('livros.search');

    Route::get('livro/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('livro/user/{user}', [UserController::class, 'update'])->name('user.update');

});
