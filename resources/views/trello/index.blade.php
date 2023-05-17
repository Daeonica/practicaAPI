<!DOCTYPE html>
<html>
<head>
    <title>Trello Cards</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Trello Cards</h1>
        <div class="mb-4">
            <a href="{{ route ('welcome') }}" class="btn btn-primary">Back to Welcome</a>
            <a href="{{ route('trello.createCardForm') }}" class="btn btn-success">Create Card</a>
        </div>
        <div class="row">
            @foreach ($cards as $card)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $card['name'] }}</h3>
                        <p class="card-text">Card ID: {{ $card['id'] }}</p>
                        <p class="card-text">List ID: {{ $card['idList'] }}</p>
                        <p class="card-text mb-2">Description: {{ $card['desc'] }}</p>
                        <p class="card-text mb-0">Due Date: {{ $card['due'] ?? 'No due date' }}</p>
                        <p class="card-text">Assigned Members:</p>
                        <ul class="card-text">
                            @foreach ($card['members'] as $member)
                            <li>{{ $member['fullName'] ?? $member['username'] }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('trello.editCardForm', $card['id']) }}" class="btn btn-warning">Edit Card</a>
                        <a href="{{ route('trello.deleteCard', $card['id']) }}" class="btn btn-danger">Delete Card</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
