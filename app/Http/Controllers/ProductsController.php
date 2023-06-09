<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Office;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search', null);

        $office_id = $request->query('office_id', null);

        $products = Product::with('stocks.office')->orderBy('name', 'ASC');

        if (!is_null($search)) {
            $products->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")->orWhere('code', 'LIKE', "%$search%");
            });
        }

        if (!is_null($office_id)) {
            $products->whereHas('stocks', function($query) use ($office_id) {
                return $query->where('office_id', $office_id);
            });
        }

        $products = $products->paginate(12);

        $offices = Office::orderBy('name', 'ASC')->get();

        $breadcrumb = [
            [
                'text' => 'Productos'
            ],
        ];

        return view('products.index', [
            'breadcrumb' => $breadcrumb,
            'products' => $products,
            'offices' => $offices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = [
            [
                'text' => 'Productos',
                'route' => 'products.index'
            ],
            [
                'text' => 'Nuevo'
            ],
        ];

        return view('products.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = new Product($data);
        $product->save();

        return redirect()->route('products.show', ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('stocks.office')->find($id);

        $offices = Office::orderBy('name', 'ASC')->get();

        $breadcrumb = [
            [
                'text' => 'Productos',
                'route' => 'products.index'
            ],
            [
                'text' => $product?->code ?: 'Error 404'
            ],
        ];

        return view('products.show', [
            'breadcrumb' => $breadcrumb,
            'product' => $product,
            'offices' => $offices
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        $breadcrumb = [
            [
                'text' => 'Productos',
                'route' => 'products.index'
            ],
            [
                'text' => $product?->code ?: 'Error 404'
            ],
        ];

        return view('products.edit', [
            'breadcrumb' => $breadcrumb,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();

        $product = Product::find($id);

        if (!isset($product)) {
            return redirect()->route('products.show', ['id' => $id]);
        }

        $product->update($data);

        return redirect()->route('products.show', ['id' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!isset($product)) {
            return redirect()->route('products.index');
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
