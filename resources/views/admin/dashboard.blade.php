<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Préinscriptions reçues') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-4">Préinscriptions reçues</h3>
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
                                            <span class="{{ $preinscription->statut == 'en attente' ? 'text-red-transparent' : ($preinscription->statut == 'approuvé' ? 'text-green-500' : 'text-gray-500') }}">
                                                {{ ucfirst($preinscription->statut) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.updateStatus', ['id' => $preinscription->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="statut" value="approuvé">
                                                <button type="submit" class="text-green-600 hover:text-green-900">Approuver</button>
                                            </form>
                                            <form action="{{ route('admin.updateStatus', ['id' => $preinscription->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="statut" value="rejeté">
                                                <button type="submit" class="text-red-600 hover:text-red-900">Rejeter</button>
                                            </form>
                                            <form action="{{ route('admin.updateStatus', ['id' => $preinscription->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="statut" value="en attente">
                                                <button type="submit" class="text-gray-600 hover:text-gray-900">En attente</button>
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
</x-app-layout>
