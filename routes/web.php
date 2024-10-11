<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GestionforController;
use App\Http\Controllers\Admin\ListForControllerAd;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ListeforController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PreinscriptController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//route user
Route::middleware(['auth', 'userMiddleware'])->group(function(){
    //Dashboad préinscription de l'étudiant
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    //affichage du formulaire d'inscription
    Route::get('preinscript', [PreinscriptController::class, 'index'])->name('user.preinscription');
    //enregistrement de la préinscription
    Route::post('preinscript', [PreinscriptController::class, 'inscriptStore'])->name('user.preinscriptionStore');
    //affiche de la vue pour la modification
    Route::get('preinscript/{id}', [UserController::class, 'edit'])->name('user.edit_training');
    //application de la modification
    Route::post('preinscript/{id}', [UserController::class, 'uptadepreinscrip'])->name('user.updatepreinscript');
    //suppression d'une préinscription
    Route::delete('dashboard/{id}', [UserController::class, 'destroy'])->name('user.delete');
    //affichage de la page des formations disponibles pour l'école saisies par l'admin
    Route::get('listeformation', [ListeforController::class, 'index'])->name('user.viewformation');
    //affichage de liste des formations dispo pour l'école
    Route::get('preinscript' , [ListeforController::class, 'trainingAdmin'])->name('user.redirectinscription');
    //Récupération des préinscriptions de l'utilisateur authentifié
    Route::get('comments', [CommentController::class, 'userIndex'])->name('user.comments');
    
    Route::post('preinscript/{id}/comment', [CommentController::class, 'store'])->name('comment.store');

    Route::get('docs', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('docs', [DocumentController::class, 'store'])->name('documents.store');
    //paiyement
    Route::get('paie', [PaiementController::class, 'index'])->name('user.paiement');
});

//route admin
Route::middleware(['auth', 'adminMiddleware'])->group(function(){
    //Dashboard des péinscriptions reçus
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Approuver ou rejeter une préinscription
    Route::post('admin/update-status/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    //liste des formations gérées par l'admin
    Route::get('/admin/admin/displayfor', [ListForControllerAd::class, 'viewTraining'])->name('admin.displayfor');
    //Gestion des formations (ajout)
    Route::get('/admin/admin/gestionsave', [GestionforController::class, 'index'])->name('admin.gestionsave');
    //gestion des formations (save)
    Route::post('/admin/admin/gestionsave', [GestionforController::class, 'storformation'])->name('admin.savetraining');
    //Affichage du formulaire de modification
    Route::get('/admin/admin/editadmin/{id}', [GestionforController::class, 'edit'])->name('admin.edit');
    //Application de la modification
    Route::post('/admin/admin/editamin/{id}', [GestionforController::class, 'updateformation'])->name(('admin.updateTraining'));
    // Suppression d'une formation
    Route::delete('/admin/admin/delete/{id}', [GestionforController::class, 'destroy'])->name('admin.delete');
    //Voir les commentaires
    Route::get('admin/admin/comments', [CommentController::class, 'index'])->name('admin.comments');

    Route::get('admin/admin/documents', [DocumentController::class, 'index'])->name('admin.documents');
    Route::get('admin/admin/documents/{document}', [DocumentController::class, 'show'])->name('admin.documents.show');
    Route::delete('admin/admin/documents/{document}', [DocumentController::class, 'destroy'])->name('admin.documents.destroy');
    // Voir le profil d'une préinscription
    Route::get('admin/admin/profil/{id}', [AdminController::class, 'showProfile'])->name('admin.profil');

});