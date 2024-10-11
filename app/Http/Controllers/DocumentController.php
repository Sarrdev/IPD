<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function create()
    {
        return view('docs');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'level' => 'required|string',
            'documents.*' => 'file|mimes:pdf,jpg,jpeg,png',
        ]);

        $user = Auth::user();
        $level = $request->input('level');

        // Vérifiez si le champ documents est présent et contient des fichiers
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $name => $file) {
                // Ajouter un dd pour voir les détails du fichier
              

                try {
                    // Générer un nom de fichier unique
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('documents', $fileName);

                    // Créer une nouvelle instance du modèle Document
                    $document = new Document();
                    $document->user_id = $user->id;
                    $document->level = $level;
                    $document->document_name = $name;
                    $document->document_path = $path;
                    
                    // Sauvegarder le document dans la base de données
                    $document->save();

                    // Logging for debugging
                    Log::info('Document uploaded successfully.', [
                        'user_id' => $user->id,
                        'level' => $level,
                        'document_name' => $name,
                        'document_path' => $path,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error uploading document: ' . $e->getMessage(), [
                        'user_id' => $user->id,
                        'level' => $level,
                        'document_name' => $name,
                    ]);
                    return back()->withErrors(['documents' => 'Erreur lors de l\'upload du fichier.']);
                }
            }
        } else {
            return back()->withErrors(['documents' => 'Aucun fichier téléchargé.']);
        }

        return back()->with('success', 'Votre document a été envoyé avec succès.');
    }

    public function index()
    {
        $documents = Document::all();
        return view('admin.documents', compact('documents'));
    }

    public function show(Document $document)
    {
        return Storage::download($document->document_path);
    }

    public function destroy(Document $document)
    {
        try {
            Storage::delete($document->document_path);
            $document->delete();
            return redirect()->route('admin.documents')
                             ->with('success', 'Document supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error('Error deleting document: ' . $e->getMessage(), [
                'document_id' => $document->id,
            ]);
            return back()->withErrors(['documents' => 'Erreur lors de la suppression du fichier.']);
        }
    }
}