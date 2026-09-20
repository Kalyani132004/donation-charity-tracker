<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonorRequest;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $donors = Donor::withCount('donations')
            ->withSum('donations', 'amount')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('donor_code', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('donors.index', compact('donors', 'search'));
    }

    public function create()
    {
        return view('donors.create');
    }

    public function store(StoreDonorRequest $request)
    {
        $data = $request->validated();
        $data['donor_code'] = Donor::generateDonorCode();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('donors', 'public');
        }

        Donor::create($data);

        return redirect()->route('donors.index')->with('success', 'Donor added successfully.');
    }

    public function show(Donor $donor)
    {
        $donations = $donor->donations()->with('cause')->latest('donation_date')->paginate(10);

        return view('donors.show', compact('donor', 'donations'));
    }

    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    public function update(StoreDonorRequest $request, Donor $donor)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($donor->photo) {
                Storage::disk('public')->delete($donor->photo);
            }
            $data['photo'] = $request->file('photo')->store('donors', 'public');
        }

        $donor->update($data);

        return redirect()->route('donors.index')->with('success', 'Donor updated successfully.');
    }

    public function destroy(Donor $donor)
    {
        if ($donor->photo) {
            Storage::disk('public')->delete($donor->photo);
        }

        $donor->delete();

        return redirect()->route('donors.index')->with('success', 'Donor deleted successfully.');
    }
}