<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevistaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LoginController::class,"index"])->name('index');

Route::get('/catalogo',[CatalogoController::class,"index"])->name('catalogo');

Route::post('/catalogo/revista',[CatalogoController::class,"show"])->name('catalogoRevista');


Route::get('/catalogo/revista',function(){
    return redirect()->route('catalogo');
});


Route::get("/perfil",function(){
    return Inertia::render("Perfil");
})->name('perfil');

// Rota para os administradores
Route::group(['prefix' => 'admin'],function(){
    Route::get("/home",function(){
        return Inertia::render("Admin");
    });

    Route::get("/liberacao",[AdminController::class,'lib'])->name('lib.index');

    
    Route::post("/liberacao",[AdminController::class,'lib'])->name('lib.user');

    Route::get("/pedidos",function(){
        return Inertia::render("Pedidos");
    });

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


