@extends('immobiliers.base')

@section('content')

<h1>{{ $user->name }}</h1>
<p><strong>Email:</strong> {{ $user->email }}</p>

<h2>Visites</h2>
<ul>
    @foreach($visites as $visite)
    <li>{{ $visite->state_visite }} on {{ $visite->date_demander }} at {{ $visite->time_demander }}</li>
    <a href="{{ route('get_immo_per_user', ['id' => $sender->id]) }}" class="btn btn-primary">Show sender properties</a>

</ul>


</ul>



