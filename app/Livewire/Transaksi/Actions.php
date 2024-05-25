<?php

namespace App\Livewire\Transaksi;

use App\Livewire\Forms\TransaksiForm;
use App\Models\Customer;
use App\Models\Menu;
use Livewire\Component;

class Actions extends Component
{
    public $search;
    public $items = [];
    public TransaksiForm $form;

    public function render()
    {
        return view('livewire.transaksi.actions', [
            'menus' => Menu::when($this->search, function($menu){
                $menu->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('type', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
                })->get()->groupBy('type'),
            'customers' => Customer::pluck('name', 'id')
        ]);
    }

    public function addItem(Menu $menu){
        if (isset($this->items[$menu->name])) {
            $item = $this->items[$menu->name];
            $this->items[$menu->name] = [
                'qty' => $item['qty'] + 1,
                'price' => $item['price'] + $menu->price,
            ];
        } else {
            $this->items[$menu->name] = [
                'qty' => 1,
                'price' => $menu->price,
            ];
        }
    }

    public function removeItem($key){
        $item = $this->items[$key];

        if ($item['qty'] > 1) {
            // $this->items[$key] = [
            //     'qty' => $item['qty'] - 1,
            //     'price' => $item['price'] - $menu->price,
            // ];
            $harga_satuan = $item['price'] / $item['qty'];
            $qty = $item['qty'] - 1;

            $this->items[$key]['qty'] = $qty;
            $this->items[$key]['price'] = $harga_satuan * $qty;

        } else {
            unset($this->items[$key]);
        }
    }

    public function getTotalHarga(){
        $prices = array_column($this->items, 'price');
        return array_sum($prices);
    }

    public function simpan() {
        // $this->emit('reload');
        // $this->emit('closeModal');
        $this->validate([
            'items' => 'required'
        ]);
        $this->form->items = $this->items;
        $this->form->price = $this->getTotalHarga();

        $this->form->store();
        $this->redirect(route('transaksi.index'), true);
        // $this->custom
        // dd($this->items, $this->form->customer_id, $this->form->description);
    }
}
