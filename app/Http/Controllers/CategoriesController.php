<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();

        return view('categories.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'category_name' => [
                'required',
                'max:255',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
        ]);
        $category = new Category();
        $category->category_name = $validatedData['category_name'];
        $category->user_id = Auth::id();
        $category->save();


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
        $category = Category::findOrFail($id);

        return view('categories.edit', [
        'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'category_name' => [
                'required',
                'max:255',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $validatedData['category_name'];
        $category->save();

        return redirect()->route('categories.create')->with('success', 'Kategorie wurde erfolgreich aktualisiert!');

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
