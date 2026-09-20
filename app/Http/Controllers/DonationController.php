<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Models\Cause;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::with(['donor', 'cause'])
            ->when($request->donor_id, fn ($q) => $q->where('donor_id', $request->donor_id))
            ->when($request->cause_id, fn ($q) => $q->where('cause_id', $request->cause_id))
            ->when($request->donation_mode, fn ($q) => $q->where('donation_mode', $request->donation_mode))
            ->when($request->financial_category, fn ($q) => $q->where('financial_category', $request->financial_category))
            ->when($request->from_date, fn ($q) => $q->whereDate('donation_date', '>=', $request->from_date))
            ->when($request->to_date, fn ($q) => $q->whereDate('donation_date', '<=', $request->to_date))
            ->latest('donation_date')
            ->paginate(15)
            ->withQueryString();

        $donors = Donor::orderBy('name')->get();
        $causes = Cause::orderBy('name')->get();

        return view('donations.index', compact('donations', 'donors', 'causes'));
    }

    public function create()
    {
        $donors = Donor::orderBy('name')->get();
        $causes = Cause::where('status', 'active')->orderBy('name')->get();
        $donationModes = Donation::DONATION_MODES;
        $categories = Donation::FINANCIAL_CATEGORIES;

        return view('donations.create', compact('donors', 'causes', 'donationModes', 'categories'));
    }

    public function store(StoreDonationRequest $request)
    {
        $data = $request->validated();
        $data['receipt_number'] = Donation::generateReceiptNumber();
        $data['created_by'] = $request->user()->id;

        $donation = Donation::create($data);

        return redirect()
            ->route('donations.index')
            ->with('success', 'Donation recorded successfully.')
            ->with('new_donation_id', $donation->id);
    }

    public function edit(Donation $donation)
    {
        $donors = Donor::orderBy('name')->get();
        $causes = Cause::orderBy('name')->get();
        $donationModes = Donation::DONATION_MODES;
        $categories = Donation::FINANCIAL_CATEGORIES;

        return view('donations.edit', compact('donation', 'donors', 'causes', 'donationModes', 'categories'));
    }

    public function update(StoreDonationRequest $request, Donation $donation)
    {
        $donation->update($request->validated());

        return redirect()->route('donations.index')->with('success', 'Donation updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully.');
    }
}
