<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscription extends Model
{
    use HasFactory;

    // Définir la table associée au modèle
    protected $table = 'preinscriptions';

    // Définir les attributs pouvant être assignés en masse
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'niveau_etude',
        'formation',
        'annee_academ',
        'statut',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
