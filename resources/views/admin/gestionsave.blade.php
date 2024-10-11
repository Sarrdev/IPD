@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 font-weight-bold text-dark">
                Ajouter une Formation
            </h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg ">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title mb-4 text-primary">
                            <i class="fas fa-plus-circle me-2"></i>Formulaire de Formation
                        </h5>
                        <form action="{{ route('admin.savetraining') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="filiere" class="form-label">Nom de la Filière</label>
                                <input type="text" name="nomfiliere" id="filiere" class="form-control rounded-3" placeholder="Entrez le nom de la filière" required>
                            </div>

                            <div class="mb-3">
                                <label for="parcours" class="form-label">Parcours</label>
                                <input type="text" name="parcours" id="parcours" class="form-control rounded-3" placeholder="Entrez le parcours" required>
                            </div>

                            <div class="mb-3">
                                <label for="cout" class="form-label">Coût Licence/an</label>
                                <input type="text" name="cout" id="cout" class="form-control rounded-3" placeholder="Entrez le coût Licence/an" required>
                            </div>

                            <div class="mb-3">
                                <label for="coutm" class="form-label">Coût Master/an</label>
                                <input type="text" name="coutm" id="coutm" class="form-control rounded-3" placeholder="Entrez le coût Master/an" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-pill">
                                    <i class="fas fa-save me-2"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
