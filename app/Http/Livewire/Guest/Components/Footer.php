<?php

namespace App\Http\Livewire\Guest\Components;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Settings\LayoutSetting;
use Livewire\Component;

class Footer extends Component
{
    public function getLayoutSettingsProperty()
    {
        return app(LayoutSetting::class);
    }

    public function getFooterMenuProperty()
    {
        if ($this->layout_settings->footer_main_menu_handle) {
            return $this->menus->where('slug', $this->layout_settings->footer_main_menu_handle)->first();
        }
    }

    public function getBottomBarMenuProperty()
    {
        if ($this->layout_settings->footer_bottom_bar_enabled && $this->layout_settings->footer_bottom_bar_menu_handle) {
            return $this->menus->where('slug', $this->layout_settings->footer_bottom_bar_menu_handle)->first();
        }
    }

    public function getMenusProperty()
    {
        $menus = Menu::all();

        $menus->map(function ($menu) {
            $menu->setRelation('menuItems', MenuItem::treeOf(fn($query) => $query->isRoot()->where('menu_id', $menu->id))->get()->toTree());
        });

        return $menus;
    }

    public function render()
    {
        return view('livewire.guest.components.footer');
    }
}
