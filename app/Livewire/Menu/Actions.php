<?php

namespace App\Livewire\Menu;

use App\Livewire\Forms\MenuForm;
use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;

class Actions extends Component
{
    use WithFileUploads;

    public $show = false;
    public $photo;
    public MenuForm $form;

    #[On('createMenu')]
    public function createMenu()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.menu.actions', [
            'types' => Menu::$types
        ]);
    }

}
