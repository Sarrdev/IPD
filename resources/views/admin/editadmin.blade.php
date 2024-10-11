@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 font-weight-bold text-gray-800">
                Modifier une formation
            </h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm fade-in-up">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h2 class="h5 mb-4">Modifier une formation</h2>
                        <form action="{{route('admin.updateTraining', ['id' => $formation->id])}}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="filiere" class="form-label">Nom de la Filière</label>
                                <input type="text" name="nomfiliere" id="filiere" autocomplete="filiere" value="{{ $formation->nomfiliere }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="parcours" class="form-label">Parcours</label>
                                <input type="text" name="parcours" id="parcours" autocomplete="parcours" value="{{ $formation->parcours }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="cout" class="form-label">Cout Licence/an</label>
                                <input type="text" name="cout" id="cout" autocomplete="cout" value="{{ $formation->cout }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="coutm" class="form-label">Cout Master/an</label>
                                <input type="text" name="coutm" id="coutm" autocomplete="coutm" value="{{ $formation->coutm }}" class="form-control">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Modifier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
