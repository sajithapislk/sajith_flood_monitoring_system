<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RiskUser;
use Illuminate\Http\Request;

class RiskUserController extends Controller
{
    public function index()
    {
        $users = RiskUser::with('user','monitor_places.area')->get();
        return view('admin.risk_user',compact('users'));
    }
}
