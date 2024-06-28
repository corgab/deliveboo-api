@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach($orders as $order)
        <div class="col-12">
            {{$order->name}}
        </div>
        @endforeach
    </div>
</div>
@endsection
