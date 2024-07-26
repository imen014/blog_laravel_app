@extends('immobiliers.base')
@section('content')

<div class="container">
<form action="{{ route('save_immo') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input value="{{ old('location') }}" type="text" class="form-control" name="location" id="location" placeholder="location">
    @error('location')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="pieces_number" class="form-label">Pieces Number</label>
    <input value="{{ old('pieces_number') }}" type="number" class="form-control" id="pieces_number" name="pieces_number">
    @error('pieces_number')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3"> {{ old('description') }}</textarea>
    @error('description')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input value="{{ old('city') }}" type="text" class="form-control" name="city" id="city" >
    @error('city')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="state" class="form-label">State</label>
    <input value="{{ old('state') }}" type="text" class="form-control" name="state" id="state" >
    @error('state')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input value="{{ old('price') }}" type="text" class="form-control" name="price" id="price" />
    @error('price')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="area" class="form-label">Area</label>
    <input value="{{ old('area') }}" type="text" class="form-control" name="area" id="area" >
    @error('area')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
  <select class="form-select" aria-label="Default Real state type" name="real_state_type">
    <option selected>Real state type</option>
    <option value="house"  {{ old('real_state_type') == 'house' ? 'selected' : '' }}>House</option>
    <option value="appartement"  {{ old('real_state_type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
    <option value="studio" {{ old('real_state_type') == 'studio' ? 'selected' : '' }}>Studio</option>
  </select>
  @error('real_state_type')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror
</div>
<div class="mb-3">
    <select class="form-select" aria-label="Default Transaction type" name="transaction_type" id="transaction_type">
      <option selected>Transaction type</option>
      <option value="sale"  {{ old('transaction_type') == 'sale' ? 'selected' : '' }}>Sale</option>
      <option value="rent"  {{ old('transaction_type') == 'rent' ? 'selected' : '' }}>Rent</option>
    </select>
    @error('transaction_type')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="area" class="form-label">Images</label>
    <input type="file" class="form-control" name="immo_image[]" id="immo_image" multiple>
    @error('immo_image')
    <div class="alert alert-danger"> {{$message}}</div>
    @enderror
    @error('immo_image.*')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
  </div>
<div class="mb-3">
    <input type="submit" value="validate" class="btn btn-dark">
</div>


</form>
</div>
  @endsection