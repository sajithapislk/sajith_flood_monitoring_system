<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiskConfirmation\RiskConfirmationStorePostRequest;
use App\Models\RiskConfirmation;
use App\Models\RiskUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiskConfirmationController extends Controller
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
     * Store a newly created resource in storage.
     */
    public function store(RiskConfirmationStorePostRequest $request)
    {
        $user_id = $request->user()->id;
        $riskUserData = $request->validated();

        $riskUser = RiskUser::where('user_id',$user_id)
        ->whereDate('created_at',Carbon::now())
        ->latest('created_at')
        ->first();

        if (!$riskUser) {
            return "ERROR";
        }

        $riskConfirmation = RiskConfirmation::where('risk_user_id',$riskUser->id)
        ->whereDate('created_at',Carbon::now())
        ->latest('created_at')
        ->first();

        if($riskConfirmation){
            return "Already added";
        }else{
            $riskUserData['risk_user_id'] = $riskUser->id;
            return RiskConfirmation::create($riskUserData);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(RiskConfirmation $riskConfirmation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiskConfirmation $riskConfirmation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiskConfirmation $riskConfirmation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiskConfirmation $riskConfirmation)
    {
        //
    }
}
