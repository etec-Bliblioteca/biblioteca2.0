<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    // PAGINA INICIAL DO ADMIn
    public function index(Request $request){

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
