<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Models\Office;

class OfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::paginate(12);

        $breadcrumb = [
            [
                'text' => 'Sucursales'
            ],
        ];

        return view('offices.index', [
            'breadcrumb' => $breadcrumb,
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
                'text' => 'Sucursales',
                'route' => 'offices.index'
            ],
            [
                'text' => 'Nuevo'
            ],
        ];

        return view('offices.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfficeRequest $request)
    {
        $data = $request->validated();

        $office = new Office($data);
        $office->save();

        return redirect()->route('offices.show', ['id' => $office->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $office = Office::find($id);

        $breadcrumb = [
            [
                'text' => 'Sucursales',
                'route' => 'offices.index'
            ],
            [
                'text' => $office?->name ?: 'Error 404'
            ],
        ];

        return view('offices.show', [
            'breadcrumb' => $breadcrumb,
            'office' => $office
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $office = Office::find($id);

        $breadcrumb = [
            [
                'text' => 'Sucursales',
                'route' => 'offices.index'
            ],
            [
                'text' => $office?->name ?: 'Error 404'
            ],
        ];

        return view('offices.edit', [
            'breadcrumb' => $breadcrumb,
            'office' => $office
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfficeRequest $request, string $id)
    {
        $data = $request->validated();

        $office = Office::find($id);

        if (!isset($office)) {
            return redirect()->route('offices.show', ['id' => $id]);
        }

        $office->update($data);

        return redirect()->route('offices.show', ['id' => $office->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $office = Office::find($id);

        if (!isset($office)) {
            return redirect()->route('offices.index');
        }

        $office->delete();

        return redirect()->route('offices.index');
    }
}
