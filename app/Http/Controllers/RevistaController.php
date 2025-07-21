<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use File;
use Illuminate\Support\Facades\File as FacadesFile;

class RevistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $revistas = Revista::latest()->Paginate(20);
        return Inertia::render('Revistas', ['Revistas' => $revistas]);
    }

    // CRIAR UMA REVISTA
    public function create(Request $request)
    {
        if ($request->file('file')) {
            $path = $request->file('file')->store('images', 'public');
            $filename = basename($path);
        } else {
            $filename = 'semImagem.jpg';
        }
        // dd($request);
        // CRIANDO A REVISTA
        $revista = new Revista();
        $revista->titulo = $request->titulo;
        $revista->descricao = $request->descricao;
        $revista->tema = $request->tema;
        $revista->quantidade = $request->quantidade;
        $revista->issn = $request->issn;
        $revista->edicao = $request->edicao;
        $revista->imagem = $filename;

        $revista->save();

        return redirect()->route('admin.revistas');
    }

    public function update(Request $request)
    {
        $revista = Revista::find($request->id);
        $filename = $revista->imagem;
        // dd($revista);
        if ($request->file('file')) {
            // SE FOR DIFERENTE DA IMAGEM PADRÃO
            if ($revista->imagem != 'semImagem.jpg') {
                Storage::delete($revista->imagem);
            }

            $path = $request->file('file')->store('images', 'public');
            $filename = basename($path);
        }

        // ATUALIZAR COM OS DADOS RECEBIDOS
        $revista->titulo = $request->titulo;
        $revista->descricao = $request->descricao;
        $revista->tema = $request->tema;
        $revista->quantidade = $request->quantidade;
        $revista->issn = $request->issn;
        $revista->edicao = $request->edicao;
        $revista->imagem = $filename;

        $revista->save();

        return redirect()->route('admin.revistas');
    }

    // REMOVER REVISTAS
    public function destroy(Request $request)
    {
        $revista = Revista::find($request->idRevista);
        $temAgendamento = Agendamento::where('id_revista', $request->idRevista)->get()->count();
        if ($temAgendamento == 0) {
            // dd($revista->imagem);
            if ($revista->imagem != 'semImagem.jpg') {
                Storage::disk('public')->delete("images/{$revista->imagem}");
            }
            $revista->delete();
        }
    }
}
