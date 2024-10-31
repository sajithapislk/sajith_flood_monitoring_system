<?php

namespace App\Http\Services;

class DistanceService
{
    public function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371;  // Kilometers

        $latFrom = deg2rad($latitude1);
        $lonFrom = deg2rad($longitude1);
        $latTo = deg2rad($latitude2);
        $lonTo = deg2rad($longitude2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return number_format(($angle * $earthRadius),2);
    }
}
