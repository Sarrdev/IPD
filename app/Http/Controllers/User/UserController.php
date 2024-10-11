<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Preinscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Afichage du préinscription effectué par l'utilisateur simple
    public function index(){
        $user = Auth::user();
        $preinscriptions = Preinscription::where('user_id', $user->id)->get();
        return view('dashboard', compact('preinscriptions'));
    }
    
    //afficher la vue editadmin qui contient le formulaire de modification
    public function edit($id){
       $preinscriptions = Preinscription::find($id);
    
        // if (!$preinscriptions) {
        //     return redirect()->back()->with('error', 'Préinscription non trouvée');
        // }
        
        return view('edit_training', ['preinscription' => $preinscriptions]);
    }
    
    //Logique pour la modification d'une formation
    public function uptadepreinscrip(Request $request, $id){
        $preinscriptions = Preinscription::find($id);
        $preinscriptions->nom = $request->nom;
        $preinscriptions->prenom = $request->prenom;
        $preinscriptions->adresse = $request->adresse;
        $preinscriptions->niveau_etude = $request->niveau_etude;
        $preinscriptions->formation = $request->formation;
        $preinscriptions->annee_academ = $request->annee_academ;
        //sauvegarde de la mise à jour
        $preinscriptions->update();

        return back()->with('success', 'la préinscription a été modifié avec succès!');
    }

     //Logique pour la suppression d'une formation
     public function destroy($id){
        $preinscriptions = Preinscription::findOrFail($id);
        $preinscriptions->delete();
    
        return back()->with('success', 'Votre préinscription a été bien supprimé!');
    }
}
