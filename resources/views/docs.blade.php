<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Soumettre des Documents de Préinscription') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-white border-b border-gray-200 animate-fade-in-up">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Niveau -->
                        <div class="mb-6">
                            <x-input-label for="level" :value="__('Niveau')" />
                            <select id="level" name="level" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" onchange="showDocuments(this.value)">
                                <option value="">-- Sélectionnez le Niveau --</option>
                                @foreach (['Master 2', 'Licence 2', 'Licence 3', 'Master 1', 'Licence 1'] as $level)
                                    <option value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('level')" class="mt-2" />
                        </div>

                        <!-- Documents Section -->
                        <div id="documents-section" class="mt-4 hidden">
                            <div id="Master-2-docs" class="hidden">
                                <x-input-label :value="__('Diplôme Licence')" />
                                <input type="file" name="documents[diplome_licence]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />

                                <x-input-label :value="__('Photocopie de la Carte d\'Identité Nationale')" />
                                <input type="file" name="documents[carte_identite]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />
                            </div>

                            <div id="Licence-2-docs" class="hidden">
                                <x-input-label :value="__('Photocopie des Bulletins Semestre 1')" />
                                <input type="file" name="documents[bulletins_semestre_1]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />

                                <x-input-label :value="__('Photocopie des Bulletins Semestre 2')" />
                                <input type="file" name="documents[bulletins_semestre_2]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />
                            </div>

                            <div id="Licence-3-docs" class="hidden">
                                <x-input-label :value="__('Photocopie des Bulletins Semestre 2')" />
                                <input type="file" name="documents[bulletins_semestre_2]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />

                                <x-input-label :value="__('Photocopie des Bulletins Semestre 3')" />
                                <input type="file" name="documents[bulletins_semestre_3]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />
                            </div>

                            <div id="Master-1-docs" class="hidden">
                                <x-input-label :value="__('Diplôme Licence')" />
                                <input type="file" name="documents[diplome_licence]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />

                                <x-input-label :value="__('Photocopie de la Carte d\'Identité Nationale')" />
                                <input type="file" name="documents[carte_identite]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />
                            </div>

                            <div id="Licence-1-docs" class="hidden">
                                <x-input-label :value="__('Diplôme du Bac')" />
                                <input type="file" name="documents[diplome_bac]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />

                                <x-input-label :value="__('Photocopie de la Carte d\'Identité Nationale')" />
                                <input type="file" name="documents[carte_identite]" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 transition duration-150 ease-in-out">
                                {{ __('Soumettre') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDocuments(level) {
            const sections = ['Licence-1-docs', 'Licence-2-docs', 'Licence-3-docs', 'Master-1-docs', 'Master-2-docs'];
            sections.forEach(section => document.getElementById(section).classList.add('hidden'));
            if (level) {
                document.getElementById('documents-section').classList.remove('hidden');
                document.getElementById(`${level.replace(' ', '-')}-docs`).classList.remove('hidden');
            } else {
                document.getElementById('documents-section').classList.add('hidden');
            }
        }
    </script>
    @include('layouts.footer')
</x-app-layout>
