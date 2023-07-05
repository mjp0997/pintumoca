<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SalesList extends Component
{
    public $sales = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $sales)
    {
        $this->sales = $sales;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sales-list');
    }
}
