<?php

namespace App\Console\Commands;

use App\Http\Controllers\Web\CsvController;
use App\Models\MonitorPlace;
use App\Models\RiskUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CSVUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update csv max water level';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        MonitorPlace::where('updated_at', '<', now()->subMinutes(5))->where('is_danger',1)->get()->each(function ($monitorPlace) {
            $ru = RiskUser::where('created_at',now()->subMinutes(5))->where('monitor_place_id',$monitorPlace->id)->get();
            if(count($ru)==0){
                (new CsvController)->write("Danger Area",$monitorPlace->id);
            }
        });

    }
}
