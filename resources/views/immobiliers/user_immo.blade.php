@extends('immobiliers.base')
@section('content')

<div class="container">
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
                <th scope="col">Reactions</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($immobiliers as $immobilier)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $immobilier->location }}</td>
                    <td>{{ $immobilier->pieces_number }}</td>
                    <td>{{ $immobilier->city }}</td>
                    <td>{{ $immobilier->state }}</td>
                    <td>{{ $immobilier->description }}</td>
                    <td>{{ $immobilier->price }}</td>
                    <td>{{ $immobilier->area }}</td>
                    <td>{{ $immobilier->real_state_type }}</td>
                    <td>{{ $immobilier->transaction_type }}</td>
                    <td>
                        <!-- Dans votre vue immobiliers/show.blade.php -->

                    <div>
                    <ul>
                    <li>Likes : {{ $immobilier->likesCount() }}</li>
                    <li>Dislikes : {{ $immobilier->dislikesCount() }}</li>
                    <li>Adores : {{ $immobilier->adoresCount() }}</li>
                    </ul>
                    </div>

                    </td>
                    <td>
                        <a href="{{ route('update_immo', ['id' => $immobilier->id]) }}"><i class="bi bi-pen-fill text-primary"></i></a>
                        <a href="{{ route('show_immo', ['id' => $immobilier->id]) }}"><i class="bi bi-eye-fill text-info"></i></a>
                        <a href="{{ route('delete_immo', ['id' => $immobilier->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash3 text-danger"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
