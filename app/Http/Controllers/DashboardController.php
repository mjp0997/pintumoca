<?php

namespace App\Http\Controllers;

use App\Http\Traits\DashboardTrait;
use App\Http\Traits\DollarExchangeTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use DollarExchangeTrait, DashboardTrait;
    
    public function index()
    {
        $dollar = $this->getCurrentExchange();

        $today_sales = $this->getTodaySalesTotal();

        $sales_quantity = $this->getTodaySalesQuantity();

        $today_debt = $this->getTodayTotalDebt();

        $sales_by_office = $this->getTodaySalesByOffice();

        $total_by_office = $this->getTodayCollectedByOffice();

        $last_sales = $this->getLastSales();

        $breadcrumb = [
            [
                'text' => 'Dashboard'
            ],
        ];

        return view('dashboard', [
            'breadcrumb' => $breadcrumb,

            'dollar' => $dollar,
            'today_sales' => $today_sales,
            'sales_quantity' => $sales_quantity,
            'today_debt' => $today_debt,

            'sales_by_office' => $sales_by_office,
            'total_by_office' => $total_by_office,

            'last_sales' => $last_sales,
        ]);
    }
}
