<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Préinscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in-up">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="p-6 bg-white border-b border-gray-200">
                    @if(isset($preinscription))
                    <form action="{{ route('user.updatepreinscript', ['id' => $preinscription->id]) }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" value="{{ $preinscription->nom }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom" value="{{ $preinscription->prenom }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez votre adresse" value="{{ $preinscription->adresse }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="niveau_etude" class="form-label">Niveau d'étude</label>
                                <input type="text" class="form-control" id="niveau_etude" name="niveau_etude" placeholder="Entrez votre niveau d'étude" value="{{ $preinscription->niveau_etude }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="formation" class="form-label">Formation</label>
                                <input type="text" class="form-control" id="formation" name="formation" placeholder="Entrez votre formation" value="{{ $preinscription->formation }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="annee_academ" class="form-label">Année académique</label>
                                <input type="text" class="form-control" id="annee_academ" name="annee_academ" placeholder="Entrez l'année académique" value="{{ $preinscription->annee_academ }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>
                    @else
                    <p>Préinscription non trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
