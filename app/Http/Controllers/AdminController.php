<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Revista;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{

    public $agdVencidos = [];
    public $agdAtual = [];
    // PAGINA INICIAL DO ADMIN
    public function index(Request $request){
        // Pegando os dados que quero
        $usersCount = User::count();
        $revistasCount = Revista::count();
        $dataInfo = ['revistas' => $revistasCount, 'users' => $usersCount];

        $dtHoje = strtotime(date("Y/m/d"));
         // PEGA TODOS OS DADOS NECESSARIOS
         $agendamentos = DB::table('agendamentos')
         ->join('users', 'agendamentos.rm', '=', 'users.rm')
         ->join('revistas', 'agendamentos.id_revista', '=', 'revistas.id')
         ->where('agendamentos.state', true)
         ->select(
             'agendamentos.id',
             'users.name',
             'users.rm',
             'revistas.titulo',
             'users.turma',
             'agendamentos.dt_devolver',
             'revistas.imagem',
             'users.telefone'
         )
         ->limit(10)
         ->get();
         
        // date("d/m/Y" ,strtotime($dtDevolver))
        foreach($agendamentos as $agd){            
            $dtAgdDevolver = strtotime($agd->dt_devolver);
            // dd($dtAgdDevolver,$dtHoje);
            if($dtHoje <= $dtAgdDevolver){
                $this->agdAtual[] = $agd;
            }else{
                $this->agdVencidos[] = $agd;
            }
        }

        return Inertia::render('Admin',['DataInfo' => $dataInfo,"AgdAtuais" => $this->agdAtual,"AgdVencidos" => $this->agdVencidos,]);
    }

    // PAGINA DE LIBERAÇÂO
    public function lib(Request $request){
        if($request->action){
            if($request->action == 'lib'){
                $save = User::where('rm', $request->rm)
                ->update(['state' => 'ativo']);
                if($save){
                    return redirect()->route('lib.index');
                }
            }else{
                User::where('rm', $request->rm)
                ->delete();
            }
        };
        $users = User::where('state','inativo')->get();
        return Inertia::render("Liberacao",['UsersInativos'=>$users->toArray()]);
    }

}
