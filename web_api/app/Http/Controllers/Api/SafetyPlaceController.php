<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\SafetyPlace;
use Illuminate\Http\Request;

class SafetyPlaceController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyPlace $safetyPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SafetyPlace $safetyPlace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SafetyPlace $safetyPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SafetyPlace $safetyPlace)
    {
        //
    }

    public function place(Area $area)
    {
        return SafetyPlace::with('area')->
        where('area_id',$area->id)->get();
    }
}
