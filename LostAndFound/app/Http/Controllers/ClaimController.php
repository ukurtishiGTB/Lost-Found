<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function create(Item $item)
    {
        if ($item->status !== 'found') {
            return redirect()->back()->with('error', 'Only found items can be claimed.');
        }
        
        return view('items.claim', compact('item'));
    }

    public function store(Request $request, Item $item)
    {
        if ($item->status !== 'found') {
            return redirect()->back()->with('error', 'Only found items can be claimed.');
        }

        $validated = $request->validate([
            'claimer_name' => 'required|string|max:255',
            'claimer_email' => 'required|email|max:255',
            'proof_description' => 'required|string|min:50',
        ]);

        $validated['item_id'] = $item->id;
        
        Claim::create($validated);

        return redirect()->route('items.show', $item)
            ->with('success', 'Your claim has been submitted and is pending review.');
    }

    public function index()
    {
        $claims = Claim::with('item')->latest()->get();
        return view('claims.index', compact('claims'));
    }

    public function verify(Claim $claim)
    {
        $claim->update(['verified' => true]);
        $claim->item->update(['status' => 'claimed']);

        return redirect()->route('claims.index')
            ->with('success', 'Claim has been verified and item marked as claimed.');
    }
}
