<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 animate-fade-in-up">
                    
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <h3 class="text-2xl font-semibold mb-6">Vos préinscriptions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Prénom</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Adresse</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Niveau d'étude</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Formation</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Année académique</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($preinscriptions as $preinscription)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->nom }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->prenom }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->adresse }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->niveau_etude }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->formation }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->annee_academ }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="{{ $preinscription->statut == 'en attente' ? 'text-red-500' : 'text-green-500' }}">
                                            {{ ucfirst($preinscription->statut) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-4">
                                        <a href="{{ route('user.edit_training', ['id' => $preinscription->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.delete', ['id' => $preinscription->id]) }}" method="POST" class="inline" id="deleteForm-{{ $preinscription->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:text-red-900 deleteButton" data-form-id="{{ $preinscription->id }}">
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
        </div>
    </div>

    <!-- Pop-up de confirmation -->
    <div id="myModal" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" style="display:none;">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Confirmation</p>
                    <span class="modal-close cursor-pointer z-50">&times;</span>
                </div>
                <p class="mb-4">Voulez-vous vraiment supprimer cette formation ?</p>
                <div class="flex justify-end pt-2">
                    <button id="confirmDeleteButton" class="modal-close px-4 bg-red-600 p-3 rounded-lg text-white hover:bg-red-400 mr-2">Oui</button>
                    <button class="modal-close px-4 bg-gray-500 p-3 rounded-lg text-white hover:bg-gray-400">Non</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteButtons = document.querySelectorAll('.deleteButton');
            var modal = document.getElementById('myModal');
            var confirmDeleteButton = document.getElementById('confirmDeleteButton');
            var currentFormId;

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    currentFormId = button.getAttribute('data-form-id');
                    modal.style.display = 'block';
                });
            });

            confirmDeleteButton.addEventListener('click', function () {
                if (currentFormId) {
                    var deleteForm = document.getElementById('deleteForm-' + currentFormId);
                    deleteForm.submit();
                    modal.style.display = 'none';
                }
            });

            var closeButtons = document.querySelectorAll('.modal-close');
            closeButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    modal.style.display = 'none';
                });
            });

            window.addEventListener('click', function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
    
    @include('layouts.footer')
</x-app-layout>
