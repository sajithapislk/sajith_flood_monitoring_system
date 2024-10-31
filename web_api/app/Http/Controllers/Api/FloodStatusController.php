<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FloodStatus\FloodStatusStorePostRequest;
use App\Http\Services\RandomForestPrediction;
use App\Models\Area;
use App\Models\FloodStatus;
use App\Models\MonitorPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FloodStatusController extends Controller
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
    public function store(FloodStatusStorePostRequest $request)
    {
        $id = $request->monitor_place_id;
        $waterLevel = $request->water_level;

        FloodStatus::create([
            'monitor_place_id'=>$id,
            'water_level'=>$waterLevel
        ]);

        $mp = MonitorPlace::find($id);
        $randomForestResult = (new RandomForestPrediction('flood.csv',[$mp->id, null ,null, null, null, null,null, $request->date]))->predictResult();

        Log::info($randomForestResult);
        if($randomForestResult=="Danger Area"){
            Log::alert('Danger Area');
            $mp->update([
                'is_danger' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FloodStatus $floodStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FloodStatus $floodStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FloodStatus $floodStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FloodStatus $floodStatus)
    {
        //
    }
}
