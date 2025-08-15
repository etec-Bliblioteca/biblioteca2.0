<?php

namespace App\Http\Controllers\Auth;

use App\Events\newAgend;
use App\Events\newUser;
use App\Http\Controllers\Controller;
use App\Models\Revista;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class LoginController extends Controller
{
    //USUARIO ATUAL
    private $userData;

    // CONTROLLER PARA O INDEX
    public function index()
    {
        // PEGAR OS DADOS DO USER
        // PEGAR OS DADOS DAS REVISTAS NOVAS
        $revistas = DB::table('revistas')->select('imagem')->orderBy('id', 'desc')->limit(5)->get();
        $eventos = DB::table('eventos')->select('imagem')->orderBy('id', 'desc')->limit(5)->get();
        $user = Auth::user();
        if ($user) {
            $this->userData = ['id' => $user->id, 'rm' => $user->rm, "name" => $user->name];

            return Inertia::render('inicio', ['User' => $this->userData, 'Revistas' => $revistas, 'Eventos' => $eventos]);
        }


        return Inertia::render('inicio', ['User' => ['id' => null], 'Revistas' => $revistas, 'Eventos' => $eventos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
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
                broadcast(new newUser($created));
                return redirect()->route('login.form');
            }
        } catch (\Throwable $th) {
            return Inertia::render('Register', ['errorMsg' => ' Verifique se os dados estão corretos!']);
        }
    }

    // LOGIN DE USUARIO
    public function store(Request $request)
    {
        try {
            // PEGAR AS CREDENCIAIS
            $credentials = $request->validate([
                'rm' => ['required', 'numeric'],
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
        } catch (\Throwable $th) {
                return Inertia::render('Login', ['errorMsg' => 'Valores Inválidos!']);
        }
    }


    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }

    public function reset(Request $request){
        $request->validate([
            'email' => ['required', 'email',],
            'password' => ['required']
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
    
            return redirect()->route('login')->with(['msg' => [
                'icon' => 'success',
                'title' => 'Senha alterada!',
                'text' => "Seha alterada com sucesso!",
            ]]);
        }
        return redirect()->route('login')->with(['msg' => [
            'icon' => 'error',
            'title' => 'Email não encontrado!',
            'text' => "Verifique se os dados estão corretos",
        ]]);
    }
}
