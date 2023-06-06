<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    /**
     * Get a listing of the resource as a JSON
     */
    public function api_index()
    {
        $currencies = Currency::orderBy('name', 'ASC')->get();

        return response()->json($currencies);
    }
}
