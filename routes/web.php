<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RevistaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Agendamento;

Route::get('/', [LoginController::class, "index"])->name('index');

Route::get('/catalogo', [CatalogoController::class, "index"])->name('catalogo');

Route::post('/catalogo/revista', [CatalogoController::class, "show"])->name('catalogoRevista');

Route::post('/revistas/{idRevista}/{userId}/reservar', [AgendamentoController::class, 'reservar']);

Route::get('/catalogo/{titulo}/pesquisar', [RevistaController::class, 'pesquisar']);


Route::get('/catalogo/revista', function () {
    return redirect()->route('catalogo');
});


Route::get("/perfil", [PerfilController::class, 'index'])->name('perfil');

// Rota para os administradores
Route::middleware(AdminMiddleware::class)->prefix('admin')->group(function () {

    // PAGINA INICIAL DO ADMIN
    Route::get("/home", [AdminController::class, 'index'])->name('admin.home');

    Route::delete("/home/agdCheck", [AgendamentoController::class, 'check'])->name('agd.check');

    Route::post("/home/adiar", [AgendamentoController::class, 'adiar'])->name('admin.adiar');

    // PAGINA DE LIBERAÇÃO
    Route::get("/liberacao", [AdminController::class, 'lib'])->name('lib.index');

    Route::post("/liberacao", [AdminController::class, 'lib'])->name('lib.user');

    // PAGINA DE PEDIDOS
    Route::get("/pedidos", [AgendamentoController::class, 'show'])->name('admin.pedidos');

    Route::post("/pedidos/accept", [AgendamentoController::class, 'accept']);

    Route::post("/pedidos/recuse", [AgendamentoController::class, 'recuse']);

    // PEGAR TODAS AS REVISTAS
    Route::get("/revistas", [RevistaController::class, 'index'])->name("admin.revistas");

    // DELETAR UMA REVISTA
    Route::delete("/revistas", [RevistaController::class, 'destroy']);

    // ADICIONAR UMA REVISTA
    Route::post("/revistas", [RevistaController::class, 'create']);

    // ATUALIZAR REVISTA
    Route::post("/revistas/update", [RevistaController::class, 'update']);

    // PEGAR TODOS OS USUARIOS
    Route::get("/users", [UsersController::class, 'index'])->name("admin.users");

    Route::put("/users", [UsersController::class, 'create'])->name("admin.userAdd");

    Route::post("/users/edit", [UsersController::class, 'update'])->name("admin.userEdit");

    Route::delete("/users", [UsersController::class, 'delete'])->name("admin.userDelete");
});

Route::get("/login", function () {
    return Inertia::render("Login");
})->name('login.form');

Route::post("/login", [LoginController::class, 'store'])->name('login');

Route::get("/register", function () {
    return Inertia::render("Register");
})->name('register.form');

Route::post("/register", [LoginController::class, 'create'])->name('login.register');

Route::get("/logoff", [LoginController::class, 'destroy'])->name('login.logoff');
