@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Edit card</h1>
                <form method="POST" action="{{ route('trello.updateCard', ['cardId' => $card['id']]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="{{ $card['name'] }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="desc">Description:</label>
                        <textarea name="desc" id="desc" class="form-control" required>{{ $card['desc'] }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
