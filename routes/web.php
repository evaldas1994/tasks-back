<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (!Auth::attempt($request->only('email','password'))) {
        return response()->json(['error' => 'Neteisingi duomenys'], 401);
    }

    $request->session()->regenerate(); // labai svarbu

    return response()->json([
        'user' => Auth::user()
    ]);
});

Route::get('/', function () {
    return view('welcome');
});
