<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCauseRequest;
use App\Models\Cause;
use Illuminate\Support\Facades\Storage;

class CauseController extends Controller
{
    public function index()
    {
        $causes = Cause::withCount('donations')
            ->withSum('donations', 'amount')
            ->latest()
            ->paginate(10);

        return view('causes.index', compact('causes'));
    }

    public function create()
    {
        return view('causes.create');
    }

    public function store(StoreCauseRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('causes', 'public');
        }

        Cause::create($data);

        return redirect()->route('causes.index')->with('success', 'Cause added successfully.');
    }

    public function show(Cause $cause)
    {
        $donations = $cause->donations()->with('donor')->latest('donation_date')->paginate(10);

        return view('causes.show', compact('cause', 'donations'));
    }

    public function edit(Cause $cause)
    {
        return view('causes.edit', compact('cause'));
    }

    public function update(StoreCauseRequest $request, Cause $cause)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($cause->image) {
                Storage::disk('public')->delete($cause->image);
            }
            $data['image'] = $request->file('image')->store('causes', 'public');
        }

        $cause->update($data);

        return redirect()->route('causes.index')->with('success', 'Cause updated successfully.');
    }

    public function destroy(Cause $cause)
    {
        if ($cause->image) {
            Storage::disk('public')->delete($cause->image);
        }

        $cause->delete();

        return redirect()->route('causes.index')->with('success', 'Cause deleted successfully.');
    }
}