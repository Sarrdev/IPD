<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeFormation extends Model
{
    use HasFactory;

   protected $fillable = ["nomfiliere", "parcours", "cout", "coutm"];
}
