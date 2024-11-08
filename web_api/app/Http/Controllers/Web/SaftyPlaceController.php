<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\SafetyPlace;
use Illuminate\Http\Request;

class SaftyPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = SafetyPlace::all();
        $areas = Area::all();
        return view('admin.safe_place', compact('list', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $areas = Area::all();
        // return view('admin.safe_place_create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'area_id' => 'required|exists:areas,id',
            'tp' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'name' => 'required|string|max:255',
        ]);

        // Create new SafetyPlace entry
        $safetyPlace = new SafetyPlace($validatedData);
        $safetyPlace->save();

        return redirect()->back()->with('success', 'Safety place created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $safetyPlace = SafetyPlace::findOrFail($id);
        // return view('admin.safe_place_show', compact('safetyPlace'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $safetyPlace = SafetyPlace::findOrFail($id);
        // $areas = Area::all();
        // return view('admin.safe_place_edit', compact('safetyPlace', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'area_id' => 'nullable|exists:areas,id',
            'tp' => 'nullable|string|max:255',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'name' => 'nullable|string|max:255',
        ]);

        // Find the existing SafetyPlace entry
        $safetyPlace = SafetyPlace::findOrFail($id);

        // Update only the filled field
        if ($request->filled('area_id')) {
            $safetyPlace->update(['area_id' => $validatedData['area_id']]);
        }
        if ($request->filled('tp')) {
            $safetyPlace->update(['tp' => $validatedData['tp']]);
        }
        if ($request->filled('longitude')) {
            $safetyPlace->update(['longitude' => $validatedData['longitude']]);
        }
        if ($request->filled('latitude')) {
            $safetyPlace->update(['latitude' => $validatedData['latitude']]);
        }
        if ($request->filled('name')) {
            $safetyPlace->update(['name' => $validatedData['name']]);
        }

        return redirect()->back()->with('success', 'Safety place updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $safetyPlace = SafetyPlace::findOrFail($id);
        $safetyPlace->delete();

        return redirect()->back()->with('success', 'Safety place deleted successfully.');
    }
}
