<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FloodStatus;
use App\Models\MonitorPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FloodStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $monitorPlaces = MonitorPlace::all();
        $returnData = array();
        foreach ($monitorPlaces as $key => $place) {
            $floodStatus = FloodStatus::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('MIN(water_level) as min'),
                DB::raw('MAX(water_level) as max')
            )
            ->where('monitor_place_id',$place->id)
            ->groupBy('date')
            ->latest('created_at')
            ->limit(7)
            ->get();
            array_push($returnData, ['status' => $floodStatus , 'place' => $place]);
        }


        // return $returnData;
        return view('admin.home',compact('returnData'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitorPlaces = MonitorPlace::all();
        $filter = array();
        foreach ($monitorPlaces as $key => $place) {
            $floodStatus = FloodStatus::latest('created_at')
            ->first();
            array_push($filter, ['status' => $floodStatus , 'place' => $place]);
        }
        // return $filter;
        $list = FloodStatus::with('monitor_place')->get();
        return view('admin.flood-status',compact('list','filter'));
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
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MonitorPlace $monitorPlace,Request $request)
    {
        $monitorPlace->update([
            'name' => $request->name
        ]);
        return redirect()->back()->with('success','done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MonitorPlace::find($id)->delete();
        return redirect()->back()->with('success','done');
    }
}
