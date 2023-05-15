<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Welcome to the api selector of PAU's application</h1>

        <a href="{{ route('spoonacular.index') }}" class="btn btn-primary mt-3">Ir a Spoonacular</a>
        <a  class="btn btn-primary mt-3">Ir a Trello</a>
    </div>
</body>
</html>
