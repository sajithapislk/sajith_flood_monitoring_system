<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\RandomForestPrediction;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
    public function __invoke(Request $request)
    {
        // return $request;
        $randomForestResult = (new RandomForestPrediction('flood.csv',[$request->mp_id, null ,null, null, null, null,null, $request->date]))->predictResult();
        return $randomForestResult;
    }
}
