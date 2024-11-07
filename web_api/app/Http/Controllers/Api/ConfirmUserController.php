<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RiskConfirmation;
use App\Models\RiskUser;
use Illuminate\Http\Request;

class ConfirmUserController extends Controller
{
    public function index() {
        return RiskConfirmation::with('risk_user.user')->get();
    }
}
