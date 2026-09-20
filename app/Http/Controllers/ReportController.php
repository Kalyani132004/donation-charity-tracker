<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Shared date-range filter applied to the base Donation query.
     */
    private function baseQuery(Request $request)
    {
        return Donation::query()
            ->when($request->from_date, fn ($q) => $q->whereDate('donation_date', '>=', $request->from_date))
            ->when($request->to_date, fn ($q) => $q->whereDate('donation_date', '<=', $request->to_date));
    }

    public function donorWise(Request $request)
    {
        $rows = $this->baseQuery($request)
            ->when($request->donor_id, fn ($q) => $q->where('donor_id', $request->donor_id))
            ->join('donors', 'donors.id', '=', 'donations.donor_id')
            ->selectRaw('donors.name as donor_name, count(donations.id) as total_donations, sum(donations.amount) as total_amount')
            ->groupBy('donors.id', 'donors.name')
            ->orderByDesc('total_amount')
            ->get();

        $donors = Donor::orderBy('name')->get();

        return view('reports.donor-wise', compact('rows', 'donors'));
    }

    public function causeWise(Request $request)
    {
        $rows = $this->baseQuery($request)
            ->when($request->cause_id, fn ($q) => $q->where('cause_id', $request->cause_id))
            ->join('causes', 'causes.id', '=', 'donations.cause_id')
            ->selectRaw('causes.name as cause_name, count(donations.id) as total_donations, sum(donations.amount) as total_amount')
            ->groupBy('causes.id', 'causes.name')
            ->orderByDesc('total_amount')
            ->get();

        $causes = Cause::orderBy('name')->get();

        return view('reports.cause-wise', compact('rows', 'causes'));
    }

    public function modeWise(Request $request)
    {
        $rows = $this->baseQuery($request)
            ->selectRaw('donation_mode, count(id) as total_donations, sum(amount) as total_amount')
            ->groupBy('donation_mode')
            ->orderByDesc('total_amount')
            ->get();

        return view('reports.mode-wise', compact('rows'));
    }

    public function categoryWise(Request $request)
    {
        $rows = $this->baseQuery($request)
            ->selectRaw('financial_category, count(id) as total_donations, sum(amount) as total_amount')
            ->groupBy('financial_category')
            ->orderByDesc('total_amount')
            ->get();

        return view('reports.category-wise', compact('rows'));
    }

    public function dateWise(Request $request)
    {
        $rows = $this->baseQuery($request)
            ->selectRaw('donation_date, count(id) as total_donations, sum(amount) as total_amount')
            ->groupBy('donation_date')
            ->orderByDesc('donation_date')
            ->get();

        return view('reports.date-wise', compact('rows'));
    }
}
