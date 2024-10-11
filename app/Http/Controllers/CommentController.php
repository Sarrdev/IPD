<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Preinscription;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'preinscription'])->get();
        return view('admin.comments', compact('comments'));
    }

    public function userIndex()
    {
        $preinscriptions = Preinscription::where('user_id', auth()->id())->get();
        return view('comments', compact('preinscriptions'));
    }

    public function store(Request $request, $preinscriptionId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'preinscription_id' => $preinscriptionId,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Votre commentaire a été ajouté avec succès.');
    }
}
