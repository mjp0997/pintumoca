<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductMassRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ReadProductsFileRequest;
use App\Imports\ProductImport;
use App\Models\Office;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            $products = $products->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")->orWhere('code', 'LIKE', "%$search%");
            });
        }

        if (!is_null($office_id)) {
            $products = $products->whereHas('stocks', function($query) use ($office_id) {
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

    /**
     * Get a listing of the resource as a JSON
     */
    public function api_index(Request $request)
    {
        $office_id = $request->query('office_id', null);

        $products = Product::with([
            'stocks' => function($query) use ($office_id)
            {
                return $query->where('office_id', $office_id)->with('office');
            }
        ])->orderBy('name', 'ASC');

        if (!is_null($office_id)) {
            $products = $products->whereHas('stocks', function($query) use ($office_id) {
                return $query->where('office_id', $office_id);
            });
        }

        $products = $products->get();

        return response()->json($products);
    }

    public function mass_create()
    {
        $breadcrumb = [
            [
                'text' => 'Productos',
                'route' => 'products.index'
            ],
            [
                'text' => 'Creación masiva'
            ],
        ];

        return view('products.mass-create', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function mass_edit()
    {
        $breadcrumb = [
            [
                'text' => 'Productos',
                'route' => 'products.index'
            ],
            [
                'text' => 'Actualizar stocks'
            ],
        ];

        return view('products.mass-edit', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function mass_read(ReadProductsFileRequest $request)
    {
        $data = $request->validated();

        $route = $data['route'];

        $import = new ProductImport;
        
        Excel::import($import, $request->file('import')->store('temp'));

        $products = $import->getProducts();

        $products = collect($products)->map(function ($product) {
            $product_data = [
                'code' => strtoupper($product['material']),
                'name' => $product['descripcion'],
            ];

            unset($product['material']);
            unset($product['descripcion']);
            unset($product['marca']);
            unset($product['uv']);
            unset($product['precio_lista']);
            unset($product['precio_dist']);
            unset($product['pvp']);
            unset($product['psvp']);

            $offices = [];
            $total_stock = 0;

            foreach ($product as $key => $value) {
                $offices[strtoupper($key)] = $value;
                $total_stock += $value;
            }

            $product_data['offices'] = $offices;
            $product_data['total_stock'] = $total_stock;

            return $product_data;
        });

        $products = $products->filter(function ($product, $key) {
            return isset($product['name']) && isset($product['code']);
        });

        $offices = collect($products[0]['offices'])->map(function ($value, $key) {
            return $key;
        });

        return redirect()->route("products.$route")->with('products', $products)->with('offices', $offices);
    }

    public function mass_store(ProductMassRequest $request)
    {
        $data = $request->validated();

        $all_products = isset($data['all_products']) ? true : false;

        foreach ($data['products'] as $row) {
            if (!$all_products) {
                $total_stock = 0;

                foreach ($row['offices'] as $office => $stock) {
                    $total_stock += $stock;
                }
            }

            if (!isset($total_stock) || $total_stock > 0) {
                $product = Product::updateOrCreate([
                    'code' => $row['code']
                ], [
                    'name' => $row['name']
                ]);
    
                foreach ($row['offices'] as $office_name => $stock) {
                    if ($all_products || $stock > 0) {
                        $office = Office::firstOrCreate([
                            'name' => $office_name
                        ]);
        
                        $stock_data = Stock::updateOrCreate([
                            'product_id' => $product->id,
                            'office_id' => $office->id
                        ], [
                            'stock' => $stock
                        ]);
                    }
                }
            }
        }

        return redirect()->route('products.index');
    }

    public function mass_update(ProductMassRequest $request)
    {
        $data = $request->validated();

        foreach ($data['products'] as $row) {
            $total_stock = 0;

            foreach ($row['offices'] as $office => $stock) {
                $total_stock += $stock;
            }

            if ($total_stock > 0) {
                $product = Product::firstOrCreate([
                    'code' => $row['code']
                ], [
                    'name' => $row['name']
                ]);
    
                foreach ($row['offices'] as $office_name => $stock) {
                    if ($stock > 0) {
                        $office = Office::firstOrCreate([
                            'name' => $office_name
                        ]);
        
                        $stock_data = Stock::firstOrCreate([
                            'product_id' => $product->id,
                            'office_id' => $office->id
                        ], [
                            'stock' => $stock
                        ]);

                        if (!$stock_data->wasRecentlyCreated) {
                            $stock_data->increment('stock', $stock);
                        }
                    }
                }
            }
        }

        return redirect()->route('products.index');
    }
}
