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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $month = $request->input('month');
        $year = $request->input('year');

        $riskUserQuery = RiskUser::selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as risk_user_count')
            ->groupBy('date')
            ->orderBy('date', 'desc');

        $riskConfirmationQuery = RiskConfirmation::selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as risk_confirmation_count')
            ->groupBy('date')
            ->orderBy('date', 'desc');

        if ($startDate && $endDate) {
            $riskUserQuery->whereBetween('created_at', [$startDate, $endDate]);
            $riskConfirmationQuery->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($month) {
            $riskUserQuery->whereMonth('created_at', $month);
            $riskConfirmationQuery->whereMonth('created_at', $month);
        } elseif ($year) {
            $riskUserQuery->whereYear('created_at', $year);
            $riskConfirmationQuery->whereYear('created_at', $year);
        }

        $riskUserCounts = $riskUserQuery->get();
        $riskConfirmationCounts = $riskConfirmationQuery->get();

        $combinedData = $this->combineDataByDate($riskUserCounts, $riskConfirmationCounts);

        return view('admin.report.analysis-report', [
            'list' => $combinedData,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'month' => $month,
            'year' => $year,
        ]);
    }


    private function combineDataByDate(Collection $riskUserCounts, Collection $riskConfirmationCounts)
    {
        $combined = [];

        foreach ($riskUserCounts as $riskUser) {
            $combined[$riskUser->date] = [
                'date' => $riskUser->date,
                'risk_user_count' => $riskUser->risk_user_count,
                'risk_confirmation_count' => 0, // Default to 0 if no confirmations for the date
            ];
        }

        foreach ($riskConfirmationCounts as $riskConfirmation) {
            if (isset($combined[$riskConfirmation->date])) {
                $combined[$riskConfirmation->date]['risk_confirmation_count'] = $riskConfirmation->risk_confirmation_count;
            } else {
                $combined[$riskConfirmation->date] = [
                    'date' => $riskConfirmation->date,
                    'risk_user_count' => 0,
                    'risk_confirmation_count' => $riskConfirmation->risk_confirmation_count,
                ];
            }
        }

        return collect($combined)->sortByDesc('date');
    }
}
