<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RiskConfirmation;
use App\Models\RiskUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AnalysisReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Query to get the count of RiskUser records grouped by date
        $riskUserCounts = RiskUser::selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as risk_user_count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Query to get the count of RiskConfirmation records grouped by date
        $riskConfirmationCounts = RiskConfirmation::selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as risk_confirmation_count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Combine the data into a single collection, keyed by date
        $combinedData = $this->combineDataByDate($riskUserCounts, $riskConfirmationCounts);
        // return $combinedData;
        return view('admin.report.analysis-report', [
            'list' => $combinedData,
        ]);
    }


    private function combineDataByDate(Collection $riskUserCounts, Collection $riskConfirmationCounts)
    {
        // Create an associative array to store the combined data by date
        $combined = [];

        // Add risk user counts to the combined array
        foreach ($riskUserCounts as $riskUser) {
            $combined[$riskUser->date] = [
                'date' => $riskUser->date,
                'risk_user_count' => $riskUser->risk_user_count,
                'risk_confirmation_count' => 0, // Default to 0 if no confirmations for the date
            ];
        }

        // Add risk confirmation counts to the combined array
        foreach ($riskConfirmationCounts as $riskConfirmation) {
            if (isset($combined[$riskConfirmation->date])) {
                // If the date exists in the array, update the risk confirmation count
                $combined[$riskConfirmation->date]['risk_confirmation_count'] = $riskConfirmation->risk_confirmation_count;
            } else {
                // If the date does not exist, initialize the array with default risk user count 0
                $combined[$riskConfirmation->date] = [
                    'date' => $riskConfirmation->date,
                    'risk_user_count' => 0,
                    'risk_confirmation_count' => $riskConfirmation->risk_confirmation_count,
                ];
            }
        }

        // Convert to a collection and sort by date in descending order
        return collect($combined)->sortByDesc('date');
    }
}
