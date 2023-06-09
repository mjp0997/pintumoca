<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingleProcedureRequest;
use App\Models\Procedure;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProceduresController extends Controller
{
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
    public function store(SingleProcedureRequest $request)
    {
        $data = $request->validated();
        
        // Descontar stock
        $from = Stock::where('product_id', $data['product_id'])->where('office_id', $data['from_office_id'])->first();
        $from->decrement('stock', $data['quantity']);

        // Incrementar stock
        $to = Stock::firstOrCreate([
            'product_id' => $data['product_id'],
            'office_id' => $data['to_office_id']
        ], [
            'stock' => $data['quantity']
        ]);

        if (!$to->wasRecentlyCreated) {
            $to->increment('stock', $data['quantity']);
        }

        // Crear registro
        $procedure = new Procedure();
        $procedure->user_id = $request->user()->id;
        $procedure->from_office_id = $data['from_office_id'];
        $procedure->to_office_id = $data['to_office_id'];
        $procedure->save();

        $procedure->procedureLines()->create([
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity']
        ]);

        return redirect()->route('products.show', ['id' => $data['product_id']]);
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
        //
    }
}
