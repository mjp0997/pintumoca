<?php

namespace App\Http\Traits;

use App\Models\Office;
use App\Models\Sale;
use Carbon\Carbon;

trait DashboardTrait
{
    private array $today_sales = [];

    public function __construct()
    {
        $today = new Carbon();

        $sales = Sale::with('office')->whereDate('date', '>=', $today->format('Y-m-d'))->get();

        $this->today_sales = collect($sales)->toArray();
    }

    public function getTodaySalesTotal()
    {
        $total = array_reduce($this->today_sales, function($carry, $item) {
            return $carry + $item['total'];
        }, 0);

        return number_format($total, '2');
    }

    public function getTodaySalesQuantity()
    {
        return count($this->today_sales);
    }

    public function getTodayTotalDebt()
    {
        $debt = array_reduce($this->today_sales, function($carry, $item) {
            return $carry + $item['debt'];
        }, 0);

        return number_format($debt, '2');
    }

    public function getTodaySalesByOffice()
    {
        $offices = Office::orderBy('name', 'ASC')->get();

        $data = [];

        foreach ($offices as $office) {
            $data[$office->name] = array_reduce($this->today_sales, function($carry, $item) use ($office) {
                if ($item['office']['name'] == $office->name) {
                    return $carry + 1;
                }

                return $carry + 0;
            }, 0);
        }

        return $data;
    }

    public function getTodayCollectedByOffice()
    {
        $offices = Office::orderBy('name', 'ASC')->get();

        $data = [];

        foreach ($offices as $office) {
            $data[$office->name] = array_reduce($this->today_sales, function($carry, $item) use ($office) {
                if ($item['office']['name'] == $office->name) {
                    return $carry + $item['total'];
                }

                return $carry + 0;
            }, 0);
        }

        return $data;
    }

    public function getLastSales()
    {
        return Sale::relationships()->orderBy('created_at', 'DESC')->limit(6)->get();
    }
}