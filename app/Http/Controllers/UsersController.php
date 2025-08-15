<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session as FacadesSession;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use Throwable;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return Inertia::render('Usuarios', ['Users' => $users]);
    }

    public function create(Request $request)
    {
        // dd($request);
        $nome = $request->nome;
        $rm = $request->rm;
        $telefone = $request->telefone;
        $turma = $request->turma;
        $email = $request->email;
        $nivel = $request->nivel;


        // CRIANDO A SENHA
        date_default_timezone_set('America/Sao_Paulo');
        $hora = date("H");
        $min = date('i');
        $rmAno = str_split($rm, 2)[0];
        $senhaTemp = "$min$rmAno$hora";

        // VERIFICAR SE RM JÁ EXISTE
        $rmExist = User::where('rm', $rm)->first();
        if ($rmExist) {
            echo "ddada";
        }

        // VERIFICAR SE EMAIL JÁ EXISTE
        $emailExist = User::where('email', $email)->first();
        if ($emailExist) {
            echo "ddada";
        }

        $created = User::create([
            'rm' => $rm,
            'nivel' => $nivel,
            'state' => 'ativo',
            'name' => $nome,
            'turma' => $turma,
            'email' => $email,
            'telefone' => $telefone,
            'password' => $senhaTemp,
        ]);

        if ($created) {
            return redirect()->route('admin.users')->with(['msg' => [
                'icon' => 'success',
                'title' => 'Aluno cadastrado com sucesso!',
                'text' => "Aluno cadastrado!. Senha temporária: $senhaTemp",
            ]]);
        }
    }

    public function update(Request $request)
    {
        if ($request->id != null) {
            $user = User::find($request->id);
            $nome = $request->nome;
            $rm = $request->rm;
            $telefone = $request->telefone;
            $turma = $request->turma;
            $email = $request->email;
            $nivel = $request->nivel;

            $user->name = $nome;
            $user->rm = $rm;
            $user->telefone = $telefone;
            $user->turma = $turma;
            $user->email = $email;
            $user->nivel = $nivel;

            $user->save();
            return redirect()->route('admin.users')->with(['msg' => [
                'icon' => 'success',
                'title' => 'Atualizado!',
                'text' => "Usuário atualizado!",
            ]]);
        }
        return redirect()->route('admin.users');
    }

    public function delete(Request $request){
        $user = User::find($request->id);
        try {
            $user->delete();
            return redirect()->route('admin.users')->with(['msg' => [
                'icon' => 'success',
                'title' => 'Deletado!',
                'text' => "Usuário deletado!",
            ]]);
        } catch (Throwable $error) {
            return redirect()->route('admin.users')->with(['msg' => [
                'icon' => 'error',
                'title' => 'Algo deu errado!',
                'text' => "Verifique se o usuário pode ser mesmo deletado",
            ]]);
        }
    }

       
    public function pesquisarAdmin($valor,$campo)
    {

        
        $users = User::select()->where($campo,'LIKE', $valor.'%')->limit(10)->get();
        return response()->json(['revistas'=>$users->toArray()]);
    }
}
