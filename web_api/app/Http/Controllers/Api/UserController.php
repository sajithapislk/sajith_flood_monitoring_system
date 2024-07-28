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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdatePatchRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStorePostRequest $request)
    {
        $user =  User::create($request->validated());
        $token = $user->createToken('user-api')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function check(UserCheckPostRequest $request)
    {
        $fields = $request->validated();
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Password is incorrect'
            ], 401);
        }

        $token = $user->createToken('api',['user:*'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
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
