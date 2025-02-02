<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('user')
            ->latest()
            ->paginate(10);
        
        return view('items.index', [
            'items' => $items,
            'title' => 'All Items'
        ]);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|in:lost,found',
            'date_found' => 'required_if:status,found|nullable|date',
        ]);
    
        // Temporarily set user_id to 1 for testing
        $validated['user_id'] = 1;
        
        Item::create($validated);
    
        return redirect()->route('items.index')
            ->with('success', 'Item reported successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|in:lost,found,claimed',
            'date_found' => 'required_if:status,found|nullable|date',
        ]);

        $item->update($validated);

        return redirect()->route('items.show', $item)
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }

    public function lost()
    {
        $items = Item::where('status', 'lost')
            ->with('user')
            ->latest()
            ->paginate(10);
        
        return view('items.index', [
            'items' => $items,
            'title' => 'Lost Items'
        ]);
    }

    public function found()
    {
        $items = Item::where('status', 'found')
            ->with('user')
            ->latest()
            ->paginate(10);
        
        return view('items.index', [
            'items' => $items,
            'title' => 'Found Items'
        ]);
    }

    public function reportFound(Item $item)
    {
        if ($item->status !== 'lost') {
            return redirect()->back()->with('error', 'This item is not marked as lost.');
        }
        
        return view('items.report-found', compact('item'));
    }

    public function markFound(Request $request, Item $item)
    {
        if ($item->status !== 'lost') {
            return redirect()->back()->with('error', 'This item is not marked as lost.');
        }

        $validated = $request->validate([
            'found_location' => 'required|string|max:255',
            'date_found' => 'required|date',
        ]);

        $item->update([
            'status' => 'found',
            'location' => $validated['found_location'],
            'date_found' => $validated['date_found'],
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Item has been marked as found.');
    }
}
