<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Revista;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgendamentoController extends Controller
{

    // função para reservar as revistas
    public function reservar($idRevista, $idUser)
    {

        // VERIFICA SE EXISTE UM USUARIO
        $user = User::find($idUser);
        if (!$user) {
            // retorna erro
            return response()->json(['error' => 'Usuario não encontrado'], 400);
        }
        // procura ela no banco
        $revista = Revista::findOrFail($idRevista);
        // VERIFICA SE AS DUAS CONDIÇÔES SAO TRUE
        if ($revista && $user) {

            // Vê se ainda tem resvistas para ser reservadas
            if ($revista->quantidade <= 0) {
                // retorna erro
                return response()->json(['error' => 'Sem exemplares disponíveis'], 400);
            }

            // PREPARA OS DADOS PARA AGENDAR
            $dtHoje = date("Y/m/d");
            $dtPegar = date("Y/m/d", strtotime($dtHoje . "+ 2 day"));
            $dtDevolver = date("Y/m/d", strtotime($dtPegar . "+ 1 week"));

            $agendado = Agendamento::create([
                'rm' => $user->rm,
                'id_revista' => $idRevista,
                'dt_pegar' => $dtPegar,
                'dt_devolver' => $dtDevolver
            ]);


            if ($agendado) {
                // Se tiver, ele retirar uma e salva
                $revista->quantidade -= 1;
                $revista->save();
                // retorna a resposta para a página
                return response()->json(['novaQuantidade' => $revista->quantidade]);
            }

            return;
        }
    }

    //MOSTRAR OS AGENDAMENTOS PARA SEREM CONFIRMADOS
    public function show(Agendamento $agendamento)
    {
        // PEGA TODOS OS DADOS NECESSARIOS
        $agendamentos = DB::table('agendamentos')
        ->join('users', 'agendamentos.rm', '=', 'users.rm')
        ->join('revistas', 'agendamentos.id_revista', '=', 'revistas.id')
        ->where('agendamentos.state', false)
        ->select(
            'agendamentos.id',
            'users.name',
            'users.rm',
            'revistas.titulo',
            'users.turma',
            'agendamentos.dt_pegar',
            'revistas.imagem'
        )
        ->limit(10)
        ->get();
        
        return Inertia::render('Pedidos',['Agendamentos'=>$agendamentos->toArray()]);
    }

    // ACEITAR O AGENDAMENTO
    public function accept(Request $request){

        $agendamento = Agendamento::find($request->idAgendamento);

        $agendamento->state = true;
        $agendamento->save();
        return redirect()->route('admin.pedidos');
    }

    // RECUSAR O AGENDAMENTO
    public function recuse(Request $request){

        $agendamento = Agendamento::find($request->idAgendamento);
        $revista = Revista::find($agendamento->id_revista);
        $revista->quantidade += 1;
        $revista->save();
        $agendamento->delete();
        return redirect()->route('admin.pedidos');
    }

}
