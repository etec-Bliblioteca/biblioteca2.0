<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PerfilController extends Controller
{
    private $userData;
    public function index(){
        $user = Auth::user();
        if($user){
            $this->userData = ['id'=>$user->id,'rm'=>$user->rm,"name"=>$user->name];

            return Inertia::render('Perfil',['User'=>$this->userData]);
        }

        return Inertia::render('Perfil',['User'=>['id'=>null]]);

    }
}
