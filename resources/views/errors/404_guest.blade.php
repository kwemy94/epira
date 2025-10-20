@extends('layouts.guest')

@section('title', 'Page non trouvée')

@section('content')
    <div class="text-center mt-5">
        <h1 class="display-4">404</h1>
        <p>Oups ! La page que vous cherchez n’existe pas.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
    </div>
@endsection
