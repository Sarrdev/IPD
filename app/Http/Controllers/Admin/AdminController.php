<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\ListeFormation;
use App\Models\Preinscription;
use App\Models\User;
use Illuminate\Http\Request;
 
class AdminController extends Controller
{
    // Afficher toutes les préinscriptions
    public function index(Request $request)
{
    $query = Preinscription::query();

    // Filtrage par statut
    if ($request->filled('filter_statut')) {
        $query->where('statut', $request->filter_statut);
    }

    // Filtrage par formation
    if ($request->filled('filter_formation')) {
        $query->where('formation', $request->filter_formation);
    }

    // Appliquer la pagination à la requête filtrée
    $preinscriptions = $query->paginate(5);

    // Compter le nombre total d'étudiants inscrits (sans filtrer)
    $totalStudents = Preinscription::count();

    $trainings = ListeFormation::all();

    return view('admin.dashboard', compact('preinscriptions', 'totalStudents', 'trainings'));
}

    // Mettre à jour le statut d'une préinscription
    public function updateStatus(Request $request, $id)
    {
        $preinscription = Preinscription::find($id);
        $preinscription->statut = $request->statut;
        $preinscription->save();

        return redirect()->back()->with('success', 'Le statut a été mis à jour avec succès.');
    }


    public function showProfile($id)
    {
        $preinscription = Preinscription::findOrFail($id);
        // $docs = Document::findOrFail($id);
        $user = User::findOrFail($preinscription->user_id); // Récupération des détails de l'utilisateur
        $documents = Document::where('user_id', $preinscription->user_id)->get();
        return view('admin.profil', compact('preinscription', 'user', 'documents'));
    }
}
