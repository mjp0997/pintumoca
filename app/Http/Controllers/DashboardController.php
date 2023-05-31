<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            [
                'text' => 'Dashboard'
            ],
        ];

        return view('dashboard', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
