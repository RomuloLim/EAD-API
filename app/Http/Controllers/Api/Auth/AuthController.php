<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->delete();

        $token =  $user->createToken($data['device_name'])->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['logout' => true]);
    }

    public function me()
    {
        $user = auth()->user();
        return new UserResource($user);
    }
}
