<?php

namespace App\Http\Controllers;

use App\Models\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

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
    public function show(Revista $revista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revista $revista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revista $revista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revista $revista)
    {
        //
    }

    // função para reservar as revistas
    public function reservar($id)
    {
        // procura ela no banco
        $revista = Revista::findOrFail($id);

        // Vê se ainda tem resvistas para ser reservadas
        if ($revista->quantidade <= 0) {
            // retorna erro
            return response()->json(['error' => 'Sem exemplares disponíveis'], 400);
        }

        // Se tiver, ele retirar uma e salva
        $revista->quantidade -= 1;
        $revista->save();

        // retorna a resposta para a página
        return response()->json(['novaQuantidade' => $revista->quantidade]);
    }

    public function pesquisar($titulo)

    {
        $revistas = Revista::select('imagem','id')->where('titulo','LIKE', $titulo.'%')->limit(10)->get();

        if ($revistas->isEmpty()) {
            // retorna erro
            return response()->json(['error' => 'Nenhuma revista com esse titulo encontrada'], 400);
        }

        return response()->json(['revistas'=>$revistas->toArray()]);
    }
}
