<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalePaymentRequest;
use App\Http\Traits\DollarExchangeTrait;
use App\Models\SalePayment;
use Illuminate\Http\Request;

class SalePaymentsController extends Controller
{
    use DollarExchangeTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalePaymentRequest $request)
    {
        $data = $request->validated();
        
        $data['dollar_rate'] = $this->getCurrentExchange();

        $payment = new SalePayment($data);
        $payment->save();

        return redirect()->route('sales.show', ['id' => $payment->sale_id]);
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
        $payment = SalePayment::find($id);

        if (isset($payment)) {
            $payment->delete();
        }

        return redirect()->route('sales.show', ['id' => $payment->sale_id]);
    }
}
