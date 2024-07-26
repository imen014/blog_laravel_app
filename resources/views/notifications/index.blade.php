@extends('immobiliers.base')
@section('content')
@foreach ($notifications as $notification)
    {{$notification->notification_object  }}
    {{$notification->notification_content  }}

@endforeach


<a href="{{route('delete_notifications')}}"><i class="bi bi-bell-slash-fill text-warning"></i></a>

@endsection