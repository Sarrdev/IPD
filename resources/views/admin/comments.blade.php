@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 font-weight-bold text-gray-800">
                Commentaires des utilisateurs
            </h2>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @foreach($comments as $comment)
                    <div class="comment mb-4">
                        <p class="mb-1"><strong>{{ $comment->user->name }}</strong> sur <strong>{{ $comment->preinscription->formation }}</strong>:</p>
                        <p class="mb-1">{{ $comment->comment }}</p>
                        <p class="text-muted small">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                        <hr class="mt-2">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
