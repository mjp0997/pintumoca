<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = [
            [
                'text' => 'Sucursales'
            ],
        ];

        return view('offices.index', [
            'breadcrumb' => $breadcrumb
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breadcrumb = [
            [
                'text' => 'Sucursales',
                'route' => 'offices.index'
            ],
            [
                'text' => 'PINTUMOCA'
            ],
        ];

        return view('offices.show', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = [
            [
                'text' => 'Sucursales',
                'route' => 'offices.index'
            ],
            [
                'text' => 'PINTUMOCA'
            ],
        ];

        return view('offices.edit', [
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
