<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Area::all();
        return view('admin.area',compact('list'));
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
        Area::create([
            'name' => $request->name
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
    public function update(Area $area,Request $request)
    {
        $area->update([
            'name' => $request->name
        ]);
        return redirect()->back()->with('success','done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Area::find($id)->delete();
        return redirect()->back()->with('success','done');
    }
}
