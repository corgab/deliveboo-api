@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Un link di verifica è stata inviata nella tua e-mail') }}
                    </div>
                    @endif

                    {{ __("Prima di continuare, controllare l'email con il link di verifica") }}

                    {{ __('Se non hai ricevuto nessuma email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clicca qui per richiedere un nuovo link') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
