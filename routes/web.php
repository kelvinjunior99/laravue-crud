<?php

use App\Http\Controllers\CadastrarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('lista', [ListaController::class, 'lista'])->name('lista');


Route::get('cadastrar', [CadastrarController::class, 'cadastrar'])->name('cadastrar');
Route::post('create', [CadastrarController::class, 'create'])->name('create');

Route::get('/cadastro/{dados}/editar', [CadastrarController::class, 'editar'])->name('editar');


Route::put('/update/{dados}', [CadastrarController::class, 'update'])->name('update');