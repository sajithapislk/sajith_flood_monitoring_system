<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FCM;
use Illuminate\Http\Request;

class FCMController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $fcm = FCM::where('fcm_token', $request->fcm_token)->first();

        if (!$fcm) {
            FCM::create([
                'user_id' => $user->id,
                'fcm_token' => $request->fcm_token
            ]);
        }
        return response()->json(['status' => 'success']);

    }
}
