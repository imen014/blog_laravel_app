@extends('immobiliers.base')
@section('content')

<div class="container">
<form action="{{ route('update_immo',['id'=>$immobilier->id]) }}" method="POST" enctype="data/multipart">
    @csrf
    @method('PUT')
<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" class="form-control" name="location" id="location" placeholder="location">
  </div>
  <div class="mb-3">
    <label for="pieces_number" class="form-label"> Pieces Number</label>
    <input type="number" id="pieces_number" name="pieces_number" /> 
 </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" name="city" id="city" >
  </div>
  <div class="mb-3">
    <label for="state" class="form-label">State</label>
    <input type="text" class="form-control" name="state" id="state" ></textarea>
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" name="price" id="price" ></textarea>
  </div>
  <div class="mb-3">
    <label for="area" class="form-label">Area</label>
    <input type="text" class="form-control" name="area" id="area" ></textarea>
  </div>
  <div class="mb-3">
  <select class="form-select" aria-label="Default Real state type" name="real_state_type">
    <option selected>Real state type</option>
    <option value="house">House</option>
    <option value="appartement">Appartement</option>
    <option value="studio">Studio</option>
  </select>
</div>
<div class="mb-3">
    <select class="form-select" aria-label="Default Transaction type">
      <option selected>Transaction type</option>
      <option value="sale">Sale</option>
      <option value="rent">Rent</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="area" class="form-label">Images</label>
    <input type="file" class="form-control" name="immo_image" id="immo_image" multiple></textarea>
  </div>
<div class="mb-3">
    <input type="submit" value="validate" class="btn btn-dark">
</div>


</form>
</div>
  @endsection