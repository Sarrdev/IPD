<?php

namespace App\Http\Controllers;

use App\Models\Preinscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreinscriptController extends Controller
{ 
    public function index(){
        return view('preinscript');
    }

    //preinscrition store
    public function inscriptStore(Request $request){
        //valider les données du formulaire
        $validateData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'niveau_etude' => 'required|string|max:255',
            'formation' => 'required|string|max:255',
            'annee_academ' => 'required|string|max:255', 
        ]);
        //ajouter un nouveau préinscription
        $preinscript = new Preinscription();
        $preinscript->nom = $validateData['nom'];
        $preinscript->prenom = $validateData['prenom'];
        $preinscript->adresse = $validateData['adresse'];
        $preinscript->niveau_etude = $validateData['niveau_etude'];
        $preinscript->formation = $validateData['formation'];
        $preinscript->annee_academ = $validateData['annee_academ'];
        $preinscript->statut = 'en attente';
        $preinscript->user_id = Auth::id();

        //sauvegarde des donnees à la BD
        $preinscript->save();

        return view('docs');
        
    }
}
