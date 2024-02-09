<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateButton extends Component
{
    public $url;

    /**
     * Create a new component instance.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.create-button');
    }
}
