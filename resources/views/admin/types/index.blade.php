@extends('layouts.app')
@section('content')

<section>
    @foreach ($types as $type)
        <h1>{{ $type->name }}</h1>        
    @endforeach
</section>

@endsection