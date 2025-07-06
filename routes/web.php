<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RevistaController;
use App\Models\Revista;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Middleware\AdminMiddleware;
use App\Models\Agendamento;

Route::get('/', [LoginController::class,"index"])->name('index');

Route::get('/catalogo',[CatalogoController::class,"index"])->name('catalogo');

Route::post('/catalogo/revista',[CatalogoController::class,"show"])->name('catalogoRevista');

Route::post('/revistas/{idRevista}/{userId}/reservar', [AgendamentoController::class, 'reservar']);


Route::get('/catalogo/revista',function(){
    return redirect()->route('catalogo');
});


Route::get("/perfil",[PerfilController::class,'index'])->name('perfil');

// Rota para os administradores
Route::middleware(AdminMiddleware::class)->prefix('admin')->group(function () {
    Route::get("/home",function(){
        return Inertia::render("Admin");
    })->name('admin.home');

    Route::get("/liberacao",[AdminController::class,'lib'])->name('lib.index');

    
    Route::post("/liberacao",[AdminController::class,'lib'])->name('lib.user');

    Route::get("/pedidos",[AgendamentoController::class,'show'])->name('admin.pedidos');

    Route::post("/pedidos/accept",[AgendamentoController::class,'accept']);
    Route::post("/pedidos/recuse",[AgendamentoController::class,'recuse']);

    Route::get("/add/revista",function(){
        return Inertia::render("AddRevista");
    });
});

Route::get("/login",function(){
    return Inertia::render("Login");
})->name('login.form');

Route::post("/login",[LoginController::class,'store'])->name('login');

Route::get("/register",function(){
    return Inertia::render("Register");
})->name('register.form');

Route::post("/register",[LoginController::class,'create'])->name('login.register');

Route::get("/logoff",[LoginController::class,'destroy'])->name('login.logoff');


