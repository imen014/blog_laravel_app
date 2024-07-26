@extends('immobiliers.base')
@section('content')

<div class="container">
    @if($asked_visites->isEmpty())
    <p>Aucune visite disponible pour le moment.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Raquested date</th>
                <th scope="col">Raquested time</th>
                <th scope="col">real state id</th>
                <th scope="col">user id</th>
               
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asked_visites as $visite)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $visite->date_demander }}</td>
                    <td>{{ $visite->time_demander }}</td>
                    <td>
                        <a href="{{ route('show_immo', ['id' => $visite->immobilier_id]) }}"><i class="bi bi-eye-fill text-primary"></i></a>
                    </td>
                    
                    <td> {{ $visite->user->email }}</td>
                    

                   
                        <td><a href="{{ route('delete_visite', ['id' => $visite->id]) }}"><i class="bi bi-trash3-fill text-danger"></i></a></td>
                        
                    </td>

                    
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
@endsection
