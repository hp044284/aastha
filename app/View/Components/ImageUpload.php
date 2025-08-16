<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public $name;
    public $multiple;
    public $label;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($name = 'File_Name', $multiple = false, $label = null, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->multiple = $multiple;
    }

    public function render(): View|Closure|string
    {
        return view('components.image-upload');
    }
}
