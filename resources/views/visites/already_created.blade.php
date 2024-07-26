@extends('immobiliers.base')

@section('content')

    <p class="text-danger">Ask already created</p>
    <p>You can update the request <a href="{{ route('change_ask_visite_date', ['id' => $visite->id]) }}">update ask visite</a></p>

    <p>Contenu normal ici...</p>

@endsection
