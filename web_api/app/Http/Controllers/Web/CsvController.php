<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FloodStatus;
use App\Models\MonitorPlace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CsvController extends Controller
{
    public function write($status,$mp_id)
    {
        $filename = 'flood.csv';
        $filePath = storage_path('app/' . $filename);

        $newHeader = ['status','mp'];
        $newData = [$status,$mp_id];

        $mp = MonitorPlace::all();
        foreach ($mp as $key => $value) {
            $floodStatus = FloodStatus::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('MIN(water_level) as min'),
                DB::raw('MAX(water_level) as max')
            )
            ->where('monitor_place_id',$value->id)
            ->whereDate('created_at', Carbon::today())
            ->groupBy('date')
            ->first();

            array_push($newHeader,'danger-'.$value->id);
            array_push($newHeader,'wl-'.$value->id);
            array_push($newData, $value->is_danger);
            if ($floodStatus) {
                array_push($newData, $floodStatus->max);
            } else {
                array_push($newData, 0);
            }
        }

        array_push($newHeader,'datetime');
        array_push($newData,Carbon::today()->format('Y-m-d'));

        $existingHeader = [];
        $existingData = [];

        if (file_exists($filePath)) {
            $file = fopen($filePath, 'r');
            $row_c = 0;
            while (($row = fgetcsv($file)) !== false) {
                $row_c++;
                if($row_c==1){
                    $existingHeader = $row;
                }else{
                    $existingData[] = $row;
                }
            }
            fclose($file);
        }
        $diff = count($newHeader)-count($existingHeader);
        // dd($existingHeader);
        if($diff == 0){
            $file = fopen($filePath, 'a');
            fputcsv($file, $newData);
            fclose($file);
        }else{
            $file = fopen($filePath, 'w');
            fputcsv($file, $newHeader);
            // dd($existingData);
            foreach ($existingData as $row) {
                for ($i=0; $i < $diff ; $i++) {
                    array_push($row,0);
                }
                // dd($row);
                fputcsv($file, $row);
            }
            fputcsv($file, $newData);
            fclose($file);
        }
    }
}
