<?php

namespace App\Http\Controllers;

use App\Models\Revista;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CatalogoController
{
    /**
     * Display a listing of the resource.
     */

    //USUARIO ATUAL
    private $userData;
    public function index()
    {
        //PEGAR USUARIO LOGADO
        $user = Auth::user();
        if($user){
            $this->userData = ['id'=>$user->id,'rm'=>$user->rm,"name"=>$user->name];
        }else{
            $this->userData = ['id'=>null];
        }
        //PEGAR AS REVISTAS
        $collectionRevistas = Revista::latest()->paginate(19);
        // dd($collectionRevistas->toArray());
        return Inertia::render('Catalogo', ['collectionRevista' => $collectionRevistas->toArray(),"User"=>$this->userData]);
    }


    public function show(Request $request)
    {
        // dd($request->idRevista);
        $revista = Revista::find($request->idRevista);
        // dd($revista);
        $dadosPopUp = [
            'imgPopUp' => $revista->imagem,
            'descricaoPopUp' => $revista->descricao,
            'temaPopUp' => $revista->tema,
            'quantPopUp' => $revista->quantidade,
            'tituloPopUp' => $revista->titulo,
        ];
        // dd($dadosPopUp);
        return Inertia::render('Catalogo', ['dadosRevista' => $dadosPopUp]);
    }
}
