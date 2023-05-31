<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = [
            [
                'text' => 'Usuarios'
            ],
        ];

        return view('users.index', [
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
                'text' => 'Usuarios',
                'route' => 'users.index'
            ],
            [
                'text' => 'Nuevo'
            ],
        ];

        return view('users.create', [
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
                'text' => 'Usuarios',
                'route' => 'users.index'
            ],
            [
                'text' => 'Alexander Pierce'
            ],
        ];

        return view('users.show', [
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
                'text' => 'Usuarios',
                'route' => 'users.index'
            ],
            [
                'text' => 'Alexander Pierce',
                'route' => ''
            ],
        ];

        return view('users.edit', [
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
