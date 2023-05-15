@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Create Card</h1>
    <form method="POST" action="{{ route('trello.createCard') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="due">Due Date:</label>
            <input type="datetime-local" class="form-control" id="due" name="due" min="{{ date('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="idList">List:</label>
            <select class="form-control" id="idList" name="idList">
                @foreach ($lists as $list)
                <option value="{{ $list['id'] }}">{{ $list['name'] }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection