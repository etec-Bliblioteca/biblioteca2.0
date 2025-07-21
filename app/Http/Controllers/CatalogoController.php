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
        $collectionRevistas = Revista::select('id', 'imagem')->limit(10)->get();
        // dd($collectionRevistas->toArray());


        return Inertia::render('Catalogo', ['collectionRevista' => $collectionRevistas->toArray(),"User"=>$this->userData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
    public function destroy(string $id)
    {
        //
    }
}
