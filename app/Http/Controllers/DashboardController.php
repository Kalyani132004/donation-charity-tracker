<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\Donation;
use App\Models\Donor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDonors = Donor::count();
        $totalDonations = Donation::count();
        $totalAmount = Donation::sum('amount');

        $thisMonthAmount = Donation::whereMonth('donation_date', now()->month)
            ->whereYear('donation_date', now()->year)
            ->sum('amount');

        $todayDonations = Donation::whereDate('donation_date', today())->count();

        $recentDonations = Donation::with(['donor', 'cause'])
            ->latest('donation_date')
            ->take(8)
            ->get();

        $topCauses = Cause::withSum('donations', 'amount')
            ->orderByDesc('donations_sum_amount')
            ->take(5)
            ->get();

        $modeSummary = Donation::selectRaw('donation_mode, sum(amount) as total')
            ->groupBy('donation_mode')
            ->orderByDesc('total')
            ->get();

        $categorySummary = Donation::selectRaw('financial_category, sum(amount) as total')
            ->groupBy('financial_category')
            ->orderByDesc('total')
            ->get();

        $monthlySummary = Donation::selectRaw("DATE_FORMAT(donation_date, '%Y-%m') as month, sum(amount) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->take(12)
            ->get();

        return view('dashboard.index', compact(
            'totalDonors',
            'totalDonations',
            'totalAmount',
            'thisMonthAmount',
            'todayDonations',
            'recentDonations',
            'topCauses',
            'modeSummary',
            'categorySummary',
            'monthlySummary'
        ));
    }
}
