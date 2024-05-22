<?php

namespace App\Livewire\Menu;

use App\Models\Menu;
use Livewire\Component;

class Index extends Component
{
    public $no = 1;

    public function render()
    {
        return view('livewire.menu.index', [
            'menus' => Menu::get(),
        ]);
    }
}
