<?php

namespace App\Livewire\Menu;

use App\Models\Menu;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'reload' => '$refresh'
    ];

    public $search;
    public $no = 1;

    public function render()
    {
        return view('livewire.menu.index', [
            'menus' => Menu::when($this->search, function($menu){
                $menu->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('type', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%');


            })->get(),
        ]);
    }
}
