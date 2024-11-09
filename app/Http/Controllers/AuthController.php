<?php

namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AuthController extends Controller
{

public function login(Request $request) {
    $credentials = $request->only('username', 'password');
    $user = User::where('username', $credentials['username'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password) || !$user->is_active) {
        return response()->json(['message' => 'Invalid credentials or account inactive'], 403);
    }

    if ($user->subscription_expiration < now()) {
        $user->update(['is_active' => false]);
        return response()->json(['message' => 'Subscription expired'], 403);
    }

    $token = $user->createToken('authToken')->plainTextToken;
    return response()->json(['token' => $token]);
}

}
