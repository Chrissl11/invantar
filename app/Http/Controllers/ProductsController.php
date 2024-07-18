<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $statuses = Status::all();
        $inventories = Inventory::all();

        return view('products.index', [
            'categories' => $categories,
            'statuses' => $statuses,
            'products' => $products,
            'inventories' => $inventories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        $statuses = Status::all();
        $inventories = Inventory::all();

        return view('products.create',[
            'products' => $products,
            'categories' => $categories,
            'statuses' => $statuses,
            'inventories' => $inventories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'product_number' => 'required',
            'product_purchasePrice' => 'required',
            'product_residualValue' => 'required',
            'inventory_id' => 'required',
            'product_description' => '',
            'category_id' => '',
            'status_id' => ''
        ]);

        $product = new Product();
        $product->product_name = $validatedData['product_name'];
        $product->product_number = $validatedData['product_number'];
        $product->product_purchasePrice = $validatedData['product_purchasePrice'];
        $product->product_residualValue = $validatedData['product_residualValue'];
        $product->product_description = $validatedData['product_description'];
        $product->inventory_id = $validatedData['inventory_id'];
        $product->status_id = $validatedData['status_id'];
        $product->saveOrFail();

        /**
         * product->categories = [1,3,5,6,77]
         * $validatedData['category_id] = [3,5,69]
         * 1. [1,3,5,6,77] -> [3,5]
         * 2. [3,5,69] - [3,5] = [69]
         *
         */

        foreach ($validatedData['category_id'] as $categoryId) {
            $category = new CategoryProduct();
            $category->product_id = $product->id;
            $category->category_id = $categoryId;
            $category->saveOrFail();
        }


        return redirect()->route('products.index')->with('success', 'Produkt wurde erfolgreich hinzugefügt!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $statuses = Status::all();
        $categories = Category::all();
        return view('products.edit', [
            'categories' => $categories,
            'product' => $product,
            'statuses' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'product_number' => 'required',
            'product_purchasePrice' => 'required|numeric',
            'product_residualValue' => 'required|numeric',
            'product_description' => 'nullable|string',
            'inventory_id' => 'required|exists:inventories,id',
            'category_id' => 'array',
            'category_id.*' => 'exists:categories,id',
            'status_id' => 'required|exists:statuses,id'
        ]);

        $product = Product::findOrFail($id);
        $product->product_name = $validatedData['product_name'];
        $product->product_number = $validatedData['product_number'];
        $product->product_purchasePrice = $validatedData['product_purchasePrice'];
        $product->product_residualValue = $validatedData['product_residualValue'];
        $product->product_description = $validatedData['product_description'];
        $product->inventory_id = $validatedData['inventory_id'];
        $product->status_id = $validatedData['status_id'];
        $product->save();

        $product->categories()->sync($validatedData['category_id'] ?? []);


        return redirect()->route('products.index', $product->inventory_id)->with('success', 'Produkt wurde erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::findOrFail($id);
        $inventory_id = $product->inventory_id;
        $product->delete();
        return redirect()->route('products.index',$inventory_id)->with('success', 'Produkt wurde erfolgreich gelöscht!');
    }

    protected function save(Product $product, Request $request)
    {

    }


}
