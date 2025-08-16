<?php

namespace App\View\Components\Web;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public $url;
    public $settings;
    public $logo_file_name;
    /**
     * Create a new component instance.
     */
    public function __construct($settings = [], $url = null, $logoFileName = null)
    {
        $this->url = $url ?? ($settings['Site_Url'] ?? '');
        $this->settings = $settings;
        $this->logo_file_name = $logoFileName ?? ($settings['Site_Logo'] ?? '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web.layout');
    }
}
