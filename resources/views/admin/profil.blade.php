@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 mt-4"> <!-- Ajout de la marge en haut -->
        <!-- En-tête avec titre centré et icône -->
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="font-weight-bold text-dark">
                    <i class="fas fa-user-check me-2"></i>Détails de la Préinscription
                </h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Affichage des détails de la préinscription -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header sb-sidenav-dark text-white">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>Informations Personnelles
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <!-- Détails de la préinscription -->
                            <div class="flex-grow-1">
                                <div class="mb-3">
                                    <p><i class="fas fa-user me-2 text-secondary"></i><strong>Nom:</strong> {{ $preinscription->nom }}</p>
                                    <p><i class="fas fa-user me-2 text-secondary"></i><strong>Prénom:</strong> {{ $preinscription->prenom }}</p>
                                    <p><i class="fas fa-envelope me-2 text-secondary"></i><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><i class="fas fa-phone me-2 text-secondary"></i><strong>Téléphone:</strong> {{ $user->phone }}</p>
                                    <p><i class="fas fa-flag me-2 text-secondary"></i><strong>Nationalité:</strong> {{ $user->nationality }}</p>
                                    <p><i class="fas fa-book me-2 text-secondary"></i><strong>Formation Choisie:</strong> {{ $preinscription->formation }}</p>
                                    <p><i class="fas fa-graduation-cap me-2 text-secondary"></i><strong>Niveau d'étude:</strong> {{ $preinscription->niveau_etude }}</p>
                                    @if($documents->isNotEmpty())
                                    <p><i class="fas fa-graduation-cap me-2 text-secondary"></i><strong>S'inscrit en:</strong> {{ $documents->first()->level }}
                                    </p> <!-- Afficher le niveau du premier document -->
                                @endif
                                </div>
                                
                                <h5 class="mt-4"><i class="fas fa-file-alt me-2 text-secondary"></i>Documents Fournis</h5>
                                @if($documents->isEmpty())
                                    <div class="alert alert-warning" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>Aucun document fourni.
                                    </div>
                                @else
                                    <ul class="list-group list-group-flush">
                                        @foreach($documents as $document)
                                            <li class="list-group-item">
                                                <i class="fas fa-file-pdf me-2 text-secondary"></i>
                                                <a href="{{ route('admin.documents.show', $document->id) }}" target="_blank" class="text-decoration-none">
                                                    {{ $document->document_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Formulaire pour mettre à jour le statut -->
                            <div class="ml-4 flex-shrink-0">
                                <h5 class="mb-3"><i class="fas fa-edit me-2 text-secondary"></i>Mettre à jour le statut</h5>
                                <form action="{{ route('admin.updateStatus', $preinscription->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="statut" class="form-label">Statut:</label>
                                        <select name="statut" id="statut" class="form-control form-control-sm">
                                            <option value="en attente" {{ $preinscription->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                                            <option value="approuvé" {{ $preinscription->statut == 'approuvé' ? 'selected' : '' }}>Approuvé</option>
                                            <option value="rejeté" {{ $preinscription->statut == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                                        </select>
                                        <button type="submit" class="btn btn-dark btn-sm mt-2">
                                            <i class="fas fa-save me-2"></i>Mettre à jour
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
