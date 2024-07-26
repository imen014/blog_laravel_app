@extends('immobiliers.base')
@section('content')

<form action="{{ route('save_answer') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="message_title" class="form-label">Object</label>
        <input type="text" class="form-control" id="message_title" name="message_title">
        @error('message_title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="message_content" class="form-label">Text content</label>
        <textarea class="form-control" id="message_content" name="message_content"></textarea>
        @error('message_content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" value="{{$message->id}}" id="message_id" name="message_id">
       
    </div>
    
    
    
   
    
    <div class="mb-3">
        <input type="submit" class="form-control btn btn-dark" value="Send" />
    </div>
</form>

@endsection
