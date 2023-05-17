<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Firebase\JWT\JWT;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
{
    return view('auth.login');
}


    public function login(Request $request)
    {
        try {
            // autenticar al usuario con las credenciales proporcionadas
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // generar token JWT
                $user = Auth::user();
                $payload = [
                    'sub' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'iat' => time(),
                    'exp' => time() + (60 * 60 * 24) // expira en 24 horas
                ];
                $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    
                return redirect()->route('welcome');
            }
        } catch (\PDOException $e) {
            // error de conexión a la base de datos
            return back()->with('error', 'Error: Unable to establish a connection with the database. Please check your connection.');
        }
    
        // error de validación
        return back()->with('error', 'The credentials provided do not match our records.');
        
    }    

    public function showRegistrationForm()
    {
        return view('auth.register');
    }   

    public function logout(Request $request)
    {
       
        $token = $request->bearerToken();

        if (!$token) {
            // Token no presente por inicio con Google
            return redirect()->route('loginForm');
        }

        // Decodificar token JWT y validar firma
        try {
            $payload = JWT::decode($token, config('jwt.secret'), ['HS256']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        Auth::logout();

        return redirect()->route('loginForm');
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Verificar si el usuario ya existe en la base de datos
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            // inicia sesión
            Auth::login($existingUser);
        } else {
            // El usuario no existe, crear una nueva cuenta
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = Hash::make(Str::random(20));
            $newUser->save();

            Auth::login($newUser);
        }

        return redirect()->route('selectApi');
    }
}