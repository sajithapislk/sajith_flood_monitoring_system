<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DM;
use Illuminate\Http\Request;

class DmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = DM::all();
        return view('admin.dm', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dm_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:d_m_s',
            'tp' => 'required|string|max:255|unique:d_m_s',
            'password' => 'required|string|min:8',
            'area_id' => 'required|exists:areas,id',
        ]);

        DM::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'tp' => $validated['tp'],
            'password' => bcrypt($validated['password']),
            'area_id' => $validated['area_id'],
        ]);

        return redirect()->route('admin.dm.index')->with('success', 'DM created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DM $dm)
    {
        // return view('admin.dm_show', compact('dm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DM $dm)
    {
        // return view('admin.dm_edit', compact('dm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DM $dm)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:d_m_s,email,' . $dm->id,
            'tp' => 'nullable|string|max:255|unique:d_m_s,tp,' . $dm->id,
            'password' => 'nullable|string|min:8',
            'area_id' => 'nullable|exists:areas,id',
        ]);

        // Update only the filled field
        if ($request->filled('name')) {
            $dm->update(['name' => $validated['name']]);
        }
        if ($request->filled('email')) {
            $dm->update(['email' => $validated['email']]);
        }
        if ($request->filled('tp')) {
            $dm->update(['tp' => $validated['tp']]);
        }
        if ($request->filled('password')) {
            $dm->update(['password' => bcrypt($validated['password'])]);
        }
        if ($request->filled('area_id')) {
            $dm->update(['area_id' => $validated['area_id']]);
        }

        return redirect()->route('admin.dm.index')->with('success', 'DM updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DM $dm)
    {
        $dm->delete();
        return redirect()->route('admin.dm.index')->with('success', 'DM deleted successfully.');
    }
}
