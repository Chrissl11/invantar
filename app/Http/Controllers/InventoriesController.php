<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventories.index', ['inventories' => $inventories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_name' => 'required|min:2'
        ]);
        $inventory = new Inventory();
        $inventory->inventory_name = $validatedData['inventory_name'];
        $inventory->save();
        return redirect()->route('inventories.index')->with('success','Inventar wurde erfolgreich hinzugefügt!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::all();
        $statuses = Status::all();
        $inventory = Inventory::findOrFail($id);

        return view('inventories.show', [
            'inventory' => $inventory,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventory = Inventory::find($id);

        return view('inventories.edit',compact('inventory'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
               'inventory_name' => 'required|max:255|min:2',
            ]);
           $inventory = Inventory::findOrFail($id);
           $inventory->inventory_name = $request->input('inventory_name');
           $inventory->save();

            return redirect()->route('inventories.index')->with('success', 'Inventar wurde erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventar wurde erfolgreich gelöscht!');

    }
}
