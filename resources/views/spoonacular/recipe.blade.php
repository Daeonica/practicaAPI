@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-5">{{ $recipe['title'] }}</h1>
    <hr>
    <img src="{{ $recipe['image'] }}" class="rounded mx-auto d-block" alt="{{ $recipe['title'] }}" style="max-width: 500px;">
    <hr>
    <div class="row">
        <div class="col-md-8">
            <h2>Ingredients:</h2>
            <ul>
                @foreach($recipe['extendedIngredients'] as $ingredient)
                <li>{{ $ingredient['name'] }} ({{ $ingredient['amount'] }} {{ $ingredient['unit'] }})</li>
                @endforeach
            </ul>
            <hr>
            <h2>Instructions:</h2>
            <ol>
                @foreach($recipe['analyzedInstructions'][0]['steps'] as $step)
                <li>{{ $step['step'] }}</li>
                @endforeach
            </ol>
        </div>
    </div>
    <a href="{{ url('api/spoonacular') }}" class="btn btn-primary">Go to Spoonacular API</a>

</div>
@endsection

     