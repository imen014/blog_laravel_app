@extends('immobiliers.base')

@section('content')

<h1>Sended Message</h1>
<meta http-equiv="refresh" content="220"> <!-- Rafraîchir la page toutes les 30 secondes -->

@foreach ($tchats as $tchat)
<div class="container">
<div class="alert alert-info"> <strong>{{ $tchat->tchat_title }}:{{ $tchat->message->message_title }} </strong>
<a href="{{route('create_message')}}"> <i class="bi bi-vector-pen"></i></a>
<a href="{{ route('get_hole_discussion', ['id' => $tchat->id]) }}"> 
    <i class="bi bi-envelope-open-heart text-warning"></i></a>
</div>
<br/>
</div>
@endforeach
    

@endsection



