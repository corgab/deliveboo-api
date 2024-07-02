@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <section>
                <div class="list-group">
                    @foreach ($types as $type)
                        <a href="#" class="list-group-item list-group-item-action">
                            {{ $type->name }}
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
