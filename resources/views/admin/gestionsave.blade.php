<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Save a training') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in-up">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="p-6">
                    <h2 class="text-xl mb-4">Formulaire de Formation</h2>
                    <form action="{{route('admin.savetraining')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="filiere" class="block text-sm font-medium text-gray-700">Nom de la Filière</label>
                            <input type="text" name="nomfiliere" id="filiere" autocomplete="filiere" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="mb-3">
                            <label for="parcours" class="block text-sm font-medium text-gray-700">Parcours</label>
                            <input type="text" name="parcours" id="parcours" autocomplete="parcours" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
