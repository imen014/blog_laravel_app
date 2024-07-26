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
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <th scope="row">{{ $immobilier->id }}</th>
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
                      @if (auth()->user()->role === 'property_owner')
                          <a href="{{ route('update_immo', ['id' => $immobilier->id]) }}"><i class="bi bi-pen-fill text-primary"></i></a>
                      @endif
                        <a href="{{ route('show_immo', ['id' => $immobilier->id]) }}"><i class="bi bi-eye-fill text-info"></i></a>
                        @if (auth()->user()->role === 'property_owner')
                            <a href="{{ route('delete_immo', ['id' => $immobilier->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash3 text-danger"></i></a>
                        @endif
                        @if (auth()->user()->role === 'home_seeker')
                            <a href="{{ route('planifier_visite',['id'=>$immobilier->id]) }}"><i class="bi bi-calendar-month-fill"></i></a>
                        @endif

                    </td>
                </tr>
        </tbody>
    </table>

<ul>
    <div class="mt-4">
        <h4>Images:</h4>
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3">
                    <img src="{{ asset($image->image_path) }}" class="img-fluid img-thumbnail" alt="Image of {{ $immobilier->location }}">
                </div>
            @endforeach
        </div>
    </div>

</ul>
<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      @foreach ($images as $key => $image)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
          <img src="{{ asset($image->image_path) }}" class="d-block w-100" alt="Image {{ $key }}">
        </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  

 


@php
$userReaction = $immobilier->userReaction(Auth::id());
@endphp

@if (auth()->user()->role === 'home_seeker')
@if ($userReaction)
<div>
  Current Reaction:
    @if ($userReaction->reaction_name === 'like')
        <i class="bi bi-hand-thumbs-up-fill text-primary"></i>
    @elseif ($userReaction->reaction_name === 'dislike')
        <i class="bi bi-hand-thumbs-down-fill text-primary"></i>
    @elseif ($userReaction->reaction_name === 'adore')
        <i class="bi bi-heart-fill text-danger"></i>
    @endif
</div>
@endif
@endif



</div>
<body>
  @if (auth()->user()->role === 'home_seeker')
  <div class="container mt-5">
      <div class="row">
          <div class="col-md-3">
              <form action="{{ route('like_immo', ['id' => $immobilier->id]) }}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-link btn-action"><i class="bi bi-hand-thumbs-up-fill"></i> Like</button>
                  <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
              </form>
          </div>
          <div class="col-md-3">
              <form action="{{ route('dislike_immo', ['id' => $immobilier->id]) }}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-link btn-action"><i class="bi bi-hand-thumbs-down-fill"></i> Dislike</button>
                  <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
              </form>
          </div>
          <div class="col-md-3">
              <form action="{{ route('adore_immo', ['id' => $immobilier->id]) }}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-link btn-action"><i class="bi bi-heart-fill text-danger"></i> Adore</button>
                  <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
              </form>
          </div>
          <div class="col-md-3">
              <form action="{{ route('create_favoris') }}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-link btn-action"><i class="bi bi-star-fill text-warning"></i> Add to favourites</button>
                  <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
              </form>
          </div>
      </div>
  </div>

</div>
@endif
@endsection

