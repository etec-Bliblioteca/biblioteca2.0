<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    //USUARIO ATUAL
    private $userData;
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $this->userData = ['id' => $user->id, 'rm' => $user->rm, "name" => $user->name];

            return Inertia::render('inicio', ['User' => $this->userData]);
        }

        return Inertia::render('inicio', ['User' => ['id' => null]]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //Pegando todos os dados
        $nome = $request->nome;
        $rm = $request->rm;
        $telefone = $request->telefone;
        $turma = $request->turma;
        $ano = $request->ano;
        $periodo = $request->periodo;
        $turmaCompleta =  $ano . " " . $turma . " " . $periodo;
        $email = $request->email;
        $senha = $request->senha;
        // dd($request,$turmaCompleta);

        // VERIFICAR SE RM JÁ EXISTE
        $rmExist = User::where('rm', $rm)->first();
        if ($rmExist) {
            return Inertia::render('Register', ['errorMsg' => 'RM já registrado!']);
        }

        // VERIFICAR SE EMAIL JÁ EXISTE
        $emailExist = User::where('email', $email)->first();
        if ($emailExist) {
            return Inertia::render('Register', ['errorMsg' => 'Email já registrado!']);
        }
        // CRIAR USUARIO INATIVO
        $created = User::create([
            'rm' => $rm,
            'nivel' => 0,
            'state' => 'inativo',
            'name' => $nome,
            'turma' => $turmaCompleta,
            'email' => $email,
            'password' => $senha,
            'telefone' => $telefone,
        ]);

        if ($created) {
            return redirect()->route('login.form');
            return Inertia::render('Register', ['errorMsg' => 'Aguarde a liberação do seu perfil!']);
        }
    }

    // LOGIN DE USUARIO
    public function store(Request $request)
    {
        // dd($request);
        // PEGAR AS CREDENCIAIS
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials['state'] = 'ativo';
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Verifica se é um admin que esta logando
            if (Auth::user()->nivel == 1) {
                return to_route('admin.home'); 
            }
            
            return to_route('index');
        } else {
            return Inertia::render('Login', ['errorMsg' => 'Email ou Senha incorretos, ou usuario inativo']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
