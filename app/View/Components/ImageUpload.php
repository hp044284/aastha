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
    public $is_store;

    /**
     * Create a new component instance.
     */
    
    public function __construct($name = 'File_Name', $multiple = false, $label = null, $value = null, $is_store = false)
    {
        if (is_string($is_store)) {
            $is_store = filter_var($is_store, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }
        
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->multiple = $multiple;
        $this->is_store = $is_store;
    }

    public function render(): View|Closure|string
    {
        return view('components.image-upload');
    }
}
