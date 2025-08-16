<?php
namespace App\View\Components;
use Illuminate\View\Component;
class JsAssets extends Component
{
    public $paths;

    public function __construct($paths = [])
    {
        $this->paths = is_array($paths) ? $paths : explode(',', $paths);
    }

    public function render()
    {
        return view('components.js-assets');
    }
}



