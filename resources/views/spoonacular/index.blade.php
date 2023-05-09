<!DOCTYPE html>
<html>
<head>
    <title>Spoonacular Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
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

        @if (isset($results))
        <h2 class="mt-5">Search Results</h2>
        <div class="row">
            @foreach ($results as $result)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <img src="{{ $result->image }}" class="card-img-top" alt="{{ $result->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $result->title }}</h5>
                        <p class="card-text">{{ $result->summary }}</p>
                        <a href="{{ $result->sourceUrl }}" class="btn btn-primary" target="_blank">View Recipe</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if (isset($random))
        <h2 class="mt-5">Random Recipe</h2>
        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <div class="card">
                    <img src="{{ $random->image }}" class="card-img-top" alt="{{ $random->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $random->title }}</h5>
                        <p class="card-text">{{ $random->summary }}</p>
                        <a href="{{ $random->sourceUrl }}" class="btn btn-primary" target="_blank">View Recipe</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <hr>

        <form class="mt-4" action="{{ route('spoonacular.random') }}" method="GET">
            <button type="submit" class="btn btn-primary">Get Random Recipe</button>
        </form>
    </div>
</body>
</html>
