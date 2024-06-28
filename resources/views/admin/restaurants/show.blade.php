@extends('layouts.app')
@section('content')

<section>
    <h1>SHOW</h1>
    <h3>{{ $restaurant->name }}</h3>
    <h3>{{ $restaurant->address }}</h3>
    <h3>{{ $restaurant->vat }}</h3>
    <h3>{{ $restaurant->thumb }}</h3>
    <h3>{{ $restaurant->created_at }}</h3>
    <h3>{{ $restaurant->updated_at }}</h3>

</section>

@endsection