<?php

namespace App\Http\Controllers;

use App\Models\ListeFormation;
use Illuminate\Http\Request;

class ListeforController extends Controller
{
    //affichage de la page liste des formations
    public function index(){
        $trainingads = ListeFormation::all();
        return view('listeformation',compact('trainingads'));
    }

    //affichage de la liste des formations saisies par l'admin
    public function trainingAdmin(){
        return view('preinscript');
    }
}
