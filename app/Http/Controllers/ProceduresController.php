<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcedureRequest;
use App\Models\Office;
use App\Models\Procedure;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProceduresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $procedures = Procedure::with('fromOffice', 'toOffice', 'user')->orderBy('created_at', 'DESC');

        if (isset($user->office_id)) {
            $procedures = $procedures->where(function ($query) use ($user) {
                return $query->where('from_office_id', $user->office_id)->orWhere('to_office_id', $user->office_id);
            });
        }

        $procedures = $procedures->paginate(12);

        $breadcrumb = [
            [
                'text' => 'Entregas'
            ],
        ];

        return view('procedures.index', [
            'breadcrumb' => $breadcrumb,
            'procedures' => $procedures
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
                'text' => 'Entregas',
                'route' => 'procedures.index'
            ],
            [
                'text' => 'Nuevo'
            ],
        ];

        return view('procedures.create', [
            'breadcrumb' => $breadcrumb,
            'offices' => $offices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProcedureRequest $request)
    {
        $data = $request->validated();
        
        $is_single = isset($request['single']) ? true : false;

        $products = $data['products'];
        
        foreach ($data['products'] as $product) {
            // Descontar stock
            $from = Stock::where('product_id', $product['product_id'])->where('office_id', $data['from_office_id'])->first();
            $from->decrement('stock', $product['quantity']);

            // Incrementar stock
            $to = Stock::firstOrCreate([
                'product_id' => $product['product_id'],
                'office_id' => $data['to_office_id']
            ], [
                'stock' => $product['quantity']
            ]);

            if (!$to->wasRecentlyCreated) {
                $to->increment('stock', $product['quantity']);
            }
        }

        // Crear registro
        $procedure = new Procedure();
        $procedure->user_id = $request->user()->id;
        $procedure->from_office_id = $data['from_office_id'];
        $procedure->to_office_id = $data['to_office_id'];
        $procedure->save();

        $procedure->procedureLines()->createMany($products);

        if ($is_single) {
            return redirect()->route('products.show', ['id' => $data['products'][0]['product_id']]);
        }

        return redirect()->route('procedures.show', ['id' => $procedure->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $procedure = Procedure::with('fromOffice', 'toOffice', 'user', 'procedureLines.product')->find($id);

        $breadcrumb = [
            [
                'text' => 'Entregas',
                'route' => 'procedures.index'
            ],
            [
                'text' => isset($procedure) ? "#$procedure->id" : 'Error 404'
            ],
        ];

        return view('procedures.show', [
            'breadcrumb' => $breadcrumb,
            'procedure' => $procedure,
        ]);
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
        $procedure = Procedure::find($id);

        if (!isset($procedure)) {
            return redirect()->route('procedures.index');
        }

        foreach ($procedure->procedureLines as $line) {
            // Descontar stock
            $to = Stock::where('product_id', $line['product_id'])->where('office_id', $procedure['to_office_id'])->first();
            $to->decrement('stock', $line['quantity']);

            // Incrementar stock
            $from = Stock::firstOrCreate([
                'product_id' => $line['product_id'],
                'office_id' => $procedure['from_office_id']
            ], [
                'stock' => $line['quantity']
            ]);

            if (!$from->wasRecentlyCreated) {
                $from->increment('stock', $line['quantity']);
            }
        }

        $procedure->delete();

        return redirect()->route('procedures.index');
    }
}
