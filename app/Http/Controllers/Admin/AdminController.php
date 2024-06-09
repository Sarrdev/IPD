<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preinscription;
use Illuminate\Http\Request;
 
class AdminController extends Controller
{
    // Afficher toutes les préinscriptions
    public function index()
    {
        $preinscriptions = Preinscription::all();
        return view('admin.dashboard', compact('preinscriptions'));
    }

    // Mettre à jour le statut d'une préinscription
    public function updateStatus(Request $request, $id)
    {
        $preinscription = Preinscription::find($id);
        $preinscription->statut = $request->statut;
        $preinscription->save();

        return redirect()->back()->with('success', 'Le statut a été mis à jour avec succès.');
    }
}
