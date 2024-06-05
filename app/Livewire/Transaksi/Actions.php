<?php

namespace App\Livewire\Transaksi;

use App\Livewire\Forms\TransaksiForm;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Transaksi;
use Livewire\Component;

class Actions extends Component
{
    public $search;
    public $items = [];
    public TransaksiForm $form;
    public ?Transaksi $transaksi;

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

    // public function mount(?Transaksi $transaksi){
    //     if(isset($transaksi)){
    //         $this->form->setTransaksi($transaksi);
    //         $this->items = $this->form->items;
    //     } else {
    //         $this->items = [];
    //     }
    // }

    public function mount(){
        if(isset($this->transaksi)){
            $this->form->setTransaksi($transaksi);
            $this->items = $this->form->items;
        }
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
        if(isset($this->items)){
            $prices = array_column($this->items, 'price');
            return array_sum($prices);
        } else {
            return 0;
        }
    }

    public function simpan() {
        $this->validate([
            'items' => 'required'
        ]);

        $this->form->items = $this->items;
        $this->form->price = $this->getTotalHarga();

        if (isset($this->form->transaksi)) {
            $this->form->update();
        } else {
            $this->form->store();
        }

        $this->redirect(route('transaksi.index'), true);
        // $this->custom
        // dd($this->items, $this->form->customer_id, $this->form->description);
    }
}
