<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('signin') }}">
        @csrf

        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <button type="submit">Registrarse</button>
        </div>
        <a href="{{ url('login/google') }}">Iniciar sesión con Google</a>

    </form>
</body>
</html>
