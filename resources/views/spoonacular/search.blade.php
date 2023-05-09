@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-5">Spoonacular Search</h1>

    <form class="form-inline mt-4" action="{{ route('spoonacular.search') }}" method="GET">
        <div class="form-group">
            <label class="mr-2" for="query">Search for recipes:</label>
            <input type="text" class="form-control mr-2" id="query" name="query">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <hr>

    <div class="row mt-4">
        @foreach($results as $result)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $result['image'] }}" class="card-img-top" alt="{{ $result['title'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $result['title'] }}</h5>
                    <a href="{{ route('spoonacular.recipe', $result['id']) }}" class="btn btn-primary">View Recipe</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a href="{{ url('api/spoonacular') }}" class="btn btn-primary">Go to Spoonacular API</a>

</div>
@endsection
