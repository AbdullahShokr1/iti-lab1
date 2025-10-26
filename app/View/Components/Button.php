<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $href;
    public $icon;
    public $text;
    public $method;

    public function __construct($type = 'primary', $href = '#', $icon = null, $text = 'Button', $method = 'GET')
    {
        $this->type = $type;
        $this->href = $href;
        $this->icon = $icon;
        $this->text = $text;
        $this->method = strtoupper($method);
    }

    public function render()
    {
        return view('components.button');
    }
}
