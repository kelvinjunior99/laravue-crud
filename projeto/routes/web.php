<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UsuarioController::class, 'home'])->name('home');

Route::get('/lista', [UsuarioController::class, 'lista'])->name('lista');
