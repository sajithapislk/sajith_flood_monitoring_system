<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCheckPostRequest;
use App\Http\Requests\User\UserStorePostRequest;
use App\Http\Requests\User\UserUpdatePatchRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStorePostRequest $request)
    {
        $user =  User::create($request->validated());
        $token = $user->createToken('user', ['*'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function check(UserCheckPostRequest $request)
    {
        $user = User::where('email', $request['email'])->first();
        if ($user && Hash::check($request['password'], $user->password)) {
            $token = $user->createToken('user', ['*'])->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        }
        return response()->json([
            'message' => 'Invalid credentials'
        ],422);
    }

    public function logout(Request $request)
    {
        $user = $request->user()->tokens()->delete();
        return response([
            'message' => 'logout',
            'user' => $user
        ]);
    }
}
