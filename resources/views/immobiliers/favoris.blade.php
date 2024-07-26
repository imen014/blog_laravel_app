@extends('immobiliers.base')

@section('content')
<div class="container">
    @if ($favoris->isEmpty())
        <p>Aucun favori trouvé pour cet utilisateur.</p>
    @else
        <p>{{ $favoris->count() }} favoris trouvés pour cet utilisateur.</p>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Location</th>
                    <th scope="col">Pieces number</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Area</th>
                    <th scope="col">Real state type</th>
                    <th scope="col">Transaction type</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($favoris as $favori)
                    <tr>
                        <th scope="row">{{ $favori->id }}</th>
                        <td>{{ $favori->immobilier->location }}</td>
                        <td>{{ $favori->immobilier->pieces_number }}</td>
                        <td>{{ $favori->immobilier->city }}</td>
                        <td>{{ $favori->immobilier->state }}</td>
                        <td>{{ $favori->immobilier->description }}</td>
                        <td>{{ $favori->immobilier->price }}</td>
                        <td>{{ $favori->immobilier->area }}</td>
                        <td>{{ $favori->immobilier->real_state_type }}</td>
                        <td>{{ $favori->immobilier->transaction_type }}</td>
                        <td>
                            <a href="{{ route('update_immo', ['id' => $favori->immobilier->id]) }}"><i class="bi bi-pen-fill text-primary"></i></a>
                            <a href="{{ route('show_immo', ['id' => $favori->immobilier->id]) }}"><i class="bi bi-eye-fill text-info"></i></a>
                            <a href="{{ route('delete_immo', ['id' => $favori->immobilier->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash3 text-danger"></i></a>
                            <a href="{{ route('delete_favoris', ['id' => $favori->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-bookmark-x-fill text-danger"></i></a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
