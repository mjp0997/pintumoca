<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $methods = PaymentMethod::orderBy('name', 'ASC')->paginate(12);

        $breadcrumb = [
            [
                'text' => 'Métodos de pago'
            ],
        ];

        return view('payment-methods.index', [
            'breadcrumb' => $breadcrumb,
            'methods' => $methods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = [
            [
                'text' => 'Métodos de pago',
                'route' => 'payment-methods.index'
            ],
            [
                'text' => 'Nuevo'
            ],
        ];

        return view('payment-methods.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentMethodRequest $request)
    {
        $data = $request->validated();

        $method = new PaymentMethod($data);
        $method->save();

        return redirect()->route('payment-methods.show', ['id' => $method->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $method = PaymentMethod::find($id);

        $breadcrumb = [
            [
                'text' => 'Métodos de pago',
                'route' => 'payment-methods.index'
            ],
            [
                'text' => $method?->name ?: 'Error 404'
            ],
        ];

        return view('payment-methods.show', [
            'breadcrumb' => $breadcrumb,
            'method' => $method
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $method = PaymentMethod::find($id);

        $breadcrumb = [
            [
                'text' => 'Métodos de pago',
                'route' => 'payment-methods.index'
            ],
            [
                'text' => $method?->name ?: 'Error 404'
            ],
        ];

        return view('payment-methods.edit', [
            'breadcrumb' => $breadcrumb,
            'method' => $method
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentMethodRequest $request, string $id)
    {
        $data = $request->validated();

        $method = PaymentMethod::find($id);

        if (!isset($method)) {
            return redirect()->route('payment-methods.show', ['id' => $id]);
        }

        $method->update($data);

        return redirect()->route('payment-methods.show', ['id' => $method->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $method = PaymentMethod::find($id);

        if (!isset($method)) {
            return redirect()->route('payment-methods.index');
        }

        $method->delete();

        return redirect()->route('payment-methods.index');
    }

    /**
     * Get a listing of the resource as a JSON
     */
    public function api_index()
    {
        $methods = PaymentMethod::orderBy('name', 'ASC')->get();

        return response()->json($methods);
    }
}
