<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MonitorPlace;
use Illuminate\Http\Request;

class MonitorPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MonitorPlace::with('area')->get();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MonitorPlace $monitorPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonitorPlace $monitorPlace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MonitorPlace $monitorPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonitorPlace $monitorPlace)
    {
        //
    }
}
