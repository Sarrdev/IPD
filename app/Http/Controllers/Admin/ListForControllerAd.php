<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListeFormation;
use Illuminate\Http\Request;

class ListForControllerAd extends Controller
{
    
     //Affichage des formations
     public function viewTraining(){
        $trainings = ListeFormation::all();
        return view('admin.displayfor', compact('trainings'));
    }
}
