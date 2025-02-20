<?php

namespace App\View\Components;

use App\Http\Services\Menu\MenuService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuComponent extends Component
{
    public $menus;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menus = resolve(MenuService::class)->getParent();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.menu-component');
    }
}
