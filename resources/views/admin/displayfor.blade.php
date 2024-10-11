@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 font-weight-bold text-gray-800">
                Gestion
            </h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <!-- Champ de recherche -->
                        <div class="mb-4">
                            <input type="text" id="search" placeholder="Rechercher..." class="form-control">
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="afficheFormation" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nom de la Filière</th>
                                        <th>Parcours</th>
                                        <th>Cout Licence/an</th>
                                        <th>Cout Master/an</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trainings as $training)
                                        <tr>
                                            <td>{{ $training->nomfiliere }}</td>
                                            <td>{{ $training->parcours }}</td>
                                            <td>{{ $training->cout }}</td>
                                            <td>{{ $training->coutm }}</td>
                                            <td class="d-flex justify-content-start">
                                                <a href="{{ route('admin.edit', ['id' => $training->id]) }}" class="btn btn-sm btn-primary me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.delete', ['id' => $training->id]) }}" method="POST" id="deleteForm-{{ $training->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger deleteButton" data-form-id="{{ $training->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="noResults" class="text-center text-muted mt-4 d-none">
                                Aucun résultat trouvé
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de confirmation -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer cette formation ?
                    </div>
                    <div class="modal-footer">
                        <button id="confirmDeleteButton" class="btn btn-danger">Oui</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var deleteButtons = document.querySelectorAll('.deleteButton');
                var modal = new bootstrap.Modal(document.getElementById('myModal'));
                var confirmDeleteButton = document.getElementById('confirmDeleteButton');
                var currentFormId;

                deleteButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        currentFormId = button.getAttribute('data-form-id');
                        modal.show();
                    });
                });

                confirmDeleteButton.addEventListener('click', function () {
                    if (currentFormId) {
                        var deleteForm = document.getElementById('deleteForm-' + currentFormId);
                        deleteForm.submit();
                        modal.hide();
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('search');
                const tableRows = document.querySelectorAll('#afficheFormation tbody tr');
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
