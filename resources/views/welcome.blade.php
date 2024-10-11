@extends('layouts.front')

@section('meta')
    <meta name="description" content="about my web site">
{{-- ... --}}
@endsection

@section('title')
    <title>IPD|sn</title>
@endsection

@section('style')
    
@endsection

@section('content')
<div class="content-wrapper">
    <div class="text-content">
        <h2>Bienvenue à l'Institut Polytechnique de Dakar Thomas Sankara(IPD)</h2>
        <br>
        <p>
            Nous sommes ravis de vous accueillir sur notre plateforme de préinscription en ligne. 
            l'Institut Polytechnique de Dakar Thomas Sankara(IPD) est une institution dédiée à l'excellence académique 
            et à la recherche innovante. 
            Notre processus de préinscription en ligne est conçu pour être simple et efficace, 
            vous permettant de postuler à nos programmes en toute facilité.
        </p>
        <div class="btn-group">
            <a href="{{ route('register') }}" class="btn btn-custom btn-custom-primary">Inscription</a>
            <a href="{{ route('login') }}" class="btn btn-custom btn-custom-secondary">Connexion</a>
        </div>
    </div>
    <div class="image-content">
        <img src="{{ asset('logo/logibg.png') }}" alt="Institut Polytechnique de Dakar" class="img-fluid floating">
    </div>
</div>
@endsection

@section('script')
    
@endsection