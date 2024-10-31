<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Services\DistanceService;
use App\Models\MonitorPlace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $distanceService;

    // Inject the DistanceService in the constructor
    public function __construct(DistanceService $distanceService)
    {
        $this->distanceService = $distanceService;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $notifications = $user->notifications;
        $monitorPlaces = $user->monitorPlaces;

        $user->unreadNotifications()->update(['read_at' => now()]);

        $userLatitude = $request->latitude;
        $userLongitude = $request->longitude;

        $nearestPlace = null;
        $_distance = null;

        foreach ($monitorPlaces as $key => $place) {
            $distance = $this->distanceService->calculateDistance(
                $userLatitude,
                $userLongitude,
                $place->latitude,
                $place->longitude
            );
            if ($_distance == null || $distance < $_distance) {
                $nearestPlace = $place;
                $_distance = $distance;
            }
        }

        return response()->json([
            'user' => $user,
            'notifications' => $notifications,
            'nearestPlace' => $nearestPlace
        ]);
    }
}
