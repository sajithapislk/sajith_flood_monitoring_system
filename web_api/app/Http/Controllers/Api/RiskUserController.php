<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\CsvController;
use App\Http\Requests\RiskUser\RiskUserStorePostRequest;
use App\Models\RiskUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiskUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RiskUser::with('user','monitor_places.area')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RiskUserStorePostRequest $request)
    {
        $user = $request->user();
        $riskUserData = $request->validated();

        $mp = $request->monitor_place_id;

        $riskUser = RiskUser::where('user_id',$user->id)
        ->where('monitor_place_id',$mp)
        ->whereDate('created_at',Carbon::now())
        ->get();

        if (count($riskUser)>0) {
            return "Already added";
        }

        $riskUserData['user_id'] = $user->id;

        $message = [
            "secret" => "3e90e77f800430d69fee88ac85a35db656305bdd",
            "mode" => "devices",
            "device" => "00000000-0000-0000-a3d9-90e7ba61d97a",
            "sim" => 1,
            "priority" => 1,
            "phone" => $user->tp,
            "message" => "You are in Rick Area."
        ];

        $cURL = curl_init("https://sms.uncgateway.com/api/send/sms");
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
        $response = curl_exec($cURL);
        curl_close($cURL);

        $result = json_decode($response, true);

        // do something with response
        print_r($result);

        return RiskUser::create($riskUserData);
    }

    /**
     * Display the specified resource.
     */
    public function show(RiskUser $riskUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiskUser $riskUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiskUser $riskUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiskUser $riskUser)
    {
        //
    }
}
