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
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $validated['image'] = $path;
        }

        // Temporarily set a fixed user_id for testing
        $validated['user_id'] = 1;
        $validated['status'] = 'lost';

        $item = Item::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Item reported successfully.');
    }

    public function edit(Item $item)
    {
        // Removed authorization
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        // Removed authorization
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
        // Removed authorization
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
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
            'location' => 'required|string|max:255', // Changed from found_location to match form
            'date_found' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $item->update([
            'status' => 'found',
            'location' => $validated['location'],
            'date_found' => $validated['date_found'],
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Item has been marked as found.');
    }
}
