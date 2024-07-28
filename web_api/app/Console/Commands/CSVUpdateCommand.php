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
        $mp = MonitorPlace::all();
        foreach ($mp as $key => $row) {
            $ru = RiskUser::whereDate('created_at', Carbon::today())
            ->where('monitor_place_id',$row->id)
            ->get();
            if(count($ru)==0){
                (new CsvController)->write("Safe Area",$row->id);
            }
        }

    }
}
