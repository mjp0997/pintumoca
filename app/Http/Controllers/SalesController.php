<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Traits\DollarExchangeTrait;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Office;
use App\Models\PaymentMethod;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    use DollarExchangeTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = $request->query('date', null);

        $office_id = $request->query('office_id', null);

        $user_id = $request->query('user_id', null);

        $client = $request->query('client', null);

        $sales = Sale::with('user', 'office', 'client', 'lines.product', 'payments.paymentMethod')->orderBy('date', 'DESC');

        if (isset($date)) {
            $sales = $sales->whereDate('date', $date);
        }

        if (isset($office_id)) {
            $sales = $sales->where('office_id', $office_id);
        }

        if (isset($user_id)) {
            $sales = $sales->where('user_id', $user_id);
        }

        if (isset($client)) {
            $sales = $sales->whereHas('client', function($query) use ($client) {
                return $query->where('name', 'LIKE', "%$client%");
            });
        }

        $sales = $sales->paginate(12);

        $offices = Office::orderBy('name', 'ASC')->get();

        $users = User::with('role')->whereHas('role', function($query) {
            return $query->where('name', '!=', 'DEV');
        })->orderBy('name', 'ASC')->get();

        $breadcrumb = [
            [
                'text' => 'Ventas'
            ],
        ];

        return view('sales.index', [
            'breadcrumb' => $breadcrumb,
            'sales' => $sales,
            'offices' => $offices,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::orderBy('name', 'ASC')->get();

        $breadcrumb = [
            [
                'text' => 'Ventas',
                'route' => 'sales.index'
            ],
            [
                'text' => 'Reportar'
            ],
        ];

        return view('sales.create', [
            'breadcrumb' => $breadcrumb,
            'offices' => $offices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        $data = $request->validated();
        
        if (isset($data['client_name'])) {
            $client = Client::firstOrCreate([
                'name' => strtolower($data['client_name'])
            ]);

            $data['client_id'] = $client->id;
        }

        $sale = new Sale();
        $sale->user_id = $request->user()->id;
        $sale->office_id = $data['office_id'];
        if (isset($data['client_id'])) {
            $sale->client_id = $data['client_id'];
        }
        $sale->save();

        if (isset($data['payments'])) {
            $payments = collect($data['payments'])->map(function($payment) {
                return [
                    ...$payment,
                    'dollar_rate' => $this->getCurrentExchange()
                ];
            });

            $sale->payments()->createMany($payments);
        }

        $lines = collect($data['cart'])->map(function($row) use ($data) {
            $stock = Stock::where('product_id', $row['product_id'])->where('office_id', $data['office_id'])->first();

            if (isset($stock)) {
                $stock->decrement('stock', $row['quantity']);
            }

            return $row;
        })->toArray();

        $sale->lines()->createMany($lines);

        return redirect()->route('sales.show', ['id' => $sale->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::with('user', 'office', 'client', 'lines.product', 'payments.paymentMethod')->find($id);

        $currencies = Currency::orderBy('name', 'ASC')->get();

        $payment_methods = PaymentMethod::orderBy('name', 'ASC')->get();

        $breadcrumb = [
            [
                'text' => 'Ventas',
                'route' => 'sales.index'
            ],
            [
                'text' => isset($sale) ? "#$sale->id" : 'Error 404'
            ],
        ];

        return view('sales.show', [
            'breadcrumb' => $breadcrumb,
            'sale' => $sale,
            'currencies' => $currencies,
            'payment_methods' => $payment_methods,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = [
            [
                'text' => 'Ventas',
                'route' => 'sales.index'
            ],
            [
                'text' => '#121'
            ],
        ];

        return view('sales.edit', [
            'breadcrumb' => $breadcrumb
        ]);
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
        //
    }
}
