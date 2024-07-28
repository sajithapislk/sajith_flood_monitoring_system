<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminCheckPostRequest;
use App\Http\Requests\Admin\AdminStorePostRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
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
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStorePostRequest $request)
    {
        return Admin::create($request->validated());
    }
    public function check(AdminCheckPostRequest $request)
    {
        $request->validated();

        $admin = $request->only('email','password');

        if( Auth::guard('admin')->attempt($admin) ){
            return redirect('admin/home');
        }else{
            return redirect()->back()->with('fail','Incorrect Password');
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
