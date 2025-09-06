<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1️⃣ Validacija
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // laukiam 'password_confirmation'
        ]);

        // 2️⃣ Sukurti vartotoją
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 3️⃣ Sukurti API tokeną
        $token = $user->createToken('api-token')->plainTextToken;

        // 4️⃣ Grąžinti JSON atsakymą
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function login(Request $request)
    {
        // 1️⃣ Validacija
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 2️⃣ Rasti vartotoją pagal email
        $user = User::where('email', $request->email)->first();

        // 3️⃣ Patikrinti slaptažodį
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // 4️⃣ Sukurti API token per Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        // 5️⃣ Grąžinti JSON atsakymą
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
