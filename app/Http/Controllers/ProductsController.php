<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = [
            [
                'text' => 'Productos'
            ],
        ];

        return view('products.index', [
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
                'text' => 'Productos',
                'route' => 'products.index'
            ],
            [
                'text' => 'FA0-20410001'
            ],
        ];

        return view('products.show', [
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
                'text' => 'Productos',
                'route' => 'products.index'
            ],
            [
                'text' => 'FA0-20410001'
            ],
        ];

        return view('products.edit', [
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
