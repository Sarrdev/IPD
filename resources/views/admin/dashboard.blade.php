@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h2 class="text-center font-weight-bold my-4">
            Préinscriptions reçues
        </h2>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Champ de recherche -->
                <div class="input-group mb-4">
                    <input type="text" id="search" class="form-control" placeholder="Rechercher...">
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Nombre d'étudiants inscrits -->
                <div class="text-center mb-4">
                    <h3 class="h4 text-primary mb-2">Nombre total d'utilisateurs inscrits</h3>
                    <span class="badge bg-primary py-3 px-4 fs-5">
                        {{ $totalStudents }}
                    </span>
                </div>

                <!-- Tableau des préinscriptions -->
                <div class="table-responsive">
                    <!-- Formulaire de filtrage -->
                    <div class="d-flex mb-4 p-3 bg-light rounded shadow-sm">
                        <!-- Formulaire de filtrage -->
                        <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex align-items-center w-100 gap-3">
                            <!-- Filtrage par Statut -->
                            <div class="input-group">
                                <label class="input-group-text bg-gradient text-white fw-bold rounded-start" for="filter_statut">
                                    <i class="bi bi-list-task"></i> Statut
                                </label>
                                <select name="filter_statut" id="filter_statut" class="form-select rounded-end border-primary shadow-sm">
                                    <option value="">Tous les Statuts</option>
                                    <option value="en attente" {{ request('filter_statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="approuvé" {{ request('filter_statut') == 'approuvé' ? 'selected' : '' }}>Approuvé</option>
                                    <option value="rejeté" {{ request('filter_statut') == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                                </select>
                            </div>
                    
                            <!-- Filtrage par Formation -->
                            <div class="input-group">
                                <label class="input-group-text bg-gradient text-white fw-bold rounded-start" for="filter_formation">
                                    <i class="bi bi-mortarboard"></i> Formation
                                </label>
                                <select name="filter_formation" id="filter_formation" class="form-select rounded-end border-primary shadow-sm">
                                    <option value="">Toutes les Formations</option>
                                    @foreach($trainings as $training)
                                        <option value="{{ $training->nomfiliere }}" {{ request('filter_formation') == $training->nomfiliere ? 'selected' : '' }}>
                                            {{ $training->nomfiliere }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Bouton de filtrage -->
                            <button type="submit" class="btn btn-primary fw-bold d-flex align-items-center rounded-pill shadow-sm px-3">
                                <i class="bi bi-funnel-fill me-2"></i> Filtrer
                            </button>
                        </form>
                    </div>
                    

                    <table id="preinscriptionsTable" class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Niveau d'étude</th>
                                <th scope="col">Formation</th>
                                <th scope="col">Année académique</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Actions</th>
                                <th scope="col">Profil</th> <!-- Nouvelle colonne -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preinscriptions as $preinscription)
                                <tr>
                                    <td>{{ $preinscription->nom }}</td>
                                    <td>{{ $preinscription->prenom }}</td>
                                    <td>{{ $preinscription->adresse }}</td>
                                    <td>{{ $preinscription->niveau_etude }}</td>
                                    <td>{{ $preinscription->formation }}</td>
                                    <td>{{ $preinscription->annee_academ }}</td>
                                    <td>
                                        <span class="badge {{ $preinscription->statut == 'en attente' ? 'bg-warning' : ($preinscription->statut == 'approuvé' ? 'bg-success' : 'bg-danger') }}">
                                            {{ ucfirst($preinscription->statut) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.updateStatus', ['id' => $preinscription->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="statut" value="approuvé">
                                            <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                                        </form>
                                        <form action="{{ route('admin.updateStatus', ['id' => $preinscription->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="statut" value="rejeté">
                                            <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                                        </form>
                                        <form action="{{ route('admin.updateStatus', ['id' => $preinscription->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="statut" value="en attente">
                                            <button type="submit" class="btn btn-warning btn-sm">En attente</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.profil', ['id' => $preinscription->id]) }}" class="btn btn-info btn-sm">Voir Profil</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $preinscriptions->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                    <div id="noResults" class="text-center text-muted mt-4 d-none">
                        Aucun résultat trouvé
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const tableRows = document.querySelectorAll('#preinscriptionsTable tbody tr');
            const noResults = document.getElementById('noResults');

            searchInput.addEventListener('input', function () {
                const searchText = searchInput.value.trim().toLowerCase();
                let hasResults = false;

                tableRows.forEach(row => {
                    const allCells = row.getElementsByTagName('td');
                    let found = false;

                    Array.from(allCells).forEach(cell => {
                        const cellText = cell.textContent.toLowerCase();
                        if (cellText.includes(searchText)) {
                            found = true;
                        }
                    });

                    if (found) {
                        row.style.display = '';
                        hasResults = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                noResults.classList.toggle('d-none', hasResults);
            });
        });
    </script>
@endsection
