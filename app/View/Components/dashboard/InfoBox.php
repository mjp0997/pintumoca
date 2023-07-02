<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoBox extends Component
{
    public $icon_class = null;
    public $title = null;
    public $text = null;

    /**
     * Create a new component instance.
     */
    public function __construct(string $iconClass, string $title, string $text)
    {
        $this->icon_class = $iconClass;
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.info-box');
    }
}
