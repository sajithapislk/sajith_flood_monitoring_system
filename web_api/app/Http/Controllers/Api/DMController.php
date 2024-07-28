<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DM\DMCheckPostRequest;
use App\Http\Requests\DM\DMStorePostRequest;
use App\Models\DM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DM $dM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DM $dM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DM $dM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DM $dM)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DMStorePostRequest $request)
    {
        $dm =  DM::create($request->validated());
        $token = $dm->createToken('dm-api')->plainTextToken;

        $response = [
            'dm' => $dm,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function check(DMCheckPostRequest $request)
    {
        $fields = $request->validated();
        $user = DM::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Password is incorrect'
            ], 401);
        }

        $token = $user->createToken('api',['dm:*'])->plainTextToken;

        $response = [
            'dm' => $user,
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
