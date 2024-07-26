@extends('immobiliers.base')
@section('content')

<form action="{{ route('send_confirmed') }}" method="post">
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
        <select class="form-select" name="user_id" id="user_id">
            @if(Auth::user()->role == 'home_seeker' || Auth::user()->role == 'property_owner')
            <option>Select a user</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
            @else
                @foreach ($seekers as $seeker)
                    <option value="{{ $seeker->id }}">{{ $seeker->name }}</option>
                @endforeach
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    
   
    
    <div class="mb-3">
        <input type="submit" class="form-control btn btn-dark" value="Send" />
    </div>
</form>

@endsection
