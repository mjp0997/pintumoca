<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncreaseStockRequest;
use App\Http\Requests\StockRequest;
use App\Models\Stock;

class StocksController extends Controller
{
    public function store(StockRequest $request)
    {
        $data = $request->validated();

        $stock = Stock::withTrashed()->firstOrCreate([
            'product_id' => $data['product_id'],
            'office_id' => $data['office_id']
        ], [
            'stock' => $data['stock']
        ]);

        if (!$stock->wasRecentlyCreated) {
            if (!is_null($stock->deleted_at)) {
                $stock->restore();
            }

            $stock->update(['stock' => $data['stock']]);
        }

        return redirect()->route('products.show', ['id' => $stock->product_id]);
    }

    public function update(IncreaseStockRequest $request)
    {
        $data = $request->validated();

        $stock = Stock::find($data['stock_id']);

        $stock->stock = $stock->stock + $data['stock'];
        $stock->save();

        return redirect()->route('products.show', ['id' => $stock->product_id]);
    }
}
