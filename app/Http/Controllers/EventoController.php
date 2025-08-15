<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventoController extends Controller
{
    public function index(){
        $eventos = Evento::latest()->Paginate(10);
        return Inertia::render('Eventos',['CollectionEventos'=>$eventos]);
    }

    public function create(Request $request){
        if ($request->file('file')) {
            $path = $request->file('file')->store('images/evento', 'public');
            $filename = basename($path);
        }

        try {
            $evento = new Evento();
            $evento->imagem = $filename;
            $evento->save();

            return redirect()->route('admin.eventos')->with(['msg' => [
                'icon' => 'success',
                'title' => 'Evento adiciona!',
                'text' => "evento adicionado com sucesso!",
            ]]);
        } catch (\Throwable $th) {
            return redirect()->route('admin.evento')->with(['msg' => [
                'icon' => 'error',
                'title' => 'Algo deu errado!',
                'text' => "Tente novamente!",
            ]]);
        }  
    }

    
    public function delete(Request $request){
        if ($request->file('file')) {
            $path = $request->file('file')->store('images/evento', 'public');
            $filename = basename($path);
        }

        try {
            $evento = Evento::find($request->id);
            $evento->delete();

            return redirect()->route('admin.eventos')->with(['msg' => [
                'icon' => 'success',
                'title' => 'Evento deletado!',
                'text' => "evento foi deletado!",
            ]]);
        } catch (\Throwable $th) {
            return redirect()->route('admin.evento')->with(['msg' => [
                'icon' => 'error',
                'title' => 'Algo deu errado!',
                'text' => "Tente novamente",
            ]]);
        }  
    }


    
}
