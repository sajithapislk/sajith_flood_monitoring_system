<?php

namespace App\Observers;

use App\Models\MonitorPlace;
use Illuminate\Support\Facades\Log;

class MonitorPlaceObserver
{
    /**
     * Handle the MonitorPlace "created" event.
     */
    public function created(MonitorPlace $monitorPlace): void
    {
        //
    }

    /**
     * Handle the MonitorPlace "updated" event.
     */
    public function updated(MonitorPlace $monitorPlace): void
    {
        Log::alert($monitorPlace);
    }

    /**
     * Handle the MonitorPlace "deleted" event.
     */
    public function deleted(MonitorPlace $monitorPlace): void
    {
        //
    }

    /**
     * Handle the MonitorPlace "restored" event.
     */
    public function restored(MonitorPlace $monitorPlace): void
    {
        //
    }

    /**
     * Handle the MonitorPlace "force deleted" event.
     */
    public function forceDeleted(MonitorPlace $monitorPlace): void
    {
        //
    }
}
