@extends('immobiliers.base')
@section('content')

<form action="{{ route('update_ask_visite') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="visite_id" value="{{ $visite->id }}">
    <div class="mb-3">
        <label for="date_demander" class="form-label">Enter date</label>
        <input type="date" class="form-control" id="date_demander" name="date_demander">
        @error('date_demander')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="time_demander" class="form-label">Choose a time</label>
        <input type="time" class="form-control" id="time_demander" name="time_demander">
        @error('time_demander')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror
    </div>
    <div class="mb-3">
        <input type="submit" class="form-control btn btn-dark" />
    </div>
</form>

@endsection