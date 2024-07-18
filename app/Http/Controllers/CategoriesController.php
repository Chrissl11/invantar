<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventory_id = request()->get('inventory_id');

        return view('categories.create', [
            'inventory_id' => $inventory_id,
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inventory_id = request()->get('inventory_id');
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);
        $category = new Category();
        $category->category_name = $validatedData['category_name'];
        $category->save();


        if ($inventory_id) {
            $inventory_id = Inventory::findOrFail($inventory_id);

            return redirect()->route('categories.create', ['inventory_id' => $inventory_id])->with('success', 'Kategorie wurde erfolgreich hinzugefügt!');
            ;
        }

        return redirect()->route('products.index', [$category->id])->with('success', 'Kategorie wurde erfolgreich hinzugefügt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory_id = request()->get('inventory_id');

        $category = Category::findOrFail($id);
        $category->delete();
        if ($inventory_id) {
            $inventory_id = Inventory::findOrFail($inventory_id);

            return redirect()->route('categories.create', ['inventory_id' => $inventory_id])->with('success', 'Kategorie wurde erfolgreich gelöscht!');
        }

        return redirect()->route('categories.create')->with('success', 'Kategorie wurde erfolgreich gelöscht!');
    }
}
