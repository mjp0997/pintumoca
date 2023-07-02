<?php

namespace App\Http\Controllers;

use App\Http\Traits\DollarExchangeTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use DollarExchangeTrait;
    
    public function index()
    {
        $dollar = $this->getCurrentExchange();

        $breadcrumb = [
            [
                'text' => 'Dashboard'
            ],
        ];

        return view('dashboard', [
            'breadcrumb' => $breadcrumb,
            'dollar' => $dollar
        ]);
    }
}
