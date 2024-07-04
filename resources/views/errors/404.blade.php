@extends('layouts.app')
@section('content')

<div class="container py-5">
    <h1 class="text-danger mb-5">Errore 404. Pagina non trovata</h1>
    <p class="fs-5">La pagina che stai cercando di visualizzare non esiste. </p>

    <a class="btn btn-success btn-sm" href="{{ url('/') }}" role="button">Torna alla Home</a>
    </div>
</div>

@endsection