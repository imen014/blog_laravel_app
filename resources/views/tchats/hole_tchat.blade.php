@extends('immobiliers.base')

@section('content')

<h1>Discussion</h1>
<meta http-equiv="refresh" content="220"> <!-- Rafraîchir la page toutes les 30 secondes -->

@foreach ($tchats as $tchat)
<div class="container">
<div class="alert alert-info">{{ $tchat->tchat_title }}:{{ $tchat->message->message_title }}
   message content: <strong class="alert alert-info">{{ $tchat->message->message_content }} </strong>
   <a href="{{route('delete_message',['id'=>$tchat->message->id])}}"><i class="bi bi-shield-fill-x text-danger"></i></a>

    @if($tchat->response)
    <br/><i class="bi bi-opencollective text-primary"></i> <div class="alert alert-info">{{ $tchat->response->message_title }}
     <strong class="alert alert-info">{{ $tchat->response->message_content }}
     </strong>
     <a href="{{route('delete_answer',['id'=>$tchat->response->id])}}"><i class="bi bi-shield-fill-x text-danger"></i></a>

     
     </div>
    @endif


    </div>
<br/>
</div>
<a href="{{route('create_answer', ['id' => $tchat->message->id]) }}"><i class="bi bi-amazon text-primary"></i></a>

<a href="{{route('delete_hole_discussion',['id'=>$tchat->id])}}"><i class="bi bi-envelope-x-fill text-danger"></i></a>

@endforeach

@endsection


