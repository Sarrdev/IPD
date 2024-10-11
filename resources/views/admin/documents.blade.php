@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 font-weight-bold text-gray-800">
                Liste des Documents de Préinscription
            </h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Utilisateur</th>
                            <th scope="col">Niveau</th>
                            <th scope="col">Nom du Document</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $document->user->name }}</td>
                                <td>{{ $document->level }}</td>
                                <td>{{ $document->document_name }}</td>
                                <td class="d-flex align-items-center">
                                    <a href="{{ route('admin.documents.show', $document->id) }}" class="btn btn-link text-decoration-none text-primary">
                                        <i class="fas fa-download"></i> Télécharger
                                    </a>
                                    <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST" id="deleteForm-{{ $document->id }}" class="ml-2 d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-link text-decoration-none text-danger deleteButton" data-document-id="{{ $document->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pop-up de confirmation -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer ce document ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Oui</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteButtons = document.querySelectorAll('.deleteButton');
            var modal = $('#myModal');
            var confirmDeleteButton = document.getElementById('confirmDeleteButton');
            var currentDocumentId;

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    currentDocumentId = button.getAttribute('data-document-id');
                    modal.modal('show');
                });
            });

            confirmDeleteButton.addEventListener('click', function () {
                if (currentDocumentId) {
                    var deleteForm = document.getElementById('deleteForm-' + currentDocumentId);
                    deleteForm.submit();
                    modal.modal('hide');
                }
            });
        });
    </script>
@endsection
