<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private function applyFilters($query, $filters)
    {
        if (!empty($filters['product_name'])) {
            $query->where('product_name', 'like', '%' . $filters['product_name'] . '%');
        }

        if (!empty($filters['product_number'])) {
            $query->where('product_number', 'like', '%' . $filters['product_number'] . '%');
        }

        if (!empty($filters['product_purchasePrice'])) {
            $query->where('product_purchasePrice', $filters['product_purchasePrice']);
        }

        if (!empty($filters['product_description'])) {
            $query->where('product_description', 'like', '%' . $filters['product_description'] . '%');
        }

        if (!empty($filters['category'])) {
            $query->whereHas('categories', function($query) use ($filters) {
                $query->where('category_name', 'like', '%' . $filters['category'] . '%');
            });
        }

        if (!empty($filters['status_name'])) {
            $query->whereHas('status', function($query) use ($filters) {
                $query->where('status_name', 'like', '%' . $filters['status_name'] . '%');
            });
        }

        if (!empty($filters['usage_start_date'])) {
            $query->where('usage_start_date', '>=', $filters['usage_start_date']);
        }

        if (!empty($filters['usage_end_date'])) {
            $query->where('usage_end_date', '<=', $filters['usage_end_date']);
        }

        if (!empty($filters['inventory_name'])) {
            $query->whereHas('inventory', function ($query) use ($filters) {
                $query->where('inventory_name', 'like', '%' . $filters['inventory_name'] . '%');
            });
        }
            if (!empty($filters['include_deleted'])) {
                $query->withTrashed();
            } else {
                $query->whereNull('deleted_at');
            }


        return $query;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter = $_GET;
        $builder = Product::withTrashed()->where('user_id', auth()->id());
        $builder = $this->applyFilters($builder, $filter);


        $products = $builder->paginate($_GET['itemsPerPage'] ?? 10);
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
        $nextProductId = Product::max('id') + 1;
        $products = Product::all();
        $categories = Category::all();
        $statuses = Status::all();
        $inventories = Inventory::all();

        return view('products.create',[
            'products' => $products,
            'categories' => $categories,
            'statuses' => $statuses,
            'inventories' => $inventories,
            'nextProductId' => $nextProductId
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
            'inventory_id' => 'required',
            'product_description' => '',
            'category_id' => 'nullable|array',
            'status_id' => '',
            'usage_start_date' => 'required|date',
            'usage_end_date' => 'nullable|date|after_or_equal:usage_start_date',
        ],
        [ 'usage_end_date.after_or_equal' => 'Das Verwendungsende darf nicht vor dem Verwendungsbeginn liegen.',
        ]);

        $product = new Product();
        if (!empty($validatedData['product_id'])) {
            $product->id = $validatedData['product_id'];
        }
        $product->product_name = $validatedData['product_name'];
        $product->product_number = $validatedData['product_number'];
        $product->product_purchasePrice = $validatedData['product_purchasePrice'];
        $product->product_description = $validatedData['product_description'];
        $product->inventory_id = $validatedData['inventory_id'];
        $product->status_id = $validatedData['status_id'];
        $product->usage_start_date = $validatedData['usage_start_date'];
        $product->usage_end_date = $validatedData['usage_end_date'];
        $product->user_id = auth()->id();
        $product->saveOrFail();


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
        $inventorie = Inventory::all();
        return view('products.edit', [
            'categories' => $categories,
            'product' => $product,
            'statuses' => $statuses,
            'inventories' => $inventorie
        ]);
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
            'product_description' => 'nullable|string',
            'inventory_id' => 'required|exists:inventories,id',
            'category_id' => 'nullable|array',
            'category_id.*' => 'exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'usage_start_date' => 'required|date',
            'usage_end_date' => 'nullable|date|after_or_equal:usage_start_date',
        ]);

        $product = Product::findOrFail($id);
        $product->product_name = $validatedData['product_name'];
        $product->product_number = $validatedData['product_number'];
        $product->product_purchasePrice = $validatedData['product_purchasePrice'];
        $product->product_description = $validatedData['product_description'];
        $product->inventory_id = $validatedData['inventory_id'];
        $product->status_id = $validatedData['status_id'];
        $product->usage_start_date = $validatedData['usage_start_date'];
        $product->usage_end_date = $validatedData['usage_end_date'];
        $product->save();

        $product->categories()->sync($validatedData['category_id'] ?? []);


        return redirect()->route('products.index')->with('success', 'Produkt wurde erfolgreich aktualisiert!');
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
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.index')->with('success', 'Produkt wurde erfolgreich wiederhergestellt!');
    }
   /* public function indexFiltering(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $products = Product::sortable()
                ->where('products.name', 'like', '%'.$filter.'%')
                ->paginate(5);
        } else {
            $products = Product::sortable()
                ->paginate(5);
        }

        return view('products.index')->with('products', $products)->with('filter', $filter);
    }*/



}
