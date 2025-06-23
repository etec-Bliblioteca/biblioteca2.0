<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevistaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('inicio');
})->name('index');

Route::get('/catalogo',[CatalogoController::class,"index"])->name('catalogo');

Route::post('/catalogo/revista',[CatalogoController::class,"show"])->name('catalogoRevista');


Route::get('/catalogo/revista',function(){
    return redirect()->route('catalogo');
});

// Rota para os administradores
Route::get("/admin/home",function(){
    return Inertia::render("Admin");
});

Route::get("/admin/liberacao",function(){
    return Inertia::render("Liberacao");
});

Route::get("/admin/pedidos",function(){
    return Inertia::render("Pedidos");
});

Route::get("/add/revista",function(){
    return Inertia::render("AddRevista");
});

Route::get("/login",function(){
    return Inertia::render("Login");
})->name('login.form');

Route::post("/login",[LoginController::class,'store'])->name('login');


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
