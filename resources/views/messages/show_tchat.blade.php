@extends('immobiliers.base')
@section('content')


   <p>{{$tchat->message_title}} </p> 
   <p>{{$tchat->message_content}} </p> 
   <p><strong>Sender Email:</strong> {{ $sender->email }}</p>
<p><strong>Receiver Email:</strong> {{ $receiver->email }}</p>
<a href="{{ route('user.show', ['id' => $sender->id]) }}" class="btn btn-primary">Voir les détails</a>
<a href="{{ route('get_immo_per_user', ['id' => $sender->id]) }}" class="btn btn-primary">Show sender properties</a>
<a href="{{ route('delete_tchat', ['id' => $tchat->id]) }}" class="btn btn-primary">Delete discussion</a>
<a href="{{route('create_answer', ['id' => $tchat->id]) }}">Create answer</a>

xx


@endsection
