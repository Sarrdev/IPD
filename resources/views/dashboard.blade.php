<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 animate-fade-in-up">
                    <h3 class="text-lg font-semibold mb-4">Vos préinscriptions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Niveau d'étude</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Formation</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Année académique</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($preinscriptions as $preinscription)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->nom }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->prenom }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->adresse }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->niveau_etude }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->formation }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $preinscription->annee_academ }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="{{ $preinscription->statut == 'en attente' ? 'text-red-transparent' : 'text-green-500' }}">
                                            {{ $preinscription->statut }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('user.edit_training', ['id' => $preinscription->id]) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                        <form action="{{ route('user.delete', ['id' => $preinscription->id]) }}" method="POST" class="inline" id="deleteForm-{{ $preinscription->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:text-red-900 ml-2 deleteButton" data-form-id="{{ $preinscription->id }}">Supprimer</button>
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
    <div id="myModal" class="modal">
        <div class="modal-content small-width">
            <span class="close">&times;</span>
            <p>Voulez-vous vraiment supprimer votre préinscription ?</p>
            <button id="confirmDeleteButton" class="confirm-button">Oui</button>
            <button class="cancel-button">Non</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sélectionnez tous les boutons de suppression
            var deleteButtons = document.querySelectorAll('.deleteButton');
    
            // Pour chaque bouton de suppression, ajoutez un gestionnaire d'événements pour afficher le pop-up correspondant
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var formId = button.getAttribute('data-form-id');
                    var modal = document.getElementById('myModal');
    
                    // Lorsque le bouton de suppression est cliqué, affichez le pop-up
                    modal.style.display = 'block';
    
                    // Lorsque l'utilisateur clique sur le bouton "Oui", soumettez le formulaire de suppression correspondant
                    var confirmDeleteButton = document.getElementById('confirmDeleteButton');
                    confirmDeleteButton.addEventListener('click', function () {
                        var deleteForm = document.getElementById('deleteForm-' + formId);
                        deleteForm.submit();
                    });
                });
            });
    
            // Sélectionnez le bouton "Non" et la croix de fermeture dans le pop-up
            var cancelButton = document.querySelector('.cancel-button');
            var closeButton = document.querySelector('.close');
    
            // Lorsque l'utilisateur clique sur le bouton "Non" ou la croix de fermeture, cachez le pop-up
            cancelButton.addEventListener('click', function () {
                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
            });
    
            closeButton.addEventListener('click', function () {
                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
            });
    
            // Lorsque l'utilisateur clique en dehors de la boîte de dialogue, cachez le pop-up
            window.addEventListener('click', function (event) {
                var modal = document.getElementById('myModal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
