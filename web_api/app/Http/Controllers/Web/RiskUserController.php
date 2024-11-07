<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RiskUser;
use Illuminate\Http\Request;

class RiskUserController extends Controller
{
    public function index(Request $request)
    {

        // Retrieve start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query the users, applying filters if dates are provided
        $query = RiskUser::with('user');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Execute the query and get the filtered users
        $users = $query->get();

        // Return the view with the filtered users
        return view('admin.risk_user', compact('users'));
    }
}
