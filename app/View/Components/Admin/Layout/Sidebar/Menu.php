<?php

namespace App\View\Components\Admin\Layout\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public function __construct(
        public string $title,
        public string $icon,
        public string $route,
        public ?string $activePattern = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.layout.sidebar.menu');
    }
}
