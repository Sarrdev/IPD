<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des formations disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-white border-b border-gray-200 animate-fade-in-up">
                    
                    <!-- Champ de recherche -->
                    <div class="mb-6">
                        <input type="text" id="search" placeholder="Rechercher..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table id="trainingTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom de la Filière</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parcours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cout Licence/an</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cout Master/an</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($trainingads as $trainingad)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $trainingad->nomfiliere }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $trainingad->parcours }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $trainingad->cout }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $trainingad->coutm }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap flex items-center">
                                            <a href="{{ route('user.redirectinscription')}}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                <i class="fas fa-user-plus mr-1"></i>
                                                S'inscrire
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="noResults" class="text-center text-gray-500 mt-4 hidden">
                            Aucun résultat trouvé
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const tableRows = document.querySelectorAll('#trainingTable tbody tr');
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

            noResults.classList.toggle('hidden', hasResults);
        });
    });
</script>
