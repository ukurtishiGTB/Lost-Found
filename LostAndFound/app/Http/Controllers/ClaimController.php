<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Item;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::with(['item', 'user'])->latest()->get();
        return view('claims.index', compact('claims'));
    }

    public function store(Request $request, Item $item)
    {
        $validated = $request->validate([
            'proof_description' => 'required|string',
        ]);
    
        // Temporarily set user_id to 1 for testing
        $validated['user_id'] = 1;
        $validated['item_id'] = $item->id;
    
        Claim::create($validated);
    
        return redirect()->route('claims.index')
            ->with('success', 'Claim submitted successfully.');
    }

    public function verify(Claim $claim)
    {
        $claim->update(['verified' => true]);
        $claim->item->update(['status' => 'claimed']);

        return redirect()->back()
            ->with('success', 'Claim verified successfully.');
    }
}
