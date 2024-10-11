<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listeformation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GestionforController extends Controller
{
    

    //Affichage du formulaire save training
    public function index(){
        return view('admin.gestionsave');
    }

    //enregistrement et traitement du formulaire
    public function storformation(Request $request){
        //valider les données du formulaire
        $validateData = $request->validate([
            'nomfiliere' => 'required|string|max:255',
            'parcours' => 'required|string|max:255',
            'cout' => 'required|string|max:255',
            'coutm' => 'required|string|max:255',
        ]);
        //ajouter un nouveau préinscription
        $savedata = new Listeformation();
        $savedata->nomfiliere = $validateData['nomfiliere'];
        $savedata->parcours = $validateData['parcours'];
        $savedata->cout = $validateData['cout'];
        $savedata->coutm = $validateData['coutm'];

        //sauvegarde des données
        $savedata->save();

        return back()->with('success', 'une nouvelle formation a été enregistrer avec succès!');
    }
    //afficher la vue editadmin qui contient le formulaire de modification
    public function edit($id){
        $formations = Listeformation::find($id);
        return view('admin.editadmin', ['formation' => $formations]);
    }
    //logique de modification du d'un formation
    public function updateformation(Request $request, $id){
        $formations = Listeformation::find($id);
        $formations->nomfiliere = $request->nomfiliere;
        $formations->parcours = $request->parcours;
        $formations->cout = $request->cout;
        $formations->coutm = $request->coutm;
        //sauvegarde de la mise à jour
        $formations->update();

        return back()->with('success', 'la formation a été modifier avec succès!');
        
    }
    //Logique pour la suppression d'une formation
    public function destroy($id)
    {
   
        $formation = Listeformation::findOrFail($id);
        $formation->delete();
        return back()->with('success', 'la formation a été modifier avec succès!');
    }

}
