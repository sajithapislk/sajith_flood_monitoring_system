<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\MonitorPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitorPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        $list = MonitorPlace::all();
        return view('admin.monitor-place',compact('list','areas'));
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
        MonitorPlace::create([
            'area_id'=>$request->area_id,
            'name'=>$request->name,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
            'd_level'=>$request->d_level
        ]);
        return redirect()->back()->with('success','done');
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
